<?php
require('Eventclass.php');
echo '<link href="../css/temp.css" rel="stylesheet" type="text/css">';
$DB = new DbConnection();
$sql = 'SELECT * from events';
$result = mysqli_query($DB->getdbconnect(), $sql);


echo '<form action = "" method = "POST">'
    .'<label>Event Name</label>'
    .'<input type = "text" name = "eventName">'
    .'<label>Event Date</label>'
    .'<input type = "date" name = "eventDate"><br>'
    .'<label>Event Details</label><br>'
    .'<textarea name = "eventDetails" rows = "15" cols = "5"></textarea>';
echo '<input type = "submit" name = "submit" value = "Add">'
    .'</form>';

if (isset($_POST['submit']))
{
    $event = new events(1);

    $event->Name = $_POST['eventName'];
    $event->Date = $_POST['eventDate'];
    $event->Details = $_POST['eventDetails'];

    
    $event->AddEvent($event);
}

?>