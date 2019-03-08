<?php
require_once('connection.php');
require('courtClass.php');
echo '<link href="../css/temp.css" rel="stylesheet" type="text/css">';
$DB = new DbConnection();



$sqlsports = 'SELECT * from sports';
$resultsports = mysqli_query($DB->getdbconnect(), $sqlsports);
            
$sqloptions = 'SELECT * from courtdetails';
$resultoptions = mysqli_query($DB->getdbconnect(), $sqloptions);

$sql = 'SELECT court.id, sports.name, court.courtNumber, court.price, courtdetails.specs 
            FROM court
            INNER JOIN sports ON court.sportId = sports.id
            INNER JOIN ccd ON court.id = ccd.courtId
            INNER JOIN courtdetails ON courtdetails.id = ccd.courtDetailsId
            WHERE court.id = "'.$_POST['editButton'].'"';
$result = mysqli_query($DB->getdbconnect(), $sql);
$r = mysqli_fetch_array($result);



            echo '<form action = "" method = "POST" class = "form-basic">
                    <label>Sport </label>
                    <select name = "sport" value = "'.$r['name'].'">';
            while($row = mysqli_fetch_array($resultsports))
            {
                echo '<option value = "'.$row['id'].'">'.$row['name'].'</option>';
            }
            echo '</select> <br>';
            echo '<label>Court Number </label>
                <input type = "text" name = "courtnumber" value = "'.$r['courtNumber'].'"><br>
                <label>Hourly Price</label>
                <input type = "text" name = "courtprice" value = "'.$r['price'].'"> <br>
                <label>Court Specs </label>
                <select name = "specs" value = "'.$r['specs'].'">';

            while($row = mysqli_fetch_array($resultoptions))
            {
                $specId = $row['id'];
                $spec = $row['specs'];
                echo '<option value = "' .$specId. '">'. $spec .'</option>';
            }
            echo '</select><br>';
            echo '<input type = "submit" name = "submit" value = "Submit Edits">
                  <input type = "hidden" name = "courtid" value = "';
                  if(isset($_POST['editButton'])){echo $_POST['editButton'];}
            echo '">'
                .'</form>';

if (isset($_POST['submit']))
{
    $court = new Court();
    
    $court->courtNumber = $_POST['courtnumber'];
    $court->pricePerHour = $_POST['courtprice'];
    $court->sportid = $_POST['sport'];
    $court->specsid = $_POST['specs'];
    $court->id = $_POST['courtid'];

    $court->editCourt($court);
}


?>