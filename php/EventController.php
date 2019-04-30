<?php
// require_once('EventView.php');
// require_once('EventModel.php');
require_once 'factoryClass.php';
include 'navbar.php';
echo '<link href="../css/temp.css" rel="stylesheet" type="text/css">';

// $view  = new EventView();
// $model = new EventModel();
$view  = factoryClass::create("View", "Event", null);
$model = factoryClass::create("Model", "Event", null);

$view->displayEvents($model->getAllEvents());

if (isset($_POST['addButton'])) {
    $view->addEventForm();
}
if (isset($_POST['addEvent'])) {
    // $event          = new EventModel();
    $model          = factoryClass::create("Model", "Event", null);
    $event->Name    = $_POST['eventName'];
    $event->Date    = $_POST['eventDate'];
    $event->Details = $_POST['eventDetails'];
    $event->AddEvent($event);
    header('Location: EventController.php');
}
if (isset($_POST['editButton'])) {
    $id = $_POST['editButton'];
    $view->editEventForm($model->getEventDetails($id));
}
if (isset($_POST['editEvent'])) {
    // $event          = new EventModel();
    $model          = factoryClass::create("Model", "Event", null);
    $event->ID      = $_POST['eventid'];
    $event->Name    = $_POST['eventName'];
    $event->Date    = $_POST['eventDate'];
    $event->Details = $_POST['eventDetails'];
    $event->Update($event);
    header('Location: EventController.php');
}
if (isset($_POST['deleteButton'])) {
    $id = $_POST['deleteButton'];
    // $event = new EventModel();
    $model = factoryClass::create("Model", "Event", null);
    $event->Delete($id);
    header('Location: EventController.php');
}
?>