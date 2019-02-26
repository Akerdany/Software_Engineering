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
    static function AddEvent($E)
    {
        $DB = new DbConnection();
        $conn=$DB->getdbconnect();
        $Q="INSERT INTO `users` (`name`, `date`, `details`) VALUES ('$E->name', '$E->date', '$E->details')";
    }
    static function Update()
    {
        $DB = new DbConnection();
        $conn=$DB->getdbconnect();
        $Q="UPDATE `users` SET `name` = '$Name', `Date` = '$Date', `Details` = '$Details' WHERE `ID` = '$ID' ";
        mysqli_query($conn,$Q);
    }
    static function Delete()
    {
        $DB = new DbConnection();
        $conn=$DB->getdbconnect();
        $Q="DELETE FROM `users` WHERE `ID` = '$ID'";
        mysqli_query($conn,$Q);
    }
?>