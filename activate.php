<?php
	header("Content-type: text/html; charset=utf-8"); 
	require_once "database.php";
	$username=$_GET['username'];


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