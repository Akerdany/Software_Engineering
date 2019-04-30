<?php
require_once 'classes.php';
require_once 'checkout_model.php';
require_once 'CourtView.php';
require_once 'CourtModel.php';
require_once 'EventView.php';
require_once 'EventModel.php';
require_once "OptionsModel.php";
require_once "OptionsView.php";
require_once "PmModel.php";
require_once "PmView.php";
require_once "Reservation_model.php";
require_once 'Resevationclass.php';

class factoryClass {
    public function __construct() {
    }

    public function create($type, $className, $attribute) {
        if ($type == "Model") {
            if ($className == "User") {
                return new User();
            } elseif ($className == "Checkout") {
                return new checkoutmodel();
            } elseif ($className == "Court") {
                return new CourtModel();
            } elseif ($className == "Event") {
                return new EventModel();
            } elseif ($className == "Options") {
                return new optionsModel($attribute);
            } elseif ($className == "Pm") {
                return new PmModel($attribute);
            } elseif ($className == "Reservation") {
                return new Reservationmodel();
            } elseif ($className == "reservation") {
                return new reservation($attribute);
            } else {
                return null;
            }
        } elseif ($type == "View") {
            if ($className == "Court") {
                return new CourtView();
            } elseif ($className == "Event") {
                return new EventView();
            } elseif ($className == "Options") {
                return new optionsView();
            } elseif ($className == "Pm") {
                return new PmView();
            } elseif ($className == "Reservation") {
                return new Reservationview();
            } else {
                return null;
            }
        } elseif ($type == "Controller") {
            if ($className == "Options") {
                return new optionsController();
            } else {
                return null;
            }
        } else {
            return null;
        }
    }
}

?>