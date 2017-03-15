<?php

    function sendMail($email,$title,$body){
        $mail = new PHPMailer;

        $mail ->isSMTP();
        // $mail ->SMTPDebug = 2;
        $mail ->Host=getenv("SMTP_HOST");
        $mail ->SMTPAuth=true;
        $mail ->Username=getenv("SMTP_USERNAME");
        $mail ->Password=getenv("SMTP_PASSWORD");
        $mail ->SMTPSecure = getenv("SMTP_SECURE");
        $mail ->Port=getenv("SMTP_PORT");
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