<?php 
require_once("database.php");

if(isset($_REQUEST["editBtn"])){

    $fName = $_REQUEST["fName"];
    $lName = $_REQUEST["lName"];
    $email = $_REQUEST["email"];
    $phone_num = $_REQUEST["phone_num"];
    $country = $_REQUEST["country"];
    $editingID = $_REQUEST["editingID"];

    $location = "img/";
    $avatarName = $_FILES["avatar"]["name"];
    $avatarTmpName = $_FILES["avatar"]["tmp_name"];
    $defualtAvatar = "avatar.png";

    if(!empty($avatarName)){
        $uniqImgDb = uniqid(). "_" . time() . ".jpg";
        move_uploaded_file($avatarTmpName, $location."$uniqImgDb");
    }else{
        $query = "SELECT avatar FROM my_users WHERE id='$editingID'";
        $resultQuery = mysqli_query($connect, $query);
        $row = mysqli_fetch_array($resultQuery);
        $uniqImgDb = !empty($row["avatar"]) ? $row["avatar"] : $defualtAvatar;
    }

    $updateQuery = "UPDATE my_users SET fName='$fName', lName='$lName', email='$email', phone_num='$phone_num', avatar='$uniqImgDb', country='$country' WHERE id='$editingID'";
    $runQuery = mysqli_query($connect, $updateQuery);

    if($runQuery){
       header("Location: profile.php"); 
    }

}

?>