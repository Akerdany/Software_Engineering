<?php

include_once "connection.php";
class PmModel {
    public $pmID;
    public $optionsID;
    public $optionsName;
    public $selectedOptionsId;
    public $methodName;
    public $priority;

    public function __construct($id) {
        $DB   = DbConnection::getInstance();
        $conn = $DB->getdbconnect();
        $Q    = 'SELECT pm.id pmID, pm.name pmname, o.name constraints, so.id soid,so.priority prio FROM paymentmethod pm
          INNER JOIN selectedoptions so ON so.paymentid=pm.id
          INNER JOIN options o ON o.id=so.optionId
          WHERE  pm.isDeleted=0 AND o.isDeleted=0 AND pm.id=' . $id . '
          ORDER BY so.priority ASC';
        $r  = mysqli_query($conn, $Q);
        $r2 = mysqli_query($conn, $Q);
        if ($row = mysqli_fetch_array($r)) {
            $this->pmID       = $id;
            $this->methodName = $row['pmname'];
            $j                = 0;
            while ($row = mysqli_fetch_array($r2)) {
                $this->optionsName[$j]       = $row['constraints'];
                $this->selectedOptionsId[$j] = $row['soid'];
                $this->priority[$j]          = $row['prio'];
                $j++;
            }

        }
    }
    public static function displayMethodsM() {
        $DB     = DbConnection::getInstance();
        $conn   = $DB->getdbconnect();
        $sql    = 'SELECT pm.id,pm.name FROM paymentmethod pm Where isDeleted=0';
        $result = mysqli_query($conn, $sql);
        $i      = 0;
        $data   = [];
        while ($row = mysqli_fetch_assoc($result)) {
            $obj = new PmModel($row['id']);
            $data[$i] = $obj;
            $i++;
        }
        return $data;
    }

    public static function deleteMethodM($paymentID) {
        $DB   = DbConnection::getInstance();
        $conn = $DB->getdbconnect();
        $Q    = "UPDATE `paymentmethod`  SET `isDeleted`= 1 WHERE `id` = '$paymentID'";
        mysqli_query($conn, $Q);
    }

    public static function addMethodM($PM) {
        $DB   = DbConnection::getInstance();
        $conn = $DB->getdbconnect();

        $sql = "INSERT INTO `paymentmethod` (`name`, `isDeleted`) VALUES ('$PM->methodName', 0)";
        mysqli_query($conn, $sql);
    }

    public static function insertSelectedoptions($PM) {
        $DB   = DbConnection::getInstance();
        $conn = $DB->getdbconnect();
        $sql  = "INSERT INTO `selectedoptions` ( `paymentId`, `optionId`, `priority`) VALUES ( '$PM->pmID', '$PM->optionsID', '$PM->priority')";
        mysqli_query($conn, $sql);
    }

    public static function updateMethod($PM) {
        $DB   = DbConnection::getInstance();
        $conn = $DB->getdbconnect();
        $Q    = "UPDATE `paymentmethod` SET `name` = '$PM->methodName' WHERE `id` = '$PM->pmID' ";
        mysqli_query($conn, $Q);
    }
    public static function updateSelectedoptions($PM) {
        $DB   = DbConnection::getInstance();
        $conn = $DB->getdbconnect();
        $sql  = "UPDATE `selectedoptions` SET `priority` = '$PM->priority' WHERE  `paymentId` = '$PM->pmID' AND `id` = '$PM->selectedOptionsId'";
        mysqli_query($conn, $sql);
    }
    public static function DeleteSelectedoptions($PM) {
        $DB   = DbConnection::getInstance();
        $conn = $DB->getdbconnect();
        $Q    = "DELETE FROM `selectedoptions` WHERE `paymentId` = '$PM->pmID' AND `id` = '$PM->selectedOptionsId' ";
        mysqli_query($conn, $Q);
    }
    public static function selectAllOptions() {
        $DB     = DbConnection::getInstance();
        $sql    = 'SELECT id ,name FROM options Where isDeleted=0';
        $result = mysqli_query($DB->getdbconnect(), $sql);
        $data   = [];
        $i      = 0;
        while ($row = mysqli_fetch_assoc($result)) {
            $data[$i] = $row;
            $i++;
        }
        return $data;
    }

    public static function getMaxPMid() {
        $DB   = DbConnection::getInstance();
        $conn = $DB->getdbconnect();
        $sql  = "Select Max(id) id from paymentmethod";
        $pmID;
        $result = mysqli_query($DB->getdbconnect(), $sql);
        if ($row = mysqli_fetch_assoc($result)) {
            $pmID = $row['id'];
        }

        return $pmID;
    }
    public static function selectAllselectedOptions($soID) {
        $DB     = DbConnection::getInstance();
        $sql    = "SELECT * FROM `selectedoptions` WHERE `id` = '$soID'";
        $result = mysqli_query($DB->getdbconnect(), $sql);
        $data   = [];
        $i      = 0;
        if ($row = mysqli_fetch_assoc($result)) {
            $data[$i] = $row;
        }

        return $data;
    }
    public static function getIdenticalName($PmName) {
        $DB     = DbConnection::getInstance();
        $sql    = "SELECT id FROM `paymentmethod` WHERE `name`= '$PmName'";
        $result = mysqli_query($DB->getdbconnect(), $sql);
        $rowcount = mysqli_num_rows($result);
        return $rowcount;
    }
    public static function getNumberofPMs() {
        $DB     = DbConnection::getInstance();
        $sql    = "SELECT id FROM `paymentmethod` Where isDeleted=0";
        $result = mysqli_query($DB->getdbconnect(), $sql);
        $rowcount = mysqli_num_rows($result);
        return $rowcount;
    }

}

?>
