<?php
require_once "connection.php";
require_once "factoryClass.php";

class Reservationview {
    function __construct() {
    }
    public static function Display($array,$numOfPages, $currentPage) {

        if (!empty($_SESSION['userType']) && $_SESSION['userType'] == 1) {
            $action = true;
        } else {
            $action = false;
        }
        echo '<table class = "table text-center table-dark table-striped table-hover table-bordered">';
        echo '<tr>'
            . '<th>Court Number</th>'
            . '<th>Date</th>'
            . '<th>Reserver First name</th>'
            . '<th>Reserver Last name</th>'
            . '<th>Start time</th>'
            . '<th>End time</th>'
            . '<th>Suppervisor first name</th>'
            . '<th>Suppervisor Last name</th>'
            . '<th>Reservation Status</th>';
        if ($action) {
            echo '<th>Action</th>';
        }
        
            echo '</tr>';
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
            if ($row['status'] == 0) {
                echo '<td>Pending</td>';
            } else {
                echo '<td>Approved</td>';
            }
            if ($action) {
                if ($row['status'] == 0) {
                    echo '<td> <form action = "Reservation_controller.php" method = "POST">'
                        . '<button class="btn btn-lg btn-danger" type = "submit" name = "approve" value = "' . $row['id'] . '">Approve</button>'
                        . '</form>';
                } else {
                    echo '<td> <form action = "Reservation_controller.php" method = "POST">'
                        . '<button class="btn btn-lg btn-danger" type = "submit" name = "decline" value = "' . $row['id'] . '">Decline</button>'
                        . '</form>';
                }
            }
            echo '</form>'
                . '</tr>';
        }
        echo '<tr class="text-white">';
        echo '<td align = "center" colspan = "6">';
        echo '<div class = "pagination">';
        for($page=1; $page<=$numOfPages; $page++) {
            if($page == $currentPage)
            {
                echo '<a href="displayRe.php?p=' . $page . '" class = "active">' . $page . '</a> ';
            }
            else
            {
                echo '<a class = "btn btn-sm btn-primary" href="displayRe.php?p=' . $page . '">' . $page . '</a> ';
            }
        }
        echo '</div>';
        echo '</td>';
        echo '</tr>';
        echo '</table>';

    }

}

?>
