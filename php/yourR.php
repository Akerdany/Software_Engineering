<?php
require_once('connection.php');
require('Resevationclass.php');
include('navbar.php');
echo '<link href="../css/temp.css" rel="stylesheet" type="text/css">';
$DB = DbConnection::getInstance();

$reservation = new reservation("");
if (session_status() == PHP_SESSION_NONE)
       {
         session_start();
     }
    $ID= $_SESSION['id'];
$reservation-> DisplayPR($ID);
?>
