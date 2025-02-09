<?php 

setcookie("currentUser", $userEU, time() - (86400 * 7), "/", "", true, true);
header("Location: index.php");

?>