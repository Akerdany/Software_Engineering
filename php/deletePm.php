<?php
require('Pmclass.php');
$DB = new DbConnection();
if (isset($_POST['deleteButton'])){
    $ID = $_POST['deleteButton'];
}
$PaymentM = new paymentMethod(0);
$PaymentM->DeleteMethod($ID);
?>