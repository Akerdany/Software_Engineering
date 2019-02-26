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
                    .'</tr>';
            }
            echo '</table>';
            echo '<a href= "addEvent.php" class="button">Add Court</a><br><br>';
            echo '<a href= "deleteEvent.php" class="button">Delete Court</a>';
    }
    public static function AddEvent($E)
    {
        $DB = new DbConnection();
        $conn=$DB->getdbconnect();
        $Q="INSERT INTO `events` (`name`, `date`, `details`) VALUES ('$E->Name', '$E->Date', '$E->Details')";
        mysqli_query($conn,$Q);
    }
    public static function Update()
    {
        $DB = new DbConnection();
        $conn=$DB->getdbconnect();
        $Q="UPDATE `events` SET `name` = '$Name', `Date` = '$Date', `Details` = '$Details' WHERE `ID` = '$ID' ";
        mysqli_query($conn,$Q);
    }
    public static function Delete()
    {
        $DB = new DbConnection();
        $conn=$DB->getdbconnect();
        $Q="DELETE FROM `users` WHERE `ID` = '$ID'";
        mysqli_query($conn,$Q);
    }
}
?>