<?php

  require_once "database.php";

  
  $id       = $_POST['id'] ? $_POST['id'] : null;
  $email		= $_POST['email'] ? $_POST['email'] : null;
	$username	= $_POST['username']	 ? $_POST['username']	 : null;
	$name 	= $_POST['name'] ? $_POST['name'] : null;
	$password 	= $_POST['password']	 ? $_POST['password']	 : null;
	$current_password 	= $_POST['current_password'] ? $_POST['current_password'] : null;
  $avatar = $_FILES["avatar"];

  $avatar_target = join(DIRECTORY_SEPARATOR, [$upload_target, $id]);
  
  $query = $pdo->prepare("SELECT * from users WHERE id=:id ");
	$query->execute(["id" => $id]);
	$user=$query->fetch(PDO::FETCH_ASSOC);
  
 	if(!$user) {
    http_response_code(400);
    die (json_encode(["message" => '用户不存在' ]));
	}

  if($email || $password && $user["password_hash"] != hash_pbkdf2("sha256", $current_password, $user["salt"], 64000)) {
    http_response_code(400);
    die (json_encode(["message" => '密码不正确' ]));
  }

  if(!file_exists($upload_target)){
    mkdir($upload_target);
  }

  if($avatar) {
    move_uploaded_file($avatar["tmp_name"], $avatar_target);  
  }


  $query = $pdo->prepare("UPDATE users SET username=:username, name=:name, password_hash=:password_hash, email=:email, avatar= :avatar WHERE id=:id ");
	$query->execute(["username" => $username ? $username : $user["username"],
                   "name" => $name ? $name : $user["name"], 
                   "avatar" => $avatar ? $id : $user["avatar"],                   
                   "password_hash" => $password ? hash_pbkdf2("sha256", $password, $user["salt"], 64000) : $user["password_hash"],
                   "email" => $email ? $email : $user["email"],
                   "id" => $id ? $id : $user["id"],          
                   ]);
	$user=$query->fetch(PDO::FETCH_ASSOC);
  


