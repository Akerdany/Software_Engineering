<?php
require_once('connection.php');
include('../TCPDF-master/tcpdf.php');
$pdf = new TCPDF('p', 'mm', 'A4');
$pdf->setPrintHeader('false');
$pdf->setPrintFooter('false');
$pdf->AddPage();
$pdf->setImageScale(1.53);


$DB = new DbConnection();
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

$pdf->writeHTML($_SESSION["pdfcontent"], false, false, true, false, '');

// $p=(int)$_SESSION["price"]; 
// $hours=(int)$_SESSION["NH"];
// $sum=$p*$hours;
$sql="INSERT INTO `reservationdetails` ( `date`, `startTime`, `endTime`, `supervisorId`, `type`, `cost`) VALUES('".$_SESSION["date"]."', '".$_SESSION["STime"]."', '".$_SESSION["ETime"]."', '1', 'normal',  '".$_SESSION["sum"]."' )";
mysqli_query($DB->getdbconnect(), $sql);
$RDsql="SELECT MAX(id) FROM reservationdetails ";
$r=mysqli_query($DB->getdbconnect(), $RDsql);
$RDID=mysqli_fetch_assoc($r);
$sql1="INSERT INTO `reservation` (`userId`, `courtId`, `reservationDetailsId`,`code`) VALUES ( '".$_SESSION["id"]."', '".$_SESSION["cID"]."', '".$RDID["MAX(id)"]."', '".$_SESSION["code"]."')";
//echo $sql1;
mysqli_query($DB->getdbconnect(), $sql1);

$pdf->Output("confirmation.pdf", "D");
// $pdf->Output();
?>