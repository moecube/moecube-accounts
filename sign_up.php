<?php
require_once "include/config.php";

$email = $_POST['email'];
$username = $_POST['username'];
$nickname = $_POST['nickname'];
$password = $_POST['password'];
$password2 = $_POST['password2'];

$submit = $_POST['submit'];

$json_arr = [];
if ($email != null) {
    emailOK($db, $email);
}
if ($username != null) {
    usernameOK($db, $username);
}
if ($submit == 'true') {
    $ok = true;
    if ($email == null) {
        $json_arr['email'] = ["class" => "red", "html" => "邮箱地址不能为空"];
        $ok = false;
    }
    if ($username == null) {
        $json_arr['username'] = ["class" => "red", "html" => "用户名不能为空"];
        $ok = false;
    }
    if ($password == null) {
        $json_arr['password'] = ["class" => "red", "html" => "密码不能为空"];
        $ok = false;
    }
    if ($password2 == null) {
        $json_arr['password2'] = ["class" => "red", "html" => "确认密码不能为空"];
        $ok = false;
    }

    if ($ok) {
        $salt = bin2hex(random_bytes(16));
        $password = hash_pbkdf2("sha256", $password, $salt, 64000);

        $sql = 'INSERT INTO users(username, password_hash, email, name, salt) VALUES(:username, :password_hash, :email, :nickname, :salt)';
        $sth = $db->prepare($sql, [PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY]);
        $sth->execute([
            ':username' => $username,
            ':password_hash' => $password,
            ':email'    => $email,
            ':nickname' => $nickname,
            ':salt'     => $salt
        ]);
        $data1 = $sth->fetchAll();
        if (count($data1)) {
            $title = "感谢乃注册MoeCube账号";
            $body = "单击链接 或将链接复制到网页地址栏并回车 来激活账号 http://192.168.1.124/activate.php?username=$username";
            sendMail($email, $title, $body);
            $json_arr['success'] = true;
        }
    }
}
$json_obj = json_encode($json_arr);
echo $json_obj;


function emailOK(PDO $pdo, string $email)
{

    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $json_arr['email'] = ["class" => "red", "html" => "邮箱格式错误"];

        return;
    }
    global $json_arr;
    $sql = 'SELECT * FROM users WHERE email = :email';
    $sth = $pdo->prepare($sql, [PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY]);
    $sth->execute([':email' => $email]);
    $s = $sth->fetchAll();
    if (count($s)) {
        $json_arr['email'] = ["class" => "red", "html" => "该邮箱已被注册"];
    } else {
        $json_arr['email'] = ["class" => "green", "html" => "邮箱可以使用"];
    }
}

function usernameOK(PDO $pdo, string $username)
{
    global $json_arr;
    $sql = 'SELECT * FROM users WHERE username = :username';
    $sth = $pdo->prepare($sql, [PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY]);
    $sth->execute([':username' => $username]);
    $s = $sth->fetchAll();
    if (count($s)) {
        $json_arr['username'] = ["class" => "red", "html" => "该用户名已被注册"];
    } else {
        $json_arr['username'] = ["class" => "green", "html" => "用户名可以使用"];
    }
}

function passwordOK($password, $password2)
{
    if ($password == $password2) {
        $json_arr['password2'] = ["class" => "red", "html" => "密码不一致"];
    }
}
