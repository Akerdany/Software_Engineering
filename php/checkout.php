<html>
<head>
<script>
function getForm(pmId) {
    var xmlhttp = new XMLHttpRequest();
    xmlhttp.onreadystatechange = function() {
    if (this.readyState == 4 && this.status == 200) {
        document.getElementById("fields").innerHTML = ''; //empty form before appending
        document.getElementById("fields").innerHTML += this.responseText; // append retrieved fields
        }
    };
    xmlhttp.open("GET", "getFormFields.php?id=" + pmId, true); //request to getFormFields with paymentMethodId to get the fields
    xmlhttp.send();
}
//$time1 = strtotime($string);

</script>
</head>

</html>

<?php
require_once('connection.php');
echo '<link href="../css/temp.css" rel="stylesheet" type="text/css">';
$DB = new DbConnection();
$sql = 'SELECT * from paymentmethod WHERE isDeleted = "0"';
$result = mysqli_query($DB->getdbconnect(), $sql);

echo '<form id = "checkout" action = "" method = "POST">'
    .'<label>Payment Method</label><br>'
    .'<select name = "paymentmethod" onchange = "getForm(this.value)">'
    .'<option>Choose</option>';
while($row = mysqli_fetch_array($result))
{
    echo $row['name'].'<br>';
    echo '<option value = "'.$row['id'].'">'.$row['name'].'</option>';
    
}
echo '</select> <br>'
    .'<div id = "fields"></div>';
echo '<input type = "submit" name = "submit" value = "Checkout">
    </form>';

if (isset($_POST['submit']))
{
    $paymentMethodId = $_POST['paymentmethod'];
    $sql = 'SELECT id, optionId from selectedoptions where paymentId = "'.$paymentMethodId.'"';
    $result = mysqli_query($DB->getdbconnect(), $sql);

    $q1 = 'SELECT * from selectedoptions WHERE paymentId = "'.$paymentMethodId.'" ORDER BY priority ASC';
    $r1 = mysqli_query($DB->getdbconnect(), $q1); //get selectedoptionsId for insertion
    
    while($row = mysqli_fetch_array($result)){
        $q = 'SELECT name from options WHERE id = "'.$row['optionId'].'"';
        $r = mysqli_query($DB->getdbconnect(), $q); //get the name of option from each optionId used in previous query
        $optionRow = mysqli_fetch_array($r);
        $optionName = str_replace(" ","",$optionRow['name']);
        
        
        $soRow = mysqli_fetch_array($r1);
        $soId = $soRow['id'];
        $fieldname = $_POST[''.$optionName.'']; //use the option name to get field values
        $insertSQL = 'INSERT INTO p_method_option_value (`selectedoptionsId`, `value`, `reservationId`) VALUES ( "'.$soId.'","'.$fieldname.'","-1")';
        mysqli_query($DB->getdbconnect(), $insertSQL);
    }
    header('Location: confermation.php');
}

?>
