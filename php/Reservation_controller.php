<?php
require_once "factoryClass.php";

if (isset($_POST['approve'])) {
    $tempModel = factoryClass::create("Model", "Reservation", null);
    $tempModel->approveReservation($_POST['approve']);
    header("Location: ../php/displayRe.php");

} elseif (isset($_POST['decline'])) {
    $tempModel = factoryClass::create("Model", "Reservation", null);
    $tempModel->declineReservation($_POST['decline']);
    header("Location: ../php/displayRe.php");
}
?>