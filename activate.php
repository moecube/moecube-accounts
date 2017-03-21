<?php
require_once "include/config.php";
$key = $_POST['key'];



$query = $db->prepare('SELECT user_id FROM tokens WHERE key = :key');
$query->execute([':key' => $key]);
$user_id = $query->fetchColumn();

if(!$user_id) {
    http_response_code(400);
    die(json_encode(['message' => 'key不正确']));
}


$query = $db->prepare('UPDATE users SET active = TRUE WHERE id = :user_id AND NOT active');
$query->execute(['user_id' => $user_id]);
if ($query->rowCount()) {
    $query = $db->prepare('DELETE FROM tokens WHERE key = :key');
    $query->execute(['key' => $key]);

    http_response_code(204);
} else {
    http_response_code(400);
}

