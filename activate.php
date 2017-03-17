<?php
require_once "include/config.php";
$user_id = $_POST['user_id'];

$query = $db->prepare('UPDATE users SET approved = TRUE WHERE id = :user_id AND NOT approved');
$query->execute(['user_id' => $user_id]);
if ($query->rowCount()) {
    http_response_code(204);
} else {
    http_response_code(400);
}
