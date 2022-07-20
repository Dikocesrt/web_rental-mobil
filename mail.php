<?php
if(isset($_POST['submit'])){
    $name = $_POST['your-name'];
    $mail = $_POST['your-mail'];
    $subject = $_POST['subject'];
    $message = $_POST['message'];
    if(empty($name) || empty($mail) || empty($subject) || empty($message)){
        header("location: index.php#contact?error=emptyfields");
        exit();
    }else if(!filter_var($mail, FILTER_VALIDATE_EMAIL)){
        header("location: index.php#contact?error=invalidemail");
        exit();
    }else{
        $mailTo = "mahardiko2100018254@webmail.uad.ac.id";
        $header = "From : " . $mail;
        mail($mailTo, $subject, $message, $header);
        header("location: index.php?berhasilmengirimemail");
    }
}