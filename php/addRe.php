<?php
require_once('connection.php');
require('Resevationclass.php');
echo '<link href="../css/temp.css" rel="stylesheet" type="text/css">';
$DB = new DbConnection();

$sqlsports = 'SELECT * from sports';
$resultsports = mysqli_query($DB->getdbconnect(), $sqlsports);
            
$sqloptions = 'SELECT * from courtdetails';
$resultoptions = mysqli_query($DB->getdbconnect(), $sqloptions);

            echo '<form action = "" method = "POST">
                    <label>Sport </label>
                    <select name = "sport" class = "select">';
            while($row = mysqli_fetch_array($resultsports))
            {
                echo '<option value = "'.$row['id'].'">'.$row['name'].'</option>';
            }
            echo '</select> <br>';
            echo '<label>Court Number </label>
                <input type = "text" name = "courtnumber"><br>
                <label>Hourly Price</label>
                <input type = "text" name = "courtprice"> <br>
                <label>Court Specs </label>
                <select name = "specs">';

            while($row = mysqli_fetch_array($resultoptions))
            {
                $specId = $row['id'];
                $spec = $row['specs'];
                echo '<option value = "' .$specId. '">'. $spec .'</option>';
            }
            echo '</select><br>';
            echo '<input type = "submit" name = "submit" value = "Add">
            </form>';

if (isset($_POST['submit']))
{
    $court = new Court();

    $court->courtNumber = $_POST['courtnumber'];
    $court->pricePerHour = $_POST['courtprice'];
    $court->sportid = $_POST['sport'];
    $court->specsid = $_POST['specs'];
    $court->addCourt($court);
}

?>