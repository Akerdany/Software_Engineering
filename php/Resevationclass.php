<?php
require_once "connection.php";
require_once "Reservation_model.php";
require_once "Reservation_view.php";
// Reservation_model.php
class reservation {
    public $ID;
    public $UID;
    public $courtID;
    public $RDID;
    public $date;
    public $startTime;
    public $endTime;
    public $type;
    public $cost;
    public $supervisorId;
    function __construct($ID) {
        // $model = new Reservationmodel();
        $model = factoryClass::create("Model", "Reservation", null);

        $row = $model->constructorR($ID);
        if (isset($row)) {
            $this->UID     = $row['userId'];
            $this->courtID = $row['courtId'];
            $this->RDID    = $row['reservationDetailsId'];
        }

        $row1 = $model->constructorRD($ID);
        if (isset($row1)) {
            $this->date         = $row1['date'];
            $this->startTime    = $row1['startTime'];
            $this->endTime      = $row1['endTime'];
            $this->supervisorId = $row1['supervisorId'];
            $this->type         = $row1['type'];
            $this->cost         = $row1['cost'];
        }
    }
    public static function insertReserve($R) {
        // $model = new Reservationmodel();
        $model = factoryClass::create("Model", "Reservation", null);
        $model->insertReserve($R);
    }
    public static function updateR() {
        $DB = DbConnection::getInstance();

        $conn = $DB->getdbconnect();

        $Q1 = "UPDATE `users` SET `userId` = '$this->UID', `courtId` = '$this->courtID', `reservationDetailsId` = '$this->RDID' WHERE `ID` = '$this->ID' ";
        $Q2 = "UPDATE `reservationdetails` SET `date`=$this->date,`startTime`=$this->startTime,`endTime`=$this->endTime,`supervisorId`=$this->supervisorId,`type`=$this->type,`cost`=$this->cost WHERE `ID` = '$this->RDID'";
    }
    public static function Delete() {
        // $model = new Reservationmodel();
        $model = factoryClass::create("Model", "Reservation", null);
        $model->Delete($this->ID, $this->RDID);

    }
    public static function Display($this_page_first_result,$results_per_page,$page,$number_of_pages) {

        // $model = new Reservationmodel();
        $model = factoryClass::create("Model", "Reservation", null);
        $array = $model->Display($this_page_first_result,$results_per_page);
        // $view  = new Reservationview();
        $view = factoryClass::create("View", "Reservation", null);
        $view->Display($array,$number_of_pages, $page);

    }
    public static function DisplayPR($ID) {
        // $model = new Reservationmodel();
        $model = factoryClass::create("Model", "Reservation", null);
        $array = $model->personalR($ID);
        // $view  = new Reservationview();
        $view = factoryClass::create("View", "Reservation", null);
        $view->DisplayPR($array);

    }
}

?>