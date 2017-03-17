<?php
require_once "include/config.php";

$email = $_POST['email'];
$username = $_POST['username'];
$nickname = $_POST['nickname'];
$password = $_POST['password'];
$password2 = $_POST['password2'];

$submit = $_POST['submit'];

$json_arr = [];
if ($email != NULL) {
    emailOK($db, $email);
}
if ($username != NULL) {
    usernameOK($db, $username);
}
if ($submit == 'true') {
    $ok = TRUE;
    if ($email == NULL) {
        $json_arr['email'] = ["class" => "red", "html" => "邮箱地址不能为空"];
        $ok = FALSE;
    }
    if ($username == NULL) {
        $json_arr['username'] = ["class" => "red", "html" => "用户名不能为空"];
        $ok = FALSE;
    }
    if ($password == NULL) {
        $json_arr['password'] = ["class" => "red", "html" => "密码不能为空"];
        $ok = FALSE;
    }
    if ($password2 == NULL) {
        $json_arr['password2'] = ["class" => "red", "html" => "确认密码不能为空"];
        $ok = FALSE;
    }

    if ($ok) {
        $sql = 'INSERT INTO users(username, password, email, nickname) VALUES(:username, :password, :email, :nickname)';
        $sth = $db->prepare($sql, [PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY]);
        $sth->execute([':username' => $username, ':password' => $password, ':email' => $email, ':nickname' => $nickname]);
        $data1 = $sth->fetchAll();
        if (count($data1)) {
            $title = "感谢乃注册MoeCube账号";
            $body = "单击链接 或将链接复制到网页地址栏并回车 来激活账号 http://192.168.1.124/activate.php?username=$username";
            sendMail($email, $title, $body);
            $json_arr['success'] = TRUE;
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
