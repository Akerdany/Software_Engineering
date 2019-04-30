<?php
require_once 'connection.php';
// require('Resevationclass.php');
require_once 'factoryClass.php';
include 'navbar.php';
echo '<link href="../css/temp.css" rel="stylesheet" type="text/css">';
// $DB = new DbConnection();
$DB = DbConnection::getInstance();
// $reservation = new reservation("");
$reservation = factoryClass::create("Model", "reservation", "");

$reservation->Display();
?>
