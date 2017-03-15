<?php
    require_once "config.php";

    $emailOrUsername=$_POST['emailOrUsername'];
    $sql='SELECT * FROM users WHERE (email=:emailOrUsername or username=:emailOrUsername)';
    $sth=$pdo->prepare($sql);
    $sth->execute(array(':emailOrUsername'=>$emailOrUsername));
    $user=$sth->fetch();

    if($user){
        $user_id=$user['id'];
        $email=$user['email'];
        $key=$user_id.rand(0,9999);
        // var_dump($user_id);
        // var_dump($key);
        $sql='INSERT INTO forgotpassword (user_id,key,time) VALUES(:user_id, :key, now())';
        $sth=$pdo->prepare($sql);
        $sth->execute(array(':user_id'=>$user_id, ':key'=>$key));

        //====================发邮件
        $title="修改密码";
		$body="单击链接 或将链接复制到网页地址栏并回车 来修改密码 http://114.215.243.95:8081/updatepassword.html?key=$key&user_id=$user_id";
		require_once './sendmail.php';
		sendMail($email,$title,$body);
        echo '邮件已发送';
    }else{
        echo '邮箱或用户名错误';
    }

?>