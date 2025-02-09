<?php 
session_start();
require_once("database.php");

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home Page</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>

    <div class="header">
        <div class="header_flex">
            <div class="headline">
            <div class="logo">
                <h3><a href="index.php">Fahim</a></h3>
            </div>
            </div>
            <div class="menu_bar">
                <a href="index.php">Home</a>
                <a href="about.php">About</a>
                <?php 
    
    if(!isset($_COOKIE["currentUser"])){
        echo '<a href="sign_up.php">Sign Up</a>';
    }
    ?>
    <?php 
        if(isset($_COOKIE["currentUser"])){
            echo '<a href="profile.php">Profile</a>';
        }
    ?>
     
    <?php 
    
    if(!isset($_COOKIE["currentUser"])){
        echo '<a href="login.php">Login</a>';
    }else{
        echo '<a href="logout.php">Log out</a>';
    }
    
    ?>
            </div>
        </div>
    </div>