<?php
require_once('EventModel.php');

class EventView
{
    public function displayEvents($events)
    {
        
        echo '<table class = "displaytables">';
            echo '<tr>'
                .'<th>Event Name</th>'
                .'<th>Event Date</th>'
                .'<th>Event Details</th>'
                .'<th>Edit Event</th>'
                .'<th>Delete Event</th>'
                .'</tr>';
            for($i = 0; $i < count($events); $i++)
            {
                echo '<tr>'
                    .'<td>'.$events[$i]['name'].'</td>'
                    .'<td>'.$events[$i]['date'].'</td>'
                    .'<td>'.$events[$i]['details'].'</td>'
                    .'<td> <form action = "EventController.php" method = "POST">'
                    .'<button type = "submit" name = "editButton" value = "'.$events[$i]['id'].'">Edit</button>'
                    .'</form>'
                    .'<td> <form action = "EventController.php" method = "POST">'
                    .'<button  type = "submit" name = "deleteButton" value = "'.$events[$i]['id'].'">Delete</button>'
                   
                    .'</form>'
                    .'</tr>';
            }
            echo '</table>';
            echo '<br><form action = "EventController.php" method = "POST">'
            .'<button type = "submit" name = "addButton">Add Event</button>'
            .'</form><br><br>';
            
    }
    public function addEventForm()
    {
        $date=date("Y-m-d");
        echo '<form action = "EventController.php" method = "POST">'
            .'<label>Event Name</label>'
            .'<input type = "text" name = "eventName">'
            .'<label>Event Date</label>'
            .'<input type = "date"min="'.$date.'" name = "eventDate"><br>'
            .'<label>Event Details</label><br>'
            .'<textarea name = "eventDetails" rows = "15" cols = "5"></textarea>';
        echo '<input type = "submit" name = "addEvent" value = "Add">'
            .'</form>';
    }
    public function editEventForm($event)
    {
        echo '<form action = "EventController.php" method = "POST">'
            .'<label>Event Name</label>'
            .'<input type = "text" name = "eventName" value = "'.$event->Name.'">'
            .'<label>Event Date</label>'
            .'<input type = "date" name = "eventDate" value = "'.$event->Date.'"><br>'
            .'<label>Event Details</label><br>'
            .'<textarea name = "eventDetails" rows = "15" cols = "5">'.$event->Details.'</textarea>';
        echo '<input type = "submit" name = "editEvent" value = "Submit Edits">
            .<input type = "hidden" name = "eventid" value = "'.$event->ID.'">'
            .'</form>';
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
                <input type = "text" name = "courtnumber" value = "'.$court->courtNumber.'"><br>
                <label>Hourly Price</label>
                <input type = "text" name = "courtprice" value = "'.$court->pricePerHour.'"> <br>
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