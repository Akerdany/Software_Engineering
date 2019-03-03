<script>
function getForm(pmId) {
    
    var xmlhttp = new XMLHttpRequest();
    xmlhttp.onreadystatechange = function() {
    if (this.readyState == 4 && this.status == 200) {
        document.getElementById("fields").innerHTML = ''; //empty form before appending
        document.getElementById("fields").innerHTML += this.responseText; // append retrieved fields
        }
    };
    xmlhttp.open("GET", "Rbuilder.php?id=" + pmId, true); //request to getFormFields with paymentMethodId to get the fields
    xmlhttp.send();
   
}


</script>
<?php

require_once('connection.php');
require('Resevationclass.php');
echo '<link href="../css/temp.css" rel="stylesheet" type="text/css">';
$DB = new DbConnection();

$sqlcourt = 'SELECT * FROM `court` ';
$resultcourt = mysqli_query($DB->getdbconnect(), $sqlcourt);
            
$sqloptions = 'SELECT * from courtdetails';
$resultoptions = mysqli_query($DB->getdbconnect(), $sqloptions);

            echo '<form action = "" method = "POST">
                    <label>court </label>
                    <select name = "court" class = "select" onchange = "getForm(this.value)"><option>Choose</option>';
            while($row = mysqli_fetch_array($resultcourt))
            {
               
                echo '<option value = "'.$row['id'].'">'.$row['courtNumber'].'</option>';
            }
            echo '</select> <br>';
           echo'<div id = "fields"></div>';

           
            echo '<input type = "submit" name = "submit" value = "Add">
            </form>';
        
// if (isset($_POST['submit']))
// {
//     $court = new Court();

//     $court->courtNumber = $_POST['courtnumber'];
//     $court->pricePerHour = $_POST['courtprice'];
//     $court->sportid = $_POST['sport'];
//     $court->specsid = $_POST['specs'];
//     $court->addCourt($court);
// }

?>