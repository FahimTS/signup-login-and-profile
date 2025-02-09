<?php 
require_once("database.php");

if(empty($_REQUEST["fName"]) || empty($_REQUEST["lName"]) || empty($_REQUEST["email"]) || empty($_REQUEST["username"]) || empty($_REQUEST["phone_num"]) || empty($_REQUEST["usr_pwd"])){
    header("Location: sign_up.php?error=Input Must Be Fill-Up");
    exit();
}

if(strlen($_REQUEST["usr_pwd"]) < 6){
    header("Location: sign_up.php?password=Password must be at least 6 characters");
    exit();
}

$fName = $_REQUEST["fName"];
$lName = $_REQUEST["lName"];
$email = $_REQUEST["email"];
$username = $_REQUEST["username"];
$phone_num = $_REQUEST["phone_num"];
$usr_pwd = $_REQUEST["usr_pwd"];

$password_hash = password_hash($_REQUEST["usr_pwd"], PASSWORD_DEFAULT);

$insert = "INSERT INTO my_users (fName, lName, email, username, phone_num, usr_pwd) VALUES ('$fName','$lName','$email','$username','$phone_num', '$password_hash')";
$runQuery = mysqli_query($connect, $insert);

if($runQuery){
    header("Location: sign_up.php?success=Registation Successful!");
}


?>