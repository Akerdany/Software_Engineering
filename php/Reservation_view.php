<?php
require_once "connection.php";
require_once "factoryClass.php";

class Reservationview {
    function __construct() {
    }
    public static function Display($array,$numOfPages, $currentPage) {
        if(!empty($_SESSION))
        {
        if (!empty($_SESSION['userType']) && $_SESSION['userType'] == 1) {
            $action = true;
        } else {
            $action = false;
        }
        echo'<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    
        <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/bs4/jq-3.3.1/dt-1.10.18/b-1.5.6/datatables.min.css"/>
        <script type="text/javascript" src="https://cdn.datatables.net/v/bs4/jq-3.3.1/dt-1.10.18/b-1.5.6/datatables.min.js"></script>';
        echo '<div id="myDiv" style="width:70%">';
        echo '<table id="table_id" class = "table text-center table-dark table-striped table-hover table-bordered">';
        echo ' <thead><tr>'
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
        
            echo '</tr> </thead><tbody>';
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
                    echo '<td> <form action = "Resevationclass.php" method = "POST">'
                        . '<button class="btn btn-lg btn-danger" type = "submit" name = "approve" value = "' . $row['id'] . '">Approve</button>'
                        . '</form>';
                } else {
                    echo '<td> <form action = "Resevationclass.php" method = "POST">'
                        . '<button class="btn btn-lg btn-danger" type = "submit" name = "decline" value = "' . $row['id'] . '">Decline</button>'
                        . '</form>';
                }
            }
            echo '</form>'
                . '</tr>';
        }
        echo '<tbody>';
        
        
        echo '</table>';
        echo'</div>';
        echo"<script>
        $(document).ready( function () {
            $('#table_id').DataTable();
        } );
        </script>";
    }
}

    public static function DisplayPR($array) {

        echo'<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    
        <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/bs4/jq-3.3.1/dt-1.10.18/b-1.5.6/datatables.min.css"/>
        <script type="text/javascript" src="https://cdn.datatables.net/v/bs4/jq-3.3.1/dt-1.10.18/b-1.5.6/datatables.min.js"></script>';
        if(!empty($_SESSION))
        {
        echo '<div id="myDiv" style="width:70%">';
        echo '<table id="table_id" class = "table text-center table-dark table-striped table-hover table-bordered">';
        echo ' <thead><tr>'
            . '<th>Court Number</th>'
            . '<th>Date</th>'
            . '<th>Reserver First name</th>'
            . '<th>Reserver Last name</th>'
            . '<th>Start time</th>'
            . '<th>End time</th>'
            . '<th>Suppervisor first name</th>'
            . '<th>Suppervisor Last name</th>'
            . '<th>Reservation Status</th>'
            . '</tr> </thead><tbody>';
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
                echo '</tr>';
        }
        echo '<tbody>';
        
        
        echo '</table>';
        echo'</div>';
        echo"<script>
        $(document).ready( function () {
            $('#table_id').DataTable();
        } );
        </script>";
    }
    }
    


}

?>
