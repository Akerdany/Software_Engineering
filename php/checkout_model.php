<?php
require_once 'connection.php';
class checkoutmodel {
    function __construct() {
    }
    public static function Display() {

        // $DB = new DbConnection();
        $DB     = DbConnection::getInstance();
        $sql    = 'SELECT * from paymentmethod WHERE isDeleted = "0"';
        $result = mysqli_query($DB->getdbconnect(), $sql);
        $array  = array();
        while ($row = mysqli_fetch_array($result)) {
            array_push($array, $row);
        }
        return $array;
    }
    public static function DisplayM($paymentMethodId) {
        // $DB = new DbConnection();
        $DB = DbConnection::getInstance();

    }
}
?>