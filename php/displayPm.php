<?php
require('Pmclass.php');
echo '<link href="../css/temp.css" rel="stylesheet" type="text/css">';
$paymentMethod = new paymentMethod(0);

$paymentMethod->displayMethods();
?>