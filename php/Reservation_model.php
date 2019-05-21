<?php
require_once "connection.php";
require_once "Resevationclass.php";
class Reservationmodel {
    function __construct() {
    }
    public static function constructorR($id) {
        $DB = DbConnection::getInstance();

        $conn = $DB->getdbconnect();
        $Q    = "SELECT * FROM reservation WHERE id='" . $id . "'";
        $r    = mysqli_query($conn, $Q);
        if ($row = mysqli_fetch_array($r)) {
            return $row;
        }

    }
    public static function constructorRD($ID) {
        $DB = DbConnection::getInstance();

        $conn = $DB->getdbconnect();
        $Q2   = "SELECT * FROM reservationdetails WHERE id='" . $ID . "'";
        $r    = mysqli_query($conn, $Q2);
        if ($row = mysqli_fetch_array($r)) {
            return $row;
        }
    }
    public static function Display($this_page_first_result,$results_per_page) {
        $DB = DbConnection::getInstance();

        $conn = $DB->getdbconnect();
        $Q    = "SELECT reservation.id,court.courtNumber,user.firstName,user.lastName,reservationdetails.startTime,reservationdetails.endTime,reservationdetails.supervisorId,reservationdetails.date,reservationdetails.status
      FROM reservation
      INNER JOIN user ON reservation.userId=user.id
      INNER JOIN court ON reservation.courtId=court.id
      INNER JOIN reservationdetails ON reservation.reservationDetailsId=reservationdetails.id ";
        $result = mysqli_query($conn, $Q);
        $array  = array();
        while ($row = mysqli_fetch_array($result)) {

            array_push($array, $row);
        }
        return $array;
    }
    public static function insertReserve($R) {
        $DB = DbConnection::getInstance();

        $conn = $DB->getdbconnect();

        $Q1 = "INSERT INTO `reservationdetails` (`date`, `startTime`, `endTime`, `supervisorId`, `type`, `cost`) VALUES ( '$R->date', '$R->startTime', '$R->endTime', '$R->supervisorId', '$R->type', '$R->cost') ";
        mysqli_query($conn, $Q1);
        $Q2 = "SELECT MAX(id) from reservationdetails";
        $r  = mysqli_query($conn, $Q2);
        if ($row = mysqli_fetch_assoc($r)) {
            $RDID = $row;
        }
        $Q3 = "INSERT INTO `reservation` ( `userId`, `courtId`, `reservationDetailsId`) VALUES ( '$R->UID', '$R->courtID', '$R->RDID')";
        mysqli_query($conn, $Q3);
    }
    public static function Delete($ID, $RDID) {
        $DB = DbConnection::getInstance();

        $conn = $DB->getdbconnect();
        $Q    = "DELETE FROM `reservation` WHERE `ID` = '$ID'";
        $Q1   = "DELETE FROM `reservationdetails` WHERE `ID` = '$RDID'";
        mysqli_query($conn, $Q);
        mysqli_query($conn, $Q1);

    }
    public static function fetchSV($ID) {
        $DB = DbConnection::getInstance();

        $conn    = $DB->getdbconnect();
        $Q1      = "SELECT `firstName`,`lastName` FROM `user` WHERE `id`=" . $ID;
        $result1 = mysqli_query($conn, $Q1);
        $row1    = mysqli_fetch_array($result1);
        return $row1;

    }
    public static function personalR($ID) {
        $DB = DbConnection::getInstance();

        $conn = $DB->getdbconnect();
        $Q    = "SELECT reservation.id,court.courtNumber,user.firstName,user.lastName,reservationdetails.startTime,reservationdetails.endTime,reservationdetails.supervisorId,reservationdetails.date,reservationdetails.status
      FROM reservation
      INNER JOIN user ON reservation.userId= user.id
      INNER JOIN court ON reservation.courtId=court.id
      INNER JOIN reservationdetails ON reservation.reservationDetailsId=reservationdetails.id
      WHERE reservation.userId = ".$ID;
        $result = mysqli_query($conn, $Q);
        $array  = array();
        while ($row = mysqli_fetch_array($result)) {

            array_push($array, $row);
        }
        return $array;

    }
    public function approveReservation($id) {
        $DB = DbConnection::getInstance();

        $reservationDetailsId = "SELECT * FROM reservation WHERE id='$id'";
        $result               = mysqli_query($DB->getdbconnect(), $reservationDetailsId);
        $row                  = mysqli_fetch_assoc($result);
        $query                = "UPDATE reservationdetails SET status=1 WHERE id='" . $row['reservationDetailsId'] . "'";
        $result2              = mysqli_query($DB->getdbconnect(), $query);
    }
    public function declineReservation($id) {
        $DB = DbConnection::getInstance();

        $reservationDetailsId = "SELECT * FROM reservation WHERE id='$id'";
        $result               = mysqli_query($DB->getdbconnect(), $reservationDetailsId);
        $row                  = mysqli_fetch_assoc($result);
        $query                = "UPDATE reservationdetails SET status=0 WHERE id='" . $row['reservationDetailsId'] . "'";
        $result2              = mysqli_query($DB->getdbconnect(), $query);
    }
    public static function getNumberofRs() {
        $DB     = DbConnection::getInstance();
        $sql    = "SELECT id FROM `reservation`";
        $result = mysqli_query($DB->getdbconnect(), $sql);
        $rowcount = mysqli_num_rows($result);
        return $rowcount;
    }
}

?>