<!-- fichier util.php -->
<?php
    require 'PHPMailer/PHPMailerAutoload.php';

function init_php_session()
{
    if(!session_id()){
        session_start();
        session_regenerate_id();
    }
}

function clean_php_session()
{
    session_unset();
    session_destroy();
}

function is_logged()
{
    if(isset($_SESSION['username']) && !empty($_SESSION['profile_photo']))
        return true;
    return false;
}

function is_admin()
{
    if (is_logged() && $_SESSION['is_admin'])
        return true;
    return false;
}


function smtpmailer($to, $from, $from_name, $subject, $id, $cle)
{
    $mail = new PHPMailer();
    $mail->IsSMTP();
    $mail->SMTPAuth = true;

    $mail->SMTPSecure = 'ssl';
    $mail->Host = 'smtp.gmail.com';
    $mail->Port = 465;
    $mail->Username = 'boubacar34sangare@gmail.com';
    $mail->Password = 'ulvizjswhyfqqsdw';

    $logo = '../img/logo.png';
    $link1 = '../index.php';
    $link = 'http://localhost:63342/user_side/verif-email.php?id='.$id.'&cle='.$cle;

    $body = "<!DOCTYPE html><html lang='en'><head><meta charset='UTF-8'><title>Confirmation Email</title></head><body>";
    $body .= "<a href='$link1'><img src='$logo' alt='Logo style=' display: block; margin: 0 auto; max-width: 200px;'></a>";
    $body .= "<p style='font-family: Arial, sans-serif; font-size: 16px; color: #333;'>Subject: Confirmation of Your Email Address</p>
            <p style='font-family: Arial, sans-serif; font-size: 16px; color: #333;'>Dear user,</p>";
    $body .= "<p style='font-family: Arial, sans-serif; font-size: 16px; color: #333;'>We are reaching out to confirm your email address associated with your account. This step is crucial to ensure the security of your account and to enable you to fully benefit from our services.</p>";
    $body .= "<p style='font-family: Arial, sans-serif; font-size: 16px; color: #333;'>Please click on the link below to confirm your email address:</p>";
    $body .= "<p style='font-family: Arial, sans-serif; font-size: 16px; color: #333;'><a href='$link' style='color: #007bff; text-decoration: underline;'>Click here to confirm your email address</a></p>";
    $body .= "<p style='font-family: Arial, sans-serif; font-size: 16px; color: #333;'>If you did not request this confirmation or if you encounter any issues, please contact us immediately.</p>";
    $body .= "<p style='font-family: Arial, sans-serif; font-size: 16px; color: #333;'>Thank you for your cooperation.</p>";
    $body .= "<p style='font-family: Arial, sans-serif; font-size: 16px; color: #333;'>Best regards,<br>FST GAMING CLUB<br>Technical Support Team</p>";
    $body .= "</body></html>";

    $mail->IsHTML(true);
    $mail->From= $from;
    $mail->FromName=$from_name;
    $mail->Sender=$from;
    $mail->AddReplyTo($from, $from_name);
    $mail->Subject = $subject;
    $mail->Body = $body;
    $mail->AddAddress($to);
    if(!$mail->Send())
    {
        return -1;
    }
    else
    {
        return 1;
    }
}
