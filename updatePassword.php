<?php
	require_once "database.php";

	$key		=$_GET	['key'];
	$username	=$_GET	['username'];
	$password	=$_POST	['password'];
	$password2	=$_POST	['password2'];


    $sql='SELECT * FROM forgotpassword WHERE key=:key AND username=:username';
    $sth=$pdo->prepare($sql,array(PDO::ATTR_CURSOR=>PDO::CURSOR_FWDONLY));
    $sth->execute(array(':key'=>$key,':username'=>$username));
    $s=$sth->fetchAll();
    if(count($s)){
    	if($password!=null){
    		if($password!=$password2){
    			echo '密码不一致';
    		}else{
    			$sql='UPDATE users SET password=:password WHERE username=:username';
    			$sth=$pdo->prepare($sql,array(PDO::ATTR_CURSOR=>PDO::CURSOR_FWDONLY));
    			$sth->execute(array(':password'=>$password,':username'=>$username));
    			$s2=$sth->fetchAll();

    			if(count($s2)){
    				echo '密码修改成功';
    				$sql='DELETE FROM forgotpassword WHERE username=:username';
    				$sth=$pdo->prepare($sql,array(PDO::ATTR_CURSOR=>PDO::CURSOR_FWDONLY));
    				$sth->execute(array(':username'=>$username));
    			}else{
    				echo '密码修改失败';
    			}
    		}
    	}else{
    		echo '页面';
    		require_once 'updatePassword.html';
    	}
    }else{
		var_dump($s);
	    die('妈了个鸡,你想干嘛');
	}
?>