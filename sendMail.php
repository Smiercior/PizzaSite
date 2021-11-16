<?php
require_once 'C:\xampp\phpMyAdmin\vendor\autoload.php';

use PHPMailer\PHPMailer\PHPMailer;
include("PHPMailer-master\PHPMailer-master\src\SMTP.php");
include("PHPMailer-master\PHPMailer-master\src\PHPMailer.php");
include("PHPMailer-master\PHPMailer-master\src\Exception.php");
include("PHPMailer-master\PHPMailer-master\src\OAuth.php");
// Setting SMTP data

function sentSMTPMail($to,$from,$fromName ,$subject,$body)
{
    $mail = new PHPMailer();
    $mail->isSMTP();
    $mail->SMTPDebug = 0;
    $mail->SMTPAuth = true;
    $mail->SMTPSecure = "tls";
    $mail->SMTPAutoTLS = false;
    $mail->Host = "smtp.gmail.com";
    $mail->Port = 587;
    $mail->WordWrap = 70;  
    $mail->CharSet = "UTF-8";

    $mail->SMTPOptions = array(
        'ssl' => array(
            'verify_peer' => false,
            'verify_peer_name' => false,
            'allow_self_signed' => true
        )
    );

    $mail->Username = "smiercior44@gmail.com";
    $mail->Password = "password";
    $mail->setFrom($from,$fromName);
    $mail->Subject = $subject;
    $mail->Body = $body;
    $mail->addAddress($to);
    if(!$mail->send())
    {
        echo $mail->ErrorInfo;
        return false;
    }
    else
    {
        //echo "emial was send";
        return true;   
    } 
}
?>