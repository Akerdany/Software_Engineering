<?php
require_once('connection.php');

$DB = new DbConnection();

$UT = $_REQUEST['id'];

$sql = 'SELECT featureId FROM `previliges` WHERE `userTypeId`='.$UT  ;
$result = mysqli_query($DB->getdbconnect(), $sql);    //get options of the chosen payment method sorted by priority of appearance

$formElements = "";    //empty string where html code for the fields will be stored and sent back to the AJAX call

while($row = mysqli_fetch_array($result)){
    $q = 'SELECT * from features WHERE id = "'.$row['featureId'].'"'; 
    $r = mysqli_query($DB->getdbconnect(), $q);
    $optionRow = mysqli_fetch_array($r);   //get option names of the payment method's options
    
    $button = '<a href="'.$optionRow['file'].'">'.$optionRow['feature']."</a>";    //label of each field by the option name
    $formElements .= $button;    // appending label then input field to the empty string
   
}

echo $formElements; //return the string carrying the input fields html


?>