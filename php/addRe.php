
<script>
function getForm(pmId) {

    var court=document.getElementById('court').value;

    var xmlhttp = new XMLHttpRequest();
    xmlhttp.onreadystatechange = function() {
    if (this.readyState == 4 && this.status == 200) {
        document.getElementById("fields").innerHTML = ''; //empty form before appending
        document.getElementById("fields").innerHTML += this.responseText; // append retrieved fields
        }
    };

    xmlhttp.open("GET", "table.php?id=" + pmId+"/"+court, true); //request to getFormFields with paymentMethodId to get the fields
    xmlhttp.send();

}
function required()
{
var empt = document.forms["form1"]["Rdate"].value;
if (empt == "")
{
alert("Please input a Value");
return false;
}
else 
{
alert('Code has accepted : you can try another');
return true; 
}
}

</script>
<?php

require_once 'connection.php';
require_once 'Resevationclass.php';
include_once 'navbar.php';
echo '<link rel="stylesheet"href="../css/style5.css">';
echo '<link href="../css/temp.css" rel="stylesheet" type="text/css">';
echo'<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">';
// $DB = new DbConnection();
$DB = DbConnection::getInstance();

$sqlcourt    = 'SELECT * FROM `court`WHERE isDeleted=0 ';
$resultcourt = mysqli_query($DB->getdbconnect(), $sqlcourt);

echo '<form name="form1" class ="dark" action = "table.php" method = "POST" ">
                    <label>Choose court </label>
                    <select id = "court" name = "court" class = "select" required  "><option value="" >Choose</option>';
while ($row = mysqli_fetch_array($resultcourt)) {
    echo '<option value = "' . $row['id'] . '">Court ' . $row['courtNumber'] . ' / ' . $row['price'] . ' EGP</option>';
}
echo '</select> <br>';
$date = date("Y-m-d");
echo '<input type="date" min="' . $date . '" name="Rdate" required >';
echo '<input type = "submit" name = "submit" value = "Next">';
echo '<div id = "fields"></div>';
echo '</form>';
include('footer.html');
?>