<?php
require_once 'EventModel.php';

class EventView {
    public function displayEvents($events, $numOfPages, $currentPage) {

        echo '<table class = "displaytables">';
        echo '<tr>'
            . '<th>Event Name</th>'
            . '<th>Event Date</th>'
            . '<th>Event Details</th>'
            . '<th>Edit Event</th>'
            . '<th>Delete Event</th>'
            . '</tr>';
    if(!empty($events))
    {
        for ($i = 0; $i < count($events); $i++) {
            echo '<tr>'
                . '<td>' . $events[$i]['name'] . '</td>'
                . '<td>' . $events[$i]['date'] . '</td>'
                . '<td>' . $events[$i]['details'] . '</td>'
                . '<td> <form action = "EventController.php" method = "POST">'
                . '<button type = "submit" name = "editButton" value = "' . $events[$i]['id'] . '">Edit</button>'
                . '</form>'
                . '<td> <form action = "EventController.php" method = "POST">'
                . '<button  type = "submit" name = "deleteButton" value = "' . $events[$i]['id'] . '">Delete</button>'

                . '</form>'
                . '</tr>';
        }
        echo '<tr style = "background-color: white;">';
        echo '<td align = "center" colspan = "6">';
        echo '<div class = "pagination">';
        for($page=1; $page<=$numOfPages; $page++) {
            if($page == $currentPage)
            {
                echo '<a href="EventController.php?p=' . $page . '" class = "active">' . $page . '</a> ';
            }
            else
            {
                echo '<a href="EventController.php?p=' . $page . '">' . $page . '</a> ';
            }
        }
        echo '</div>';
        echo '</td>';
        echo '</tr>';
    }
        echo '</table>';
        echo '<br><form action = "EventController.php" method = "POST">'
            . '<button type = "submit" name = "addButton">Add Event</button>'
            . '</form><br><br>';

    }
    public function addEventForm() {
        $date = date("Y-m-d");
        echo '<form action = "EventController.php" method = "POST">'
            . '<label>Event Name</label>'
            . '<input type = "text" minlength = "2" maxlength = "100" name = "eventName" required>'
            . '<label>Event Date</label>'
            . '<input type = "date"min="' . $date . '" name = "eventDate" required><br>'
            . '<label>Event Details</label><br>'
            . '<textarea name = "eventDetails" minlength = "10" rows = "15" cols = "5" required></textarea>';
        echo '<input type = "submit" name = "addEvent" value = "Add">'
            . '</form>';
    }
    public function editEventForm($event) {
        $date = date("Y-m-d");
        echo '<form action = "EventController.php" method = "POST">'
        . '<label>Event Name</label>'
        . '<input type = "text" minlength = "2" maxlength = "100" name = "eventName" value = "' . $event->Name . '" required>'
        . '<label>Event Date</label>'
        . '<input type = "date"min="' . $date . '" name = "eventDate" value = "' . $event->Date . '" required><br>'
        . '<label>Event Details</label><br>'
        . '<textarea name = "eventDetails" minlength = "10" rows = "15" cols = "5" required>' . $event->Details . '</textarea>';
        echo '<input type = "submit" name = "editEvent" value = "Submit Edits">
            .<input type = "hidden" name = "eventid" value = "' . $event->ID . '">'
            . '</form>';
    }
    public static function editCourtView($sports, $specs, $court) {
        echo '<form action = "" method = "POST" class = "form-basic">
                    <label>Sport </label>
                    <select name = "sport" value = "' . $court->sports . '">';
        for ($i = 0; $i < count($sports); $i++) {
            echo '<option value = "' . $sports[$i]['id'] . '">' . $sports[$i]['name'] . '</option>';
        }
        echo '</select> <br>';
        echo '<label>Court Number </label>
                <input type = "text" name = "courtnumber" value = "' . $court->courtNumber . '"><br>
                <label>Hourly Price</label>
                <input type = "text" name = "courtprice" value = "' . $court->pricePerHour . '"> <br>
                <label>Court Specs </label>
                <select name = "specs" value = "' . $court->specs . '">';

        for ($i = 0; $i < count($specs); $i++) {
            $specId = $specs[$i]['id'];
            $spec   = $specs[$i]['specs'];
            echo '<option value = "' . $specId . '">' . $spec . '</option>';
        }
        echo '</select><br>';
        echo '<input type = "submit" name = "editCourt" value = "Submit Edits">
                  <input type = "hidden" name = "courtid" value = "' . $court->id . '">'
            . '</form>';
    }
}

?>