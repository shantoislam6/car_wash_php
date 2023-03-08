<?php

//Import PHPMailer classes into the global namespace
//These must be at the top of your script, not inside a function

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception as PHPMailerExpection;

function init_mail()
{

   //PHPMailer instantiate and Server settings
   $mail = new PHPMailer(true);

   // Enable verbose debug output
   // $mail->SMTPDebug =  SMTP::DEBUG_SERVER;

   //Send using SMTP
   $mail->isSMTP();

   //Set the SMTP server to send through
   $mail->Host = $_ENV['MAIL_HOST'];

   //Enable SMTP authentication
   $mail->SMTPAuth = true;

   //SMTP username
   $mail->Username = $_ENV['MAIL_USERNAME'];

   //SMTP password
   $mail->Password = $_ENV['MAIL_PASSWORD'];

   //Enable implicit TLS encryption
   $mail->SMTPSecure = strtolower($_ENV['MAIL_ENCRYPTION']) == 'tls' ? PHPMailer::ENCRYPTION_STARTTLS : PHPMailer::ENCRYPTION_SMTPS;

   //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`
   $mail->Port = strtolower($_ENV['MAIL_ENCRYPTION']) == 'tls' ? 587 : 465;

   return $mail;
}


// send verification code
function send_verification_code($data)
{
   try {

      $code = rand(100000, 999999);

      $mail = init_mail();

      $mail->setFrom($_ENV["MAIL_FROM_ADDRESS"], SITENAME);
      $mail->addAddress($data['email'], $data['name']);

      //Content
      $mail->isHTML(true);

      // Subject
      $mail->Subject = 'Vertication Code From '. SITENAME;

      // Body
      $mail->Body    = '<h4>' . SITENAME . '</h4>';
      $mail->Body    .= '<p>Your Verification code <b></b>' .  $code . '</p>';

      $mail->AltBody = 'Your Verification code <b ></b>' .  $code;

      $mail->send();

      $_SESSION['verficaion_code_info'] = json_encode([
         'code' => $code,
         'time_limit' => time() + 60 * $_ENV['VERIFICATION_CODE_TIME_LIMIT'],
      ]);

      flash_message("info", "Check your email! Verification Code has been sent!!");
   } catch (PHPMailerExpection $e) {
      flash_message("warning", "Faild to sent verfication code. <b>Please, send again!!</b>!!");
   }
}
