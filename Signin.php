<?php
	$emailOrUsername=$_POST['emailOrUsername'];
	$password=$_POST['password'];

	try {
		$pdo = new PDO('pgsql:host=postgres;dbname=userinfo;', 'postgres','');
		$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	} catch (PDOException $e) {
    	echo 'Connection failed: ' . $e->getMessage();
	}


	$sql='SELECT * FROM users WHERE (email=:emailOrUsername or username=:emailOrUsername) AND password=:password';
	$sth=$pdo->prepare($sql,array(PDO::ATTR_CURSOR=>PDO::CURSOR_FWDONLY));
	$sth->execute(array(':emailOrUsername'=>$emailOrUsername,':password'=>$password));
	$s=$sth->fetchAll();

	if(count($s))
		die('登陆成功');
	die('账号密码错误');


?>