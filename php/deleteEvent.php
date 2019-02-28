<?php
require('Eventclass.php');
$DB = new DbConnection();
if (isset($_POST['deleteButton'])){
    $ID = $_POST['deleteButton'];
}
$event = new events(1);
$event->Delete($ID);
?>