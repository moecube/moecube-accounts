<?php
require_once "include/config.php";
use Ramsey\Uuid\Uuid;


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

        $sql = 'INSERT INTO users(username, password_hash, email, name, salt, created_at, updated_at, active, last_seen_at, admin, ip_address, blocked,  locale, registration_ip_address, first_seen_at) 
                           VALUES(:username, :password_hash, :email, :nickname, :salt, now(), now(), FALSE, now(), FALSE, :ip_address, FALSE, \'zh-CN\',:ip_address, now())
                           RETURNING id';
        $sth = $db->prepare($sql);
        $sth->execute([
            ':username' => $username,
            ':password_hash' => $password,
            ':email' => $email,
            ':nickname' => $nickname,
            ':salt' => $salt,
            ':ip_address' => $_SERVER['REMOTE_ADDR']
        ]);
        $user_id = $sth->fetchColumn();
        if ($user_id) {
            $key = Uuid::uuid1()->toString();
            $sql = "INSERT INTO tokens(user_id, key, created_at, type) 
                           VALUES(:user_id, :key, now(), 'activate')";
            $sth = $db->prepare($sql);
            $sth->execute([
                ':user_id' => $user_id,
                ':key' => $key
            ]);
            $title = "感谢乃注册MoeCube账号";
            $body = "单击链接 或将链接复制到网页地址栏并回车 来激活账号 https://accounts.moecube.com/activate.html?" . http_build_query(['key' => $key]);
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
