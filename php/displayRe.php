<?php
require_once('connection.php');
require('Resevationclass.php');
echo '<link href="../css/temp.css" rel="stylesheet" type="text/css">';

$reservation = new reservation("");

$reservation->Display();
?>
