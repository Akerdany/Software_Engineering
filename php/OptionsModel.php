<?php

include_once "connection.php";
class optionsModel {
    public $optionsID;
    public $optionsName;
    public $optionsType;

    public function __construct($id) {
        $DB   = DbConnection::getInstance();
        $conn = $DB->getdbconnect();
        $Q    = 'SELECT * From options Where isDeleted=0 AND id=' . $id;
        $r    = mysqli_query($conn, $Q);
        if ($row = mysqli_fetch_array($r)) {
            $this->optionsID   = $row['id'];
            $this->optionsName = $row['name'];
            $this->optionsType = $row['type'];
        }
    }
    public static function displayOptionsM() {
        $DB     = DbConnection::getInstance();
        $conn   = $DB->getdbconnect();
        $sql    = 'SELECT id FROM options Where isDeleted=0';
        $result = mysqli_query($conn, $sql);
        $i      = 0;
        $data   = [];
        while ($row = mysqli_fetch_assoc($result)) {
            $obj      = new optionsModel($row['id']);
            $data[$i] = $obj;
            $i++;
        }
        return $data;
    }

    public static function addOptionM($O) {
        $DB   = DbConnection::getInstance();
        $conn = $DB->getdbconnect();
        $sql  = "INSERT INTO `options` (`name`, `type`,`isDeleted`) VALUES ('$O->optionsName', '$O->optionsType',0)";
        mysqli_query($conn, $sql);
    }

    public static function deleteOptionM($optionID) {
        $DB   = DbConnection::getInstance();
        $conn = $DB->getdbconnect();
        $Q    = "UPDATE `options` SET `isDeleted`= 1 WHERE `id` = '$optionID'";
        mysqli_query($conn, $Q);
    }

    public static function updateOption($O) {
        $DB   = DbConnection::getInstance();
        $conn = $DB->getdbconnect();
        $Q    = "UPDATE `options` SET `name` = '$O->optionsName' , `type`='$O->optionsType' WHERE `id` = '$O->optionsID' ";
        mysqli_query($conn, $Q);
    }
    public static function getIdenticalName($oName) {
        $DB     = DbConnection::getInstance();
        $sql    = "SELECT id FROM `options` WHERE `name`= '$oName'";
        $result = mysqli_query($DB->getdbconnect(), $sql);
        $rowcount = mysqli_num_rows($result);
        return $rowcount;
    }
    public static function getNumberofOptions() {
        $DB     = DbConnection::getInstance();
        $sql    = "SELECT id FROM `options` Where isDeleted=0";
        $result = mysqli_query($DB->getdbconnect(), $sql);
        $rowcount = mysqli_num_rows($result);
        return $rowcount;
    }
}
?>
