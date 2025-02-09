<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

require __DIR__ . "/vendor/autoload.php";

$mail = new PHPMailer(true);

try {
    // Enable SMTP debugging (0 = off, 2 = full debug)
    // $mail->SMTPDebug = SMTP::DEBUG_SERVER; 

    $mail->isSMTP();
    $mail->SMTPAuth   = true;

    // ✅ SMTP Server & Port
    $mail->Host       = "smtp.gmail.com"; // Gmail SMTP
    $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
    $mail->Port       = 587; // TLS port (SSL হলে 465)

    // ✅ Authentication
    $mail->Username   = "mdfahimhossen629@gmail.com"; // তোমার ইমেইল
    $mail->Password   = "dyxq ucdl woty gytv"; // Gmail App Password

    // ✅ Email format
    $mail->isHTML(true);

    return $mail;
} catch (Exception $e) {
    die("Mailer Error: " . $mail->ErrorInfo);
}

?>
