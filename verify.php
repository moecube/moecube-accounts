<?php
	require_once 'config.php';

	$email		=$_POST['email'];
	$username	=$_POST['username']	;
	$nickname 	=$_POST['nickname'];
	$password 	=$_POST['password']	;
	$password2	=$_POST['password2'];

	$submit 	=$_POST['submit'];
	//$email		=$_GET['email']		||$_POST['email']		;
	//$username		=$_GET['username']	||$_POST['username']	;
	//$password 	=$_GET['password']	||$_POST['password']	;
	//$password2	=$_GET['password2']	||$_POST['password2']	;

	$json_arr=array();
	if($email!=null){
		emailOK($pdo,$email);
	}
	if($username!=null){
		usernameOK($pdo,$username);
	}
	if($submit=='true'){
		$ok=true;
		if($email == null){
			 $json_arr['email'] = array("class"=>"red","html"=>"邮箱地址不能为空");
			 $ok=false;
		}
		if($username == null){
			 $json_arr['username'] = array("class"=>"red","html"=>"用户名不能为空");
			 $ok=false;
		}
		if($password == null){
			$json_arr['password'] = array("class"=>"red","html"=>"密码不能为空");
			$ok=false;
		}
		if($password2 == null){
			$json_arr['password2']= array("class"=>"red","html"=>"确认密码不能为空");
			$ok=false;
		}

		if($ok){
			$sql='INSERT INTO users(username, password, email, nickname) VALUES(:username, :password, :email, :nickname)';
			$sth = $pdo->prepare($sql, array(PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY));
			$sth->execute(array(':username'=>$username, ':password'=>$password, ':email'=>$email, ':nickname'=>$nickname ));
			$data1=$sth->fetchAll();
			if(count($data1)){
				$title="感谢乃注册MoeCube账号";
				$body="单击链接 或将链接复制到网页地址栏并回车 来激活账号 http://192.168.1.124/activate.php?username=$username";
				require_once './sendmail.php';
				sendMail($email,$title,$body);
				$json_arr['success']=true;
			}
		}
	}
	$json_obj = json_encode($json_arr);
    echo $json_obj;



	function emailOK($pdo,$email){
		if (!preg_match("/^[a-zA-Z0-9_-]+@[a-zA-Z0-9_-]+(\.[a-zA-Z0-9_-]+)+$/", $email))
		{
			$json_arr['email']=array("class"=>"red","html"=>"邮箱格式错误");
			return;
		}
		global $json_arr;
		$sql=' SELECT * FROM users WHERE email=:email ';
		$sth=$pdo->prepare($sql,array(PDO::ATTR_CURSOR=>PDO::CURSOR_FWDONLY));
		$sth->execute(array(':email'=>$email));
		$s=$sth->fetchAll();
		if(count($s)){
			$json_arr['email']=array("class"=>"red","html"=>"该邮箱已被注册");
		}else{
			$json_arr['email']=array("class"=>"green","html"=>"邮箱可以使用");
		}
	}
	function usernameOK($pdo,$username){
		global $json_arr;
		$sql=' SELECT * FROM users WHERE username=:username ';
		$sth=$pdo->prepare($sql,array(PDO::ATTR_CURSOR=>PDO::CURSOR_FWDONLY));
		$sth->execute(array(':username'=>$username));
		$s=$sth->fetchAll();
		if(count($s)){
			$json_arr['username']=array("class"=>"red","html"=>"该用户名已被注册");
		}else{
			$json_arr['username']=array("class"=>"green","html"=>"用户名可以使用");
		}
	}
	function passwordOK($password,$password2){
		if($password==$password2){
			$json_arr['password2']= array("class"=>"red","html"=>"密码不一致");
		}
	}

?>