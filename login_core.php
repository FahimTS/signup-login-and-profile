<?php 
require_once("database.php");


    $userEU = $_POST["email"];
    $userPwd = $_POST["usr_pwd"];

    // ✅ SQL Injection রোধের জন্য `prepare()`
    $sql = "SELECT * FROM my_users WHERE email = ?";
    $stmt = $connect->prepare($sql);
    $stmt->bind_param("s", $userEU);
    $stmt->execute();
    $result = $stmt->get_result();
    $user = $result->fetch_assoc();

    if ($user) {
        // ✅ `password_verify()` ব্যবহার করে পাসওয়ার্ড চেক করা
        if (password_verify($userPwd, $user["usr_pwd"])) {
            // ✅ কুকি সেট করা (HTTPS & HttpOnly)
            setcookie("currentUser", $userEU, time() + (86400 * 7), "/", "", true, true);
            
            // ✅ লগইন সফল হলে profile.php তে রিডাইরেক্ট
            header("Location: profile.php");
            exit();
        } else {
            header("Location: login.php?error=Incorrect password!");
            exit();
        }
    } else {
        header("Location: login.php?error=User not found!");
        exit();
    }

?>
