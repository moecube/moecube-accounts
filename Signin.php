<?php
	require_once 'database.php';

	$emailOrUsername=$_POST['emailOrUsername'];
	$password=$_POST['password'];

	$query = $pdo->prepare("SELECT id, salt from users WHERE (email=:emailOrUsername or username=:emailOrUsername) ");
	$query->execute(["emailOrUsername" => $emailOrUsername]);
	$user=$query->fetch(PDO::FETCH_ASSOC);

	if(!$user) {
    http_response_code(400);
    echo(json_encode(["message" => '用户不存在' ]));
	}

	$password = hash_pbkdf2("sha256", $password, $user["salt"], 64000);


	$sql='SELECT * FROM users WHERE id =:id AND password_hash=:password';
	$sth=$pdo->prepare($sql);
	$sth->execute(array('id'=>$user["id"],'password'=>$password));
	$user=$sth->fetch(PDO::FETCH_ASSOC);

	if($user){
		header('Content-Type: application/json');
		echo(json_encode([ "name" => $user["name"], "email" => $user["email"],  "username" => $user["username"], "avatar_url" => "", "avatar_force_update" => "true", "external_id" => $user["id"], "admin" => "false", "moderator" => "false"]));
	} else {
		http_response_code(400);
		echo(json_encode(["message" => '用户或密码失败' ]));
	}

?>
