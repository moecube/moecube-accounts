<?php
    require_once "config.php";

    $emailOrUsername=$_POST['emailOrUsername'];
    $sql='SELECT * FROM users WHERE (email=:emailOrUsername or username=:emailOrUsername)';
    $sth=$pdo->prepare($sql,array(PDO::ATTR_CURSOR=>PDO::CURSOR_FWDONLY));
    $sth->execute(array(':emailOrUsername'=>$emailOrUsername));
    $s=$sth->fetchAll();

    if(count($s)){
        $username=$s[0]['username'];
        $email=$s[0]['email'];
        $key=$username.rand(0,9999);
        // var_dump($username);
        // var_dump($key);
        $sql='INSERT INTO forgotpassword (username,email,key,time) VALUES(:username, :email, :key, now())';
        $sth=$pdo->prepare($sql,array(PDO::ATTR_CURSOR=>PDO::CURSOR_FWDONLY));
        $sth->execute(array(':username'=>$username,':email'=>$email,':key'=>$key));

        //====================发邮件
        $title="修改密码";
		$body="单击链接 或将链接复制到网页地址栏并回车 来修改密码 http://192.168.1.124/updatepassword.php?key=$key&username=$username";
		require_once './sendmail.php';
		sendMail($email,$title,$body);
        echo '邮件已发送';
    }else{
        echo '邮箱或用户名错误';
    }

?>