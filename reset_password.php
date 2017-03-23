<?php
require_once "include/config.php";

if (!isset($_POST['key']) || !isset($_POST['user_id']) || !isset($_POST['password'])) {
    http_response_code(400);
    die(json_encode(["message" => '参数不完整']));
}

$key = $_POST['key'];
$user_id = $_POST['user_id'];
$password = $_POST['password'];


$sql = 'SELECT * FROM tokens WHERE key=:key AND user_id=:user_id';
$sth = $db->prepare($sql);
$sth->execute(array(':key' => $key, ':user_id' => $user_id));
$forgot = $sth->fetch();


if ($forgot) {

    $sql = 'SELECT salt FROM users WHERE id=:user_id';
    $sth = $db->prepare($sql);
    $sth->execute(array(':user_id' => $user_id));
    $user = $sth->fetch();

    $password = hash_pbkdf2("sha256", $password, $user["salt"], 64000);

    $sql = 'UPDATE users SET password_hash=:password WHERE id=:user_id';
    $sth = $db->prepare($sql);
    $sth->execute(array(':password' => $password, ':user_id' => $user_id));

    echo '密码修改成功';
    $sql = 'DELETE FROM tokens WHERE user_id=:user_id';
    $sth = $db->prepare($sql);
    $sth->execute(array(':user_id' => $user_id));


    http_response_code(204);
} else {
    http_response_code(400);
    die(json_encode(["message" => '找不到该用户']));
}
