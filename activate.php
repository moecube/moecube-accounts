<?php
require_once "include/config.php";
$key = $_POST['key'];

$query = $db->prepare('SELECT * FROM tokens WHERE key = :key');
$query->execute([':key' => $key]);
$token = $query->fetchObject();

if(!$token->user_id) {
    http_response_code(400);
    die(json_encode(['message' => 'key不正确']));
}

$query = $db->prepare('UPDATE users SET active = TRUE, email = :email WHERE id = :user_id');
$query->execute(['user_id' => $token->id, "email" => $token->data]);
if ($query->rowCount()) {
    $query = $db->prepare('DELETE FROM tokens WHERE key = :key');
    $query->execute(['key' => $key]);

    http_response_code(204);
} else {
    http_response_code(400);
}

