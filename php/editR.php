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


</script>
<?php
include('navbar.php');
require_once('connection.php');
require('Resevationclass.php');
echo '<link href="../css/temp.css" rel="stylesheet" type="text/css">';
$DB = new DbConnection();

$sqlcourt = 'SELECT * FROM `court`WHERE isDeleted=0 ';
$resultcourt = mysqli_query($DB->getdbconnect(), $sqlcourt);

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
































<!-- <?php
require_once('connection.php');
require('Resevationclass.php');
echo '<link href="../css/temp.css" rel="stylesheet" type="text/css">';

// $DB = new DbConnection();


// $sqlsports = 'SELECT * from court';
// $resultsports = mysqli_query($DB->getdbconnect(), $sqlsports);
            
// $sqloptions = 'SELECT * from courtdetails';
// $resultoptions = mysqli_query($DB->getdbconnect(), $sqloptions);

//             echo '<form action = "" method = "POST" class = "form-basic">
//                     <label>Sport </label>
//                     <select name = "sport">';
//             while($row = mysqli_fetch_array($resultsports))
//             {
//                 echo '<option value = "'.$row['id'].'">'.$row['name'].'</option>';
//             }
//             echo '</select> <br>';
//             echo '<label>Court Number </label>
//                 <input type = "text" name = "courtnumber"><br>
//                 <label>Hourly Price</label>
//                 <input type = "text" name = "courtprice"> <br>
//                 <label>Court Specs </label>
//                 <select name = "specs">';

//             while($row = mysqli_fetch_array($resultoptions))
//             {
//                 $specId = $row['id'];
//                 $spec = $row['specs'];
//                 echo '<option value = "' .$specId. '">'. $spec .'</option>';
//             }
//             echo '</select><br>';
//             echo '<input type = "submit" name = "submit" value = "Submit Edits">
//                   <input type = "hidden" name = "courtid" value = "';
//                   if(isset($_POST['editButton'])){echo $_POST['editButton'];}
//             echo '">'
//                 .'</form>';

// if (isset($_POST['submit']))
// {
//     $court = new Court();
    
//     $court->courtNumber = $_POST['courtnumber'];
//     $court->pricePerHour = $_POST['courtprice'];
//     $court->sportid = $_POST['sport'];
//     $court->specsid = $_POST['specs'];
//     $court->id = $_POST['courtid'];

//     $court->editCourt($court);
// }


?> -->