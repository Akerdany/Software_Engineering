<?php
require_once('connection.php');
require('courtClass.php');
echo '<link href="../css/temp.css" rel="stylesheet" type="text/css">';

$DB = new DbConnection();

$sql = 'SELECT court.id, court.courtNumber, sports.name, courtdetails.specs from court 
            INNER JOIN sports ON sports.id = court.sportId
            INNER JOIN ccd ON ccd.courtId = court.id
            INNER JOIN courtdetails ON courtdetails.id = ccd.courtDetailsId';
$result = mysqli_query($DB->getdbconnect(), $sql);

echo '<form action = "" method = "POST">'
    .'<label>Select court</label>'
    .'<select name = "court">';
while($row = mysqli_fetch_array($result) )
{
    echo '<option value = "'.$row['id'].'">'.'Court ID: '.$row['id'].' Court Number: '.$row['courtNumber'].' Sport: '
    .$row['name'].' Court Specs: '.$row['specs'].'</option>';

}
echo '</select>'
    .'<br><input type = "submit" name = "submit" value = "Delete Court">'
    .'</form>';


if (isset($_POST['submit']))
{
    $court = new Court();
    $id = $_POST['court'];
    $court->deleteCourt($id);
}

?>