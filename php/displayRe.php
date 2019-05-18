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



$number_of_results = Reservationmodel::getNumberofRs();
$results_per_page = 5;

$number_of_pages = ceil($number_of_results/$results_per_page);

if (!isset($_GET['p'])) {
    $page = 1;
}else {
    $page = $_GET['p'];
}

$this_page_first_result = ($page-1)*$results_per_page;
$reservation->Display($this_page_first_result,$results_per_page,$page,$number_of_pages);
?>
