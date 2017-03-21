<?php

require_once "include/config.php";

$id = $_GET["id"];

$query = $db->prepare('SELECT id, email, username, name, avatar FROM users WHERE id=:id');
$query->execute(['id' => $id]);
$user = $query->fetchObject();

header('Content-Type: application/json');

if ($user) {
    if ($user->avatar) {
        if( substr($user->avatar, 0, 16) == '/uploads/default') {
            $user->avatar = "https://ygobbs.com" . $user->avatar;
        }
        else {
            $user->avatar = join(DIRECTORY_SEPARATOR, ['https://r.my-card.in', $user->avatar]);            
        }
    } else {
        $user->avatar = $default_avatar;
    }
    echo json_encode($user);
} else {
    http_response_code(400);
    die (json_encode(["message" => '用户不存在']));
}
