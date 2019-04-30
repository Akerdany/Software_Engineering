<?php
require_once "connection.php";
require_once "factoryClass.php";

class Reservationview {
    function __construct() {
    }
    public static function Display($array) {

        echo '<table class = "displaytables">';
        echo '<tr>'
            . '<th>Court Number</th>'
            . '<th>Date</th>'
            . '<th>Reserver First name</th>'
            . '<th>Reserver Last name</th>'
            . '<th>Start time</th>'
            . '<th>End time</th>'
            . '<th>Suppervisor first name</th>'
            . '<th>Suppervisor Lastname name</th>'
            . '</tr>';
        foreach ($array as $row) {

            // $model = new Reservationmodel();
            $model = factoryClass::create("Model", "Reservation", null);

            $row1 = $model->fetchSV($row['supervisorId']);
            echo '<tr>'
                . '<td>' . $row['courtNumber'] . '</td>'
                . '<td>' . $row['date'] . '</td>'
                . '<td>' . $row['firstName'] . '</td>'
                . '<td>' . $row['lastName'] . '</td>'
                . '<td>' . $row['startTime'] . '</td>'
                . '<td>' . $row['endTime'] . '</td>'
                . '<td>' . $row1['firstName'] . '</td>'
                . '<td>' . $row1['lastName'] . '</td>';

            echo '<td> <form action = "editR.php" method = "POST">'
                . '<button type = "submit" name = "editButton" value = "' . $row['id'] . '">Edit</button>'
                . '</form>'
                . '</tr>';
        }
        echo '</table>';

    }

}

?>