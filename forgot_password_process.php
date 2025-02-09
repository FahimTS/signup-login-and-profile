<?php
require_once("database.php");

$email = $_REQUEST["email"];

// Validate email format
if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    header("Location: forgot_password.php?invalid=Invalid email format.");
    exit();
}

// Check if email exists
$sql = "SELECT id, reset_token_hash FROM my_users WHERE email=?";
$stmt = $connect->prepare($sql);
$stmt->bind_param("s", $email);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows === 0) {
    header("Location: forgot_password.php?account=No account found with that email.");
    exit();
}

// Generate token
$token = bin2hex(random_bytes(16));
$token_hash = hash("sha256", $token);
$expiry = date("Y-m-d H:i:s", time() + 60 * 30); // 30 minutes expiry

// Check if a reset token already exists for the email
$user = $result->fetch_assoc();
if ($user["reset_token_hash"]) {
    // If token exists, update it
    $sql = "UPDATE my_users SET reset_token_hash=?, reset_token_expires_at=? WHERE email=?";
} else {
    // If no token exists, insert a new one
    $sql = "INSERT INTO my_users (reset_token_hash, reset_token_expires_at, email) VALUES (?, ?, ?)";
}

$stmt = $connect->prepare($sql);
$stmt->bind_param("sss", $token_hash, $expiry, $email);
$stmt->execute();

// Check if the query was successful
if ($stmt->affected_rows >= 0) {
    // Load PHPMailer
    $mail = require __DIR__ . "/mailor.php";

    // Configure email
    $mail->setFrom("noreply@example.com", "Your Website");
    $mail->addAddress($email);
    $mail->Subject = "Password Reset Request";
    $mail->isHTML(true);
    $mail->Body = <<<END
    <p><a href="http://localhost/Dashboard/reset_password.php?token=$token">Click here</a> to reset your password.</p>
    <p>This link will expire in 30 minutes.</p>
    END;

    // Enable debugging (for testing only)
    $mail->SMTPDebug = 2; // Debugging চালু করো যদি সমস্যা হয়
    $mail->Debugoutput = 'html';

    try {
        $mail->send();
        header("Location: forgot_password.php?check=Message sent, please check your inbox.");
        exit();
    } catch (Exception $e) {
        echo "Message could not be sent. Mailer Error: " . $mail->ErrorInfo;
    }
}

$connect->close();
?>
