<?php
require_once('CourtModel.php');
require_once('classes.php');

class CourtView
{
    public function displayCourts($courtsArray, $numOfPages, $currentPage)
    {
        echo'<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    
        <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/bs4/jq-3.3.1/dt-1.10.18/b-1.5.6/datatables.min.css"/>
        <script type="text/javascript" src="https://cdn.datatables.net/v/bs4/jq-3.3.1/dt-1.10.18/b-1.5.6/datatables.min.js"></script>';
        $user = new User();
        if(!empty($_SESSION))
        {
        echo '<div id="myDiv" style="width:70%">';
        echo '<table id="table_id" class = "table text-center table-dark table-striped table-hover table-bordered">';
            echo '<thead><tr>'
                .'<th>Sport</th>'
                .'<th>Court No.</th>'
                .'<th>Hourly Price</th>'
                .'<th>Court Specs</th>';
                if($user->getPermission('editcourt'))
                {
                    echo '<th>Edit Court</th>';
                }
                if($user->getPermission('deletecourt'))
                {
                    echo '<th>Delete Court</th>';
                }
                echo '</tr></thead><tbody>';
    if(!empty($courtsArray))
    {
        for($i = 0; $i < count($courtsArray); $i++)
        {
            echo '<tr>'
                    .'<td>'.$courtsArray[$i]['name'].'</td>'
                    .'<td>'.$courtsArray[$i]['courtNumber'].'</td>'
                    .'<td>'.$courtsArray[$i]['price'].'</td>'
                    .'<td>'.$courtsArray[$i]['specs'].'</td>';
                    if($user->getPermission('editcourt')){
                    echo '<td> <form action = "CourtController.php" method = "POST">'
                    .'<button type = "submit" name = "editButton" value = "'.$courtsArray[$i]['id'].'">Edit</button>'
                    .'</form></td>';
                    }
                    if($user->getPermission('deletecourt')){
                    echo '<td> <form action = "CourtController.php" method = "POST">'
                    .'<button type = "submit" name = "deleteButton" value = "'.$courtsArray[$i]['id'].'">Delete</button>'
                    .'</form></td>';
                    }
                    echo '</tr>';
        }
        echo'</tbody>';
       
    }
    echo '</table>';
    echo '</div>';
    echo"<script>
    $(document).ready( function () {
        $('#table_id').DataTable();
    } );
    </script>";

    if($user->getPermission('addcourt')){
            echo '<br><br><form action = "CourtController.php" method = "POST">';
            echo '<button type= "submit" name = "addButton">Add Court</button>'
                .'</form>';
    }
}
            
    }
    public static function Undisplay() {
        echo '<script>
                    var myNode = document.getElementById("myDiv");
                while (myNode.firstChild) {
                    myNode.removeChild(myNode.firstChild);
                }
                    </script>';

    }
    public function addCourtForm($sports, $specs)
    {
        echo '<form action = "CourtController.php" method = "POST">
                    <label>Sport </label>
                    <select name = "sport" class = "select">';
            for($i = 0; $i < count($sports); $i++)
            {
                echo '<option value = "'.$sports[$i]['id'].'">'.$sports[$i]['name'].'</option>';
            }
            echo '</select> <br>';
            echo '<label>Court Number </label>
                <input type = "number" min = "1" max = "1000" name = "courtnumber" required><br>
                <label>Hourly Price</label>
                <input type = "number" min = "1" max = "5000" name = "courtprice" required> <br>
                <label>Court Specs </label>
                <select name = "specs">';

            for($i = 0; $i < count($specs); $i++)
            {
                $specId = $specs[$i]['id'];
                $spec = $specs[$i]['specs'];
                echo '<option value = "' .$specId. '">'. $spec .'</option>';
            }
            echo '</select><br>';
            echo '<input type = "submit" name = "addCourt" value = "Add">
            </form>';
    }
    public static function editCourtView($sports, $specs, $court)
    {
        echo '<form action = "" method = "POST" class = "form-basic">
                    <label>Sport </label>
                    <select name = "sport" value = "'.$court->sports.'">';
            for($i = 0; $i < count($sports); $i++)
            {
                echo '<option value = "'.$sports[$i]['id'].'">'.$sports[$i]['name'].'</option>';
            }
            echo '</select> <br>';
            echo '<label>Court Number </label>
                <input type = "number" min = "1" max = "1000" name = "courtnumber" value = "'.$court->courtNumber.'" required><br>
                <label>Hourly Price</label>
                <input type = "number" min = "1" max = "5000" name = "courtprice" value = "'.$court->pricePerHour.'" required> <br>
                <label>Court Specs </label>
                <select name = "specs" value = "'.$court->specs.'">';

            for($i = 0; $i < count($specs); $i++)
            {
                $specId = $specs[$i]['id'];
                $spec = $specs[$i]['specs'];
                echo '<option value = "' .$specId. '">'. $spec .'</option>';
            }
            echo '</select><br>';
            echo '<input type = "submit" name = "editCourt" value = "Submit Edits">
                  <input type = "hidden" name = "courtid" value = "'.$court->id.'">'
                .'</form>';
    }
}

?>