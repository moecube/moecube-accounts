<?php
	header("Content-type: text/html; charset=utf-8"); 

	$username=$_GET['username'];

	try {
	//$pdo = new PDO('pgsql:host=postgres;dbname=userinfo', 'postgres','');
		$pdo = new PDO('pgsql:host=postgres;dbname=userinfo;', 'postgres','');
		$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	} catch (PDOException $e) {
    	echo 'Connection failed: ' . $e->getMessage();
	}

	// $sql=' SELECT * FROM users WHERE username=:username AND status=0';
	// $sth=$pdo->prepare($sql,array(PDO::ATTR_CURSOR=>PDO::CURSOR_FWDONLY));
	// $sth->execute(array(':username'=>$username));
	// $s=$sth->fetchAll();
	// if(count($s)){
		$sql='UPDATE users SET status=1 WHERE username=:username AND status=0';
		$sth=$pdo->prepare($sql,array(PDO::ATTR_CURSOR=>PDO::CURSOR_FWDONLY));
		$sth->execute(array(':username'=>$username));
		$s=$sth->fetchAll();
		if(count($s)){
			die('激活成功');
		}
	// }
	
	echo '激活失败'


?>