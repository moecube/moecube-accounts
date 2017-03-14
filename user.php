<?php

  require_once 'database.php';

  $id = $_GET["id"];

  $query = $pdo->prepare("SELECT id, email, username, name, avatar from users WHERE id=:id ");
	$query->execute(["id" => $id]);
	$user=$query->fetch(PDO::FETCH_ASSOC);

  header('Content-Type: application/json');  
  
  if($user){
    if($user['avatar']) {
      $user["avatar"] =  join(DIRECTORY_SEPARATOR, [($_SERVER['HTTPS'] ? 'https://' : 'http://'). $_SERVER['HTTP_HOST'], $upload_target, $user["avatar"]]);      
    }
    echo json_encode($user);
  } else {
    http_response_code(400);
    die (json_encode(["message" => '用户不存在' ]));
  }