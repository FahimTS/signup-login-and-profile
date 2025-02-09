

<?php 
require_once("database.php");

if (!isset($_POST["token"]) || empty($_POST["token"])) {
    die("Token is missing.");
}

$token = $_POST["token"];
$token_hash = hash("sha256", $token);

// ✅ Search for token in database
$sql = "SELECT * FROM my_users WHERE reset_token_hash = ?";
$stmt = $connect->prepare($sql);
$stmt->bind_param("s", $token_hash);
$stmt->execute();
$result = $stmt->get_result();
$user = $result->fetch_assoc();

if (!$user) {
    die("Invalid token.");
}

// ✅ Check if token is expired
if (strtotime($user["reset_token_expires_at"]) <= time()) {
    die("Token has expired.");
}

// ✅ Validate passwords
if (strlen($_POST["usr_pwd"]) < 6) {
    die("Password must be at least 6 characters.");
}

if ($_POST["usr_pwd"] !== $_POST["password_confirmation"]) {
    die("Passwords do not match.");
}

// ✅ Hash the new password
$password_hash = password_hash($_POST["usr_pwd"], PASSWORD_DEFAULT);

// ✅ Update user password and clear token
$sql = "UPDATE my_users SET usr_pwd = ?, reset_token_hash = NULL, reset_token_expires_at = NULL WHERE id = ?";
$stmt = $connect->prepare($sql);
$stmt->bind_param("si", $password_hash, $user["id"]);
$stmt->execute();

// ✅ Redirect to login page
header("Location: login.php?success=Password updated successfully.");
exit();
?>

