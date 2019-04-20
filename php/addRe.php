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
var year = new Date().getFullYear();
alert(year);
document.getElementById('date').setAttribute("min", year + "-01-01");
document.getElementById('date').setAttribute("max", year + "-12-31");

</script>
<?php
include('navbar.php');
require_once('connection.php');
require('Resevationclass.php');
echo '<link href="../css/temp.css" rel="stylesheet" type="text/css">';
$DB = new DbConnection();

$sqlcourt = 'SELECT * FROM `court`WHERE isDeleted=0 ';
$resultcourt = mysqli_query($DB->getdbconnect(), $sqlcourt);
            
$sqloptions = 'SELECT * from courtdetails';
$resultoptions = mysqli_query($DB->getdbconnect(), $sqloptions);

            echo '<form action = "table.php" method = "POST">
                    <label>Choose court </label>
                    <select id = "court" name = "court" class = "select" "><option>Choose</option>';
            while($row = mysqli_fetch_array($resultcourt))
            {
                echo '<option value = "'.$row['id'].'">Court '.$row['courtNumber'].' / '.$row['price'].' EGP</option>';
            }
            echo '</select> <br>';
            $date=date("Y-m-d");
            echo'<input type="date" min="'.$date.'" name="Rdate" >';
            echo '<input type = "submit" name = "submit" value = "Next">
            ';
            echo'<div id = "fields"></div>';


?>