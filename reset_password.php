<style>
    .reset_pass {
        width: 400px;
        margin: auto;
        background: black;
        display: block;
        color: #fff;
        padding: 55px 25px;
        margin-top: 100px;
        margin-bottom: 100px;
        border-radius: 10px;
    }

    .reset_pass form input {
        display: block;
        width: 100%;
    }
    .reset_pass h2 {
        text-align: center;
        margin-bottom: 35px;
    }

    .reset_pass form label {
        font-size: 16px;
        margin-top: 20px;
        display: block;
        margin-bottom: 8px;
    }

    .reset_pass form input {
        padding: 10px;
        border-radius: 3px;
        border: 2px solid navajowhite;
    }

    .reset_pass button {
        text-align: center;
        margin: 31px auto 0px;
        display: block;
        padding: 12px 20px;
        border: none;
        outline: none;
        background: rebeccapurple;
        color: #fff;
        cursor: pointer;
        border-radius: 6px;
    }
</style>
<?php require_once("header.php") ?>;
<?php 
require_once("database.php");

// ✅ Check if token is present in the URL
if (!isset($_GET["token"]) || empty($_GET["token"])) {
    die("Invalid request: Missing token.");
}

$token = $_GET["token"];
$token_hash = hash("sha256", $token);

// ✅ Search for token in database
$sql = "SELECT * FROM my_users WHERE reset_token_hash = ?";
$stmt = $connect->prepare($sql);
$stmt->bind_param("s", $token_hash);
$stmt->execute();
$result = $stmt->get_result();
$user = $result->fetch_assoc();

if (!$user) {
    die("Invalid token or token not found.");
}

// ✅ Check if token is expired
if (strtotime($user["reset_token_expires_at"]) <= time()) {
    die("Token has expired.");
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Reset Password</title>
</head>
<body>
    <div class="reset_pass">
        <h2>Reset Password</h2>

        <form method="post" action="reset_password_process.php">
            <input type="hidden" name="token" value="<?= htmlspecialchars($token) ?>">

            <label for="usr_pwd">New Password</label>
            <input type="password" id="usr_pwd" name="usr_pwd" required>

            <label for="password_confirmation">Repeat Password</label>
            <input type="password" id="password_confirmation" name="password_confirmation" required>

            <button type="submit">Reset Password</button>
        </form>
    </div>
</body>
</html>
<?php require_once("footer.php") ?>;