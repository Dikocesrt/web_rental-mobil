<?php

require "vendor/autoload.php";

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;

if(isset($_POST['submit'])){
    $name = $_POST['your-name'];
    $mailSender = $_POST['your-mail'];
    $subject = $_POST['subject'];
    $message = $_POST['message'];

    if(empty($name) || empty($mail) || empty($subject) || empty($message)){
        header("location: index.php#contact?error=emptyfields");
        exit();
    } else if(!filter_var($mail, FILTER_VALIDATE_EMAIL)){
        header("location: index.php#contact?error=invalidemail");
        exit();
    } else {
        $mailTo = "mahardiko2100018254@webmail.uad.ac.id";

        $mail = new PHPMailer(true);

        try {
            //Server settings
            $mail->isSMTP();
            $mail->Host       = 'smtp.example.com'; // Replace with your SMTP server
            $mail->SMTPAuth   = true;
            $mail->Username   = 'mahardiko2100018254@webmail.uad.ac.id';
            $mail->Password   = 'scyosgsujlhxkrvb';
            $mail->SMTPSecure = 'tls';
            $mail->Port       = 587;

            //Recipients
            $mail->setFrom($mailSender, $name);
            $mail->addAddress($mailTo);

            // Content
            $mail->isHTML(true);
            $mail->Subject = $subject;
            $mail->Body    = $message;

            $mail->send();
            header("location: index.php?berhasilmengirimemail");
        } catch (Exception $e) {
            echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
        }
    }
}
?>
