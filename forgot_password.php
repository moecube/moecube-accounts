<?php
require_once "include/config.php";

use Ramsey\Uuid\Uuid;

$emailOrUsername = $_POST['emailOrUsername'];
$sql = 'SELECT * FROM users WHERE (email=:emailOrUsername OR username=:emailOrUsername)';
$sth = $db->prepare($sql);
$sth->execute([':emailOrUsername' => $emailOrUsername]);
$user = $sth->fetch();

if ($user) {
    $user_id = $user['id'];
    $email = $user['email'];
    $key = Uuid::uuid1()->toString();
    // var_dump($user_id);
    // var_dump($key);
    $sql = 'INSERT INTO forgotpassword (user_id,key,time) VALUES(:user_id, :key, now())';
    $sth = $db->prepare($sql);
    $sth->execute([':user_id' => $user_id, ':key' => $key]);

    //====================发邮件
    $title = "修改密码";
    $body = "单击链接 或将链接复制到网页地址栏并回车 来修改密码 http://114.215.243.95:8081/reset_password.html?key=$key&user_id=$user_id";
    sendMail($email, $title, $body);
    die(json_encode(["message" => '邮件已发送']));
} else {
    http_response_code(400);
    die(json_encode(["message" => '用户或密码错误']));
}
 