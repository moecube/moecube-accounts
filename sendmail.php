<?php
    require_once './PHPMailer-master/PHPMailerAutoload.php';

    function sendMail($email,$title,$body){
        $mail = new PHPMailer;

        $mail ->isSMTP();
        // $mail ->SMTPDebug = 2;
        $mail ->Host='smtpdm.aliyun.com';
        $mail ->SMTPAuth=true;
        $mail ->Username='info@mycard.moe';
        $mail ->Password='s32ksxd9ucCGuYXM';
        $mail ->SMTPSecure = 'ssl';
        $mail ->Port=465;
        $mail ->CharSet='utf-8';

        $mail ->setFrom('info@mycard.moe');
        $mail ->addAddress($email);

        $mail ->Subject=$title;
        $mail ->Body=$body;

        // echo '<pre>';
        if(!$mail->send()){
        	// echo 'Message could not be sent.';
        	// echo 'Mailer Error: '.$mail->ErrorInfo;
        }else{
        	// echo 'Message has been sent';
        }
        // echo '</pre>';
    }
?>