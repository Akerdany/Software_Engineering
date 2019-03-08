<?php
require_once('connection.php');
echo '<link href="../css/temp.css" rel="stylesheet" type="text/css">';
$DB = new DbConnection();

$paymentMethodId = $_REQUEST['id'];

$sql = 'SELECT * from selectedoptions WHERE paymentId = "'.$paymentMethodId.'" ORDER BY priority ASC';
$result = mysqli_query($DB->getdbconnect(), $sql);    //get options of the chosen payment method sorted by priority of appearance

$formElements = "";    //empty string where html code for the fields will be stored and sent back to the AJAX call
echo $sql;
while($row = mysqli_fetch_array($result)){
    $q = 'SELECT * from options WHERE id = "'.$row['optionId'].'"'; 
    $r = mysqli_query($DB->getdbconnect(), $q);
    $optionRow = mysqli_fetch_array($r);   //get option names of the payment method's options
    
    $label = '<label>'.$optionRow['name'].'</label>';    //label of each field by the option name
    $field = '<input type = "'.$optionRow['type'].'" name = "'.str_replace(" ", "",$optionRow['name']).'"><br>';   // input field type from type column and name attribute based on option name
    $formElements .= $label;    // appending label then input field to the empty string
    $formElements .= '<br>';
    $formElements .= $field;
}

echo $formElements; //return the string carrying the input fields html


?>