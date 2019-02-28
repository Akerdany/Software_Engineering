<?php
require('Eventclass.php');
echo '<link href="../css/temp.css" rel="stylesheet" type="text/css">';
$DB = new DbConnection();

$sql = 'SELECT * from events WHERE id = '.$_POST["editButton"];
$result = mysqli_query($DB->getdbconnect(), $sql);
$row = mysqli_fetch_array($result);

echo '<form action = "" method = "POST">'
    .'<label>Event Name</label>'
    .'<input type = "text" name = "eventName" value = "'.$row['name'].'">'
    .'<label>Event Date</label>'
    .'<input type = "date" name = "eventDate" value = "'.$row['date'].'"><br>'
    .'<label>Event Details</label><br>'
    .'<textarea name = "eventDetails" rows = "15" cols = "5">'.$row['details'].'</textarea>';
echo '<input type = "submit" name = "submit" value = "Submit Edits">
    .<input type = "hidden" name = "eventid" value = "';
    if(isset($_POST['editButton'])){echo $_POST['editButton'];}
    echo '">'
    .'</form>';

if (isset($_POST['submit']))
{
    $event = new events(1);
    $event->ID = $_POST['eventid'];
    $event->Name = $_POST['eventName'];
    $event->Date = $_POST['eventDate'];
    $event->Details = $_POST['eventDetails'];

    
    $event->Update($event);
}


?>