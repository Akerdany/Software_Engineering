<?php
require_once('connection.php');
require('Resevationclass.php');
include('navbar.php');
echo '<link href="../css/temp.css" rel="stylesheet" type="text/css">';
$DB = new DbConnection();
$reservation = new reservation("");

$reservation->Display();
?>
