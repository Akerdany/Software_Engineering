<?php
require_once 'connection.php';

$DB = DbConnection::getInstance();

if (isset($_POST['action'])) {
    echo "<select name='notifier' required>";
    echo "<option value=0>Choose</option>";

    $sql = mysqli_query($DB->getdbconnect(), "SELECT * FROM notifiers");
    while ($row = mysqli_fetch_array($sql)) {
        $valueId = $row['id'];
        $value   = $row['type'];
        echo '<option value="' . $valueId . '">' . $value . '</option>';
    }
    echo "</select><br>";
}

?>