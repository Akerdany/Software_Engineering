<?php
require('Eventclass.php');
include('navbar.php');
echo '<link href="../css/temp.css" rel="stylesheet" type="text/css">';
$event = new events(1);

$event->displayEvents();
?>
