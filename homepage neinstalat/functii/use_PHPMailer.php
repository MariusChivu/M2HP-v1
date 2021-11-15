<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'functii/PHPMailer/src/Exception.php';
require 'functii/PHPMailer/src/PHPMailer.php';
require 'functii/PHPMailer/src/SMTP.php';
include("functii/mail_config.php");

$mail = new PHPMailer(true);
try {
$mail->Host = $mail_Host;
$mail->Username = $mail_Username;
$mail->Password = $mail_Password;
$mail->Port = $mail_Port;
//Server settings
$mail->SMTPDebug = 0;
$mail->isSMTP();
$mail->SMTPAuth = true;
$mail->CharSet = 'UTF-8';
$mail->setFrom($mail->Username, $title);
$mail->SMTPSecure = 'ssl';


} catch (Exception $e) {
    //echo 'Message could not be sent. Mailer Error: ', $mail->ErrorInfo;
}