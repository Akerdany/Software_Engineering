<?php
require_once('connection.php');
require('courtClass.php');
echo '<link href="../css/temp.css" rel="stylesheet" type="text/css">';
$DB = new DbConnection();
$court = new Court();

$court->displayCourts();
?>
