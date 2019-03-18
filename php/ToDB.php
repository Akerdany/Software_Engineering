<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
$p=(int)$_SESSION["price"]; 
$hours=(int)$_SESSION["NH"];
$sql="INSERT INTO `reservationdetails` ( `date`, `startTime`, `endTime`, `supervisorId`, `type`, `cost`) VALUES ( '$_SESSION["date"]', '$_SESSION["STime"]', '$_SESSION["ETime"]', '1', '$_SESSION['userType']', '$p*$hours')"
header('Location: index.php');
?>