<?php
require_once "connection.php";
include_once 'Icrud.php';
class EventModel implements Icrud {
    public $ID;
    public $Name;
    public $Date;
    public $Details;
    public $isDeleted;
    public static function display($this_page_first_result, $results_per_page)
    {
        $DB = DbConnection::getInstance();
        $conn = $DB->getdbconnect();
        $sql = 'SELECT id, name, date, details FROM events WHERE `isDeleted`= 0';
        $result = mysqli_query($DB->getdbconnect(), $sql);
        $event;
        $i = 0;
        while ($row = mysqli_fetch_array($result)) {
            $event[$i] = $row;
            $i++;
        }
        if(empty($event))
        {
            return 0;
        }
        return $event;
    }

    public static function getNumberOfResults()
    {
        $DB = DbConnection::getInstance();
        $conn = $DB->getdbconnect();
        $sql = 'SELECT id, name, date, details FROM events WHERE `isDeleted`= 0';
        $result = mysqli_query($DB->getdbconnect(), $sql);
        $number_of_results = mysqli_num_rows($result);
        return $number_of_results;
    }

    public static function add($E)
    {
        $DB = DbConnection::getInstance();
        $validateSQL = 'SELECT * from events WHERE name = "'.$E->Name.'" AND date = "'.$E->Date.'" AND isDeleted = "0"';
        $validateResult = mysqli_query($DB->getdbconnect(), $validateSQL);
        if(mysqli_num_rows($validateResult) != 0)
        {
            echo '<meta http-equiv="refresh" content="0">';
            echo '<script>alert("Duplicate event");</script>';
        }
        else{
            $conn=$DB->getdbconnect();
            $Q="INSERT INTO `events` (`name`, `date`, `details`, `isDeleted`) VALUES ('$E->Name', '$E->Date', '$E->Details', '0')";
            mysqli_query($conn,$Q);
        }
    }
    public static function getEventDetails($id)
    {
        $DB = DbConnection::getInstance();
        $conn=$DB->getdbconnect();
        $q = 'SELECT * from events WHERE isDeleted=0 AND id = '.$id;
        $result = mysqli_query($conn, $q);
        $row = mysqli_fetch_array($result);
        $event = new EventModel();
        $event->Name = $row['name'];
        $event->Date = $row['date'];
        $event->Details = $row['details'];
        $event->ID      = $row['id'];
        return $event;
    }
    public static function edit($E)
    {
        $DB = DbConnection::getInstance();
        $validateSQL = 'SELECT * from events WHERE name = "'.$E->Name.'" AND date = "'.$E->Date.'" AND isDeleted = "0"';
        $validateResult = mysqli_query($DB->getdbconnect(), $validateSQL);
        if(mysqli_num_rows($validateResult) != 0)
        {
            echo '<meta http-equiv="refresh" content="0">';
            echo '<script>alert("Duplicate event");</script>';
        }
        else{
            $conn=$DB->getdbconnect();
            $Q="UPDATE `events` SET `name` = '$E->Name', `Date` = '$E->Date', `Details` = '$E->Details' WHERE `ID` = '$E->ID' ";
            mysqli_query($conn,$Q);
        }
        //header('Location: displayEvents.php');
    }
    public static function delete($ID)
    {
        $DB = DbConnection::getInstance();
        $conn=$DB->getdbconnect();
        $Q="UPDATE `events` SET `isDeleted` = '1' WHERE `ID` = '$ID' ";
        mysqli_query($conn,$Q);
        //header('Location: displayEvents.php');
    }
}
?>