<?php
	header("Content-type: text/html; charset=utf-8"); 

	$username=$_POST['username'];
	$password=$_POST['password'];
	$password2=$_POST['password2'];
	$email	=$_POST['email'];
	$nickname=$_POST['nickname'];
	try {
	//$pdo = new PDO('pgsql:host=postgres;dbname=userinfo', 'postgres','');
		$pdo = new PDO('pgsql:host=postgres;dbname=userinfo;', 'postgres','');
		$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	} catch (PDOException $e) {
    	echo 'Connection failed: ' . $e->getMessage();
	}

	if($password!=$password2)
		die('两次密码不一致');

	$sql=' SELECT * FROM users WHERE username=:username ';
	$sth=$pdo->prepare($sql,array(PDO::ATTR_CURSOR=>PDO::CURSOR_FWDONLY));
	$sth->execute(array(':username'=>$username));
	$s=$sth->fetchAll();
	if(count($s))
		die('该用户名已被注册');

	$sql=' SELECT * FROM users WHERE email=:email ';
	$sth=$pdo->prepare($sql,array(PDO::ATTR_CURSOR=>PDO::CURSOR_FWDONLY));
	$sth->execute(array(':email'=>$email));
	$s=$sth->fetchAll();
	if(count($s))
		die('该邮箱已被注册');


	// echo '<br/> $sql = ';
	// var_dump($sql);
	// echo '<br/> $sth = ';
	// var_dump($sth);
	// echo '<br/> $s = ';
	// var_dump($s);

	$sql='INSERT INTO users(username, password, email, nickname) VALUES(:username, :password, :email, :nickname)';
	$sth = $pdo->prepare($sql, array(PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY));
	$sth->execute(array(':username'=>$username, ':password'=>$password, ':email'=>$email, ':nickname'=>$nickname ));
	$data1=$sth->fetchAll();
	var_dump($data1);



	
	require_once './PHPMailer-master/PHPMailerAutoload.php';

	$mail = new PHPMailer;

	$mail ->isSMTP();
	$mail ->SMTPDebug = 2;
	$mail ->Host='smtpdm.aliyun.com';
	$mail ->SMTPAuth=true;
	$mail ->Username='info@mycard.moe';
	$mail ->Password='s32ksxd9ucCGuYXM';
	$mail ->SMTPSecure = 'ssl';
	$mail ->Port=465;
	$mail ->CharSet='utf-8';

	$mail ->setFrom('info@mycard.moe');
	$mail ->addAddress($email);
	//$mail ->addAddress('1216023881@qq.com');
	//$mail ->isHTML(true);

	$mail ->Subject='感谢乃注册XXX账号';
	$mail ->Body="单击链接 或将链接复制到网页地址栏并回车 来激活账号 http://192.168.1.124/activate.php?username=$username";

	echo '<pre>';
	if(!$mail->send()){
		echo 'Message could not be sent.';
		echo 'Mailer Error: '.$mail->ErrorInfo;
	}else{
		echo 'Message has been sent';
	}
	echo '</pre>';
?>