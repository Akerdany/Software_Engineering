<?php
require("connection.php");
class events 
{
    public $ID;
    public $Name;
    public $Date;
    public $Details;
    function __construct($ID)
    {
        $DB = new DbConnection();
        $conn=$DB->getdbconnect();
         $Q = "SELECT * FROM events WHERE id='".$ID."'";
         $r=mysqli_query($conn,$Q);
         if($row=mysqli_fetch_array($r))
         {
             $this->Name=$row['name'];
             $this->Date=$row['date'];
             $this->Details=$row['details'];
         }
    }
    static function displayEvents()
    {
        $DB = new DbConnection();
        $conn = $DB->getdbconnect();
        $sql = 'SELECT id, name, date, details FROM events';
        $result = mysqli_query($DB->getdbconnect(), $sql);
        echo '<link href="../css/temp.css" rel="stylesheet" type="text/css">';
        echo '<table class = "displaytables">';
            echo '<tr>'
                .'<th>Event Name</th>'
                .'<th>Event Date</th>'
                .'<th>Event Details</th>'
                .'<th>Edit Event</th>'
                .'<th>Delete Event</th>'
                .'</tr>';
            while($row = mysqli_fetch_array($result))
            {
                echo '<tr>'
                    .'<td>'.$row['name'].'</td>'
                    .'<td>'.$row['date'].'</td>'
                    .'<td>'.$row['details'].'</td>'
                    .'<td> <form action = "editEvent.php" method = "POST">'
                    .'<button type = "submit" name = "editButton" value = "'.$row['id'].'">Edit</button>'
                    .'</form>'
                    .'<td> <form action = "deleteEvent.php" method = "POST">'
                    .'<button class = "button" type = "submit" name = "deleteButton" value = "'.$row['id'].'">Delete</button>'
                    .'</form>'
                    .'</tr>';
            }
            echo '</table>';
            echo '<a href= "addEvent.php" class="button">Add Event</a><br><br>';
    }
    public static function AddEvent($E)
    {
        $DB = new DbConnection();
        $conn=$DB->getdbconnect();
        $Q="INSERT INTO `events` (`name`, `date`, `details`, `isDeleted`) VALUES ('$E->Name', '$E->Date', '$E->Details', '0')";
        mysqli_query($conn,$Q);
        header('Location: displayEvents.php');
    }
    public static function Update($E)
    {
        $DB = new DbConnection();
        $conn=$DB->getdbconnect();
        $Q="UPDATE `events` SET `name` = '$E->Name', `Date` = '$E->Date', `Details` = '$E->Details' WHERE `ID` = '$E->ID' ";
        mysqli_query($conn,$Q);
        header('Location: displayEvents.php');
    }
    public static function Delete($ID)
    {
        $DB = new DbConnection();
        $conn=$DB->getdbconnect();
        $Q="DELETE FROM `events` WHERE `id` = '$ID'";
        mysqli_query($conn,$Q);
        header('Location: displayEvents.php');
    }
}
?>