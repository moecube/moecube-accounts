<?php
require_once "include/config.php";

header('Content-Type: application/json');

$emailOrUsername = $_POST['emailOrUsername'];
$password = $_POST['password'];

$query = $db->prepare("SELECT * FROM users WHERE (email=:emailOrUsername OR username=:emailOrUsername) ");
$query->execute(["emailOrUsername" => $emailOrUsername]);
$user = $query->fetchObject();

if (!$user) {
    http_response_code(400);
    die(json_encode(["message" => '用户名不对']));
}

$password = hash_pbkdf2("sha256", $password, $user->salt, 64000);

if ($user->password_hash == $password) {
    $_SESSION["user_id"] = $user->id;
    if ( $user->avatar) {
        if( substr($user->avatar, 0, 16) == '/uploads/default') {
            $user->avatar = "https://ygobbs.com" . $user->avatar;
        }
        else {
            $user->avatar = join(DIRECTORY_SEPARATOR, ['https://r.my-card.in', $user->avatar]);            
        }
    } else {
        $user->avatar = $default_avatar;
    }
    die(json_encode(["external_id" => $user->id, "name" => $user->name, "email" => $user->email, "username" => $user->username, "avatar_url" => $user->avatar, "avatar_force_update" => "true", "admin" => "false", "moderator" => "false"]));
} else {
    http_response_code(400);
    die(json_encode(["message" => '密码错误']));
}
