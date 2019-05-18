<?php
require_once('CourtModel.php');

class CourtView
{
    public function displayCourts($courtsArray, $numOfPages, $currentPage)
    {
        echo '<table class = "displaytables">';
            echo '<tr>'
                .'<th>Sport</th>'
                .'<th>Court No.</th>'
                .'<th>Hourly Price</th>'
                .'<th>Court Specs</th>'
                .'<th>Edit Court</th>'
                .'<th>Delete Court</th>'
                .'</tr>';
    if(!empty($courtsArray))
    {
        for($i = 0; $i < count($courtsArray); $i++)
        {
            echo '<tr>'
                    .'<td>'.$courtsArray[$i]['name'].'</td>'
                    .'<td>'.$courtsArray[$i]['courtNumber'].'</td>'
                    .'<td>'.$courtsArray[$i]['price'].'</td>'
                    .'<td>'.$courtsArray[$i]['specs'].'</td>'
                    .'<td> <form action = "CourtController.php" method = "POST">'
                    .'<button type = "submit" name = "editButton" value = "'.$courtsArray[$i]['id'].'">Edit</button>'
                    .'</form></td>'
                    .'<td> <form action = "CourtController.php" method = "POST">'
                    .'<button type = "submit" name = "deleteButton" value = "'.$courtsArray[$i]['id'].'">Delete</button>'
                    .'</form></td>'
                    .'</tr>';
        }
        echo '<tr style = "background-color: white;">';
        echo '<td align = "center" colspan = "6">';
        echo '<div class = "pagination">';
        for($page=1; $page<=$numOfPages; $page++) {
            if($page == $currentPage)
            {
                echo '<a href="CourtController.php?p=' . $page . '" class = "active">' . $page . '</a> ';
            }
            else
            {
                echo '<a href="CourtController.php?p=' . $page . '">' . $page . '</a> ';
            }
        }
        echo '</div>';
        echo '</td>';
        echo '</tr>';
    }
            echo '</table>';
            echo '<br><br><form action = "CourtController.php" method = "POST">';
            echo '<button type= "submit" name = "addButton">Add Court</button>'
                .'</form>';
            
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