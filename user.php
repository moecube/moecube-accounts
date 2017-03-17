<?php

require_once "include/config.php";

$id = $_GET["id"];

$query = $db->prepare('SELECT id, email, username, name, avatar FROM users WHERE id=:id');
$query->execute(['id' => $id]);
$user = $query->fetchObject();

header('Content-Type: application/json');

if ($user) {
    if ($user->avatar) {
        $user->avatar = join(DIRECTORY_SEPARATOR, [($_SERVER['HTTPS'] ? 'https://' : 'http://') . $_SERVER['HTTP_HOST'], $upload_target, $user->avatar]);
    }
    echo json_encode($user);
} else {
    http_response_code(400);
    die (json_encode(["message" => '用户不存在']));
}
