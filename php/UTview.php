<?php
echo '<link href="../css/temp.css" rel="stylesheet" type="text/css">';
class CourtView
{

public function displayUT($UT)
    {
echo '<table class = "displaytables">';
echo '<tr>'
    .'<th> User Type </th>'
    .'<th colspan="10">                permissions </th>'
    .'</tr>';
echo '<tr>'
    .'<td> Admin </td>'
    .'<td> add users </td>'
    .'<td> edit users </td>'
    .'<td> edit court </td>'
    .'<td> edit reservation </td>'
    .'<td> delete users </td>'
    .'<td> <form action = "CourtController.php" method = "POST">'
                    .'<button type = "submit" name = "editButton" value = "1">Edit</button>'
                    .'</form></td>'
                    .'<td> <form action = "CourtController.php" method = "POST">'
                    .'<button type = "submit" name = "deleteButton" value = "1">Delete</button>'
                    .'</form></td>'
    .'</tr>';
echo '<tr>'
    .'<td> Admin </td>'
    .'<td> add users </td>'
    .'<td> edit users </td>'
    .'<td> edit court </td>'
    .'<td> edit reservation </td>'
    .'<td> <form action = "CourtController.php" method = "POST">'
                    .'<button type = "submit" name = "editButton" value = "1">Edit</button>'
                    .'</form></td>'
                    .'<td> <form action = "CourtController.php" method = "POST">'
                    .'<button type = "submit" name = "deleteButton" value = "1">Delete</button>'
                    .'</form></td>'
    .'</tr>';
    echo '<tr>'
    .'<td> Admin </td>'
    .'<td> add users </td>'
    .'<td> edit users </td>'
    .'<td> edit court </td>'
    .'<td> edit reservation </td>'
    .'<td> delete reservation </td>'
    .'<td> delete users </td>'
    .'<td> <form action = "CourtController.php" method = "POST">'
                    .'<button type = "submit" name = "editButton" value = "1">Edit</button>'
                    .'</form></td>'
                    .'<td> <form action = "CourtController.php" method = "POST">'
                    .'<button type = "submit" name = "deleteButton" value = "1">Delete</button>'
                    .'</form></td>'
    .'</tr>';
    
    echo '</table>';
    }
}
?>