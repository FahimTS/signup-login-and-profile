<?php 
require_once("header.php");

if(isset($_POST["submit"])){  
    // ইউজারের ইমেইল কুকি থেকে নেওয়া
    $getCurrentUser = $_COOKIE["currentUser"];

    // ইনপুট গ্রহণ এবং স্পেশাল ক্যারেক্টার রিমুভ করা
    $oldPwd = mysqli_real_escape_string($connect, $_POST["oldpwd"]);
    $newPwd = mysqli_real_escape_string($connect, $_POST["newpwd"]);
    $cnfPwd = mysqli_real_escape_string($connect, $_POST["cnfpwd"]);

    // 🔴 ইনপুট ফাঁকা থাকলে প্রক্রিয়া বন্ধ করা
    if(empty($oldPwd) || empty($newPwd) || empty($cnfPwd)){
        header("Location: change_pwd.php?error=All fields are required!");
        exit();
    }

    // 🔴 নতুন পাসওয়ার্ড ৬ ক্যারেক্টারের কম হলে বন্ধ করবে
    if(strlen($newPwd) < 6){
        header("Location: change_pwd.php?error=New password must be at least 6 characters long!");
        exit();
    }

    // ডাটাবেজ থেকে ইউজারের বর্তমান পাসওয়ার্ড আনা
    $checkOldPwd = "SELECT usr_pwd FROM my_users WHERE email=?";
    $stmt = $connect->prepare($checkOldPwd);
    $stmt->bind_param("s", $getCurrentUser);
    $stmt->execute();
    $result = $stmt->get_result();

    if($result->num_rows === 1){
        $getCurrentUserData = $result->fetch_assoc();
        $dbPassword = $getCurrentUserData["usr_pwd"]; // ডাটাবেজে থাকা হ্যাশ পাসওয়ার্ড

        // ✅ পুরানো পাসওয়ার্ড মিলিয়ে দেখা (password_verify ব্যবহার করে)
        if(password_verify($oldPwd, $dbPassword)){
            
            // ✅ নতুন পাসওয়ার্ড এবং কনফার্ম পাসওয়ার্ড মিলছে কিনা?
            if($newPwd === $cnfPwd){

                // ✅ নতুন পাসওয়ার্ড হ্যাশ করা
                $hashedNewPwd = password_hash($newPwd, PASSWORD_DEFAULT);

                // ✅ পাসওয়ার্ড আপডেট করা
                $updatePwd = "UPDATE my_users SET usr_pwd=? WHERE email=?";
                $stmt = $connect->prepare($updatePwd);
                $stmt->bind_param("ss", $hashedNewPwd, $getCurrentUser);
                
                if($stmt->execute()){
                    header("Location: change_pwd.php?success=Password changed successfully!");
                    exit();
                } else {
                    header("Location: change_pwd.php?failed=Password update failed!");
                    exit();
                }
            } else {
                header("Location: change_pwd.php?dontmatch=New password and confirm password do not match!");
                exit();
            }
        } else {
            header("Location: change_pwd.php?incorrect=Old password is incorrect!");
            exit();
        }
    } else {
        header("Location: change_pwd.php?error=User not found!");
        exit();
    }
}
?>
