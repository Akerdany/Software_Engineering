<?php
require_once("connection.php");
class Reservationview 
 {
    function __construct()
    {
    }
    public static function Display($array)
    {
        $DB = new DbConnection();
        $conn=$DB->getdbconnect();
        echo '<table class = "displaytables">';
         echo '<tr>'
             .'<th>Court Number</th>'
             .'<th>Date</th>'
             .'<th>Reserver First name</th>'
             .'<th>Reserver Last name</th>'
             .'<th>Start time</th>'
             .'<th>End time</th>'
             .'<th>Suppervisor first name</th>'
             .'<th>Suppervisor Lastname name</th>'
             .'</tr>';
         foreach($array as  $row)
         {
            $Q1="SELECT `firstName`,`lastName` FROM `user` WHERE `id`=".$row['supervisorId'];
            $result1 = mysqli_query( $conn, $Q1);
            $row1 = mysqli_fetch_array($result1);
            echo '<tr>'
                .'<td>'.$row['courtNumber'].'</td>'
                .'<td>'.$row['date'].'</td>'
                .'<td>'.$row['firstName'].'</td>'
                .'<td>'.$row['lastName'].'</td>'
                .'<td>'.$row['startTime'].'</td>'
                .'<td>'.$row['endTime'].'</td>'
                .'<td>'.$row1['firstName'].'</td>'
                .'<td>'.$row1['lastName'].'</td>'
                .'<td> <form action = "editCourt.php" method = "POST">'
                .'<button type = "submit" name = "editButton" value = "1">Edit</button>'
                .'</form>'
                .'</tr>';
        }
        echo '</table>';

    }
} 
        
?>