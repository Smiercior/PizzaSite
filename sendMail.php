<?php
//require_once 'C:\xampp\phpMyAdmin\vendor\autoload.php';

// Add library for email sending
use PHPMailer\PHPMailer\PHPMailer;
include("PHPMailer-master\PHPMailer-master\src\SMTP.php");
include("PHPMailer-master\PHPMailer-master\src\PHPMailer.php");
include("PHPMailer-master\PHPMailer-master\src\Exception.php");
include("PHPMailer-master\PHPMailer-master\src\OAuth.php");


function sendSMTPMail($to,$from,$fromName ,$subject,$body) // This function set SMTP data and send email
{
    /*
        // Strings
        $to - reciver email ( ex. reciver@gmail.com )
        $from - sender email ( ex. sender@gmail.com )
        $fromName - sender name ( ex. Sender )
        $subject - email subject ( ex. Your order #2 )
        $body - email content ( ex. Your order is ready, price is... )
    */

    // Setting SMTP data
    $ini = parse_ini_file("app.ini");
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

    $mail->Username = $ini['emailUserName'];//"smiercior44@gmail.com";
    $mail->Password = $ini['emailPassword'];//"password";
    $mail->setFrom($from,$fromName);
    $mail->Subject = $subject;
    $mail->Body = $body;
    $mail->addAddress($to);

    // Sent email
    if(!$mail->send()) // If error occured
    {
        echo $mail->ErrorInfo;
        return false;
    }
    else // If email was send
    {
        //echo "emial was send";
        return true;   
    } 
}
?>