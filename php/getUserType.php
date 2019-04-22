<?php
require_once 'connection.php';

$DB = new DbConnection();
$DB = DbConnection::getInstance();

if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

if (!empty($_SESSION['userType']) && $_SESSION['userType'] == 1) {
    echo "User Type: ";
    echo "<select name='userType'>";
    echo "<option value=0>Choose</option>";

    $sql = mysqli_query($DB->getdbconnect(), "SELECT * FROM usertype");
    while ($row = mysqli_fetch_array($sql)) {
        $valueId = $row['id'];
        $value   = $row['userTypeName'];
        echo '<option value="' . $valueId . '">' . $value . '</option>';
    }
    echo "</select><br>";
}
?>
