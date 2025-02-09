<?php 

$host = "localhost";
$dbUser = "fahimhossen";
$dbPwd = "Fahim1122@@";
$dbName = "fahim";

$connect = mysqli_connect($host, $dbUser, $dbPwd, $dbName);

if($connect == false){
    echo "Database Not Connected";
}


?>