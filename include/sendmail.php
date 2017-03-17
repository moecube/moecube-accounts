<?php

function sendMail(string $to, string $subject, string $message)
{
    $mail = new PHPMailer(true);

    $mail->isSMTP();
    $mail->Host = getenv('SMTP_HOST');
    $mail->SMTPAuth = true;
    $mail->Username = getenv('SMTP_USERNAME');
    $mail->Password = getenv('SMTP_PASSWORD');
    $mail->SMTPSecure = getenv('SMTP_SECURE');
    $mail->Port = getenv('SMTP_PORT');
    $mail->CharSet = 'utf-8';

    $mail->setFrom('info@mycard.moe');
    $mail->addAddress($to);

    $mail->Subject = $subject;
    $mail->Body = $message;

    $mail->send();
}
