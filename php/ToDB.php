<?php
require_once('connection.php');

$DB = new DbConnection();
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
$p=(int)$_SESSION["price"]; 
$hours=(int)$_SESSION["NH"];
$sum=$p*$hours;
$sql="INSERT INTO `reservationdetails` ( `date`, `startTime`, `endTime`, `supervisorId`, `type`, `cost`) VALUES('".$_SESSION["date"]."', '".$_SESSION["STime"]."', '".$_SESSION["ETime"]."', '1', 'normal', '$sum' )";
mysqli_query($DB->getdbconnect(), $sql);
$RDsql="SELECT MAX(id) FROM reservationdetails ";
$r=mysqli_query($DB->getdbconnect(), $RDsql);
$RDID=mysqli_fetch_assoc($r);
$sql1="INSERT INTO `reservation` (`userId`, `courtId`, `reservationDetailsId`,`code`) VALUES ( '".$_SESSION["id"]."', '".$_SESSION["cID"]."', '".$RDID["MAX(id)"]."', '".$_SESSION["code"]."')";
echo $sql1;
mysqli_query($DB->getdbconnect(), $sql1);
header('Location: index.php');
?>