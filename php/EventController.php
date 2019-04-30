<?php
require_once('EventView.php');
require_once('crudfacade.php');
include('navbar.php');
echo '<link href="../css/temp.css" rel="stylesheet" type="text/css">';

$view = new EventView();
$crud = new crudfacade();
$display = $crud->displayEvents();
$view->displayEvents($display);

if(isset($_POST['addButton']))
{
    $view->addEventForm();
}
if(isset($_POST['addEvent']))
{
    $crud = new crudfacade();
    $crud->event->Name = $_POST['eventName'];
    $crud->event->Date = $_POST['eventDate'];
    $crud->event->Details = $_POST['eventDetails'];
    $crud->addEvent($crud->event);
    header('Location: EventController.php');
}
if(isset($_POST['editButton']))
{
    $crud = new crudfacade();
    $id = $_POST['editButton'];
    $view->editEventForm($crud->event->getEventDetails($id));
}
if(isset($_POST['editEvent']))
{
    $crud = new crudfacade();
    $crud->event->ID = $_POST['eventid'];
    $crud->event->Name = $_POST['eventName'];
    $crud->event->Date = $_POST['eventDate'];
    $crud->event->Details = $_POST['eventDetails'];
    $crud->editEvent($crud->event);
    header('Location: EventController.php');
}
if(isset($_POST['deleteButton']))
{
    $crud = new crudfacade();
    $id = $_POST['deleteButton'];
    $crud->deleteEvent($id);
    header('Location: EventController.php');
}
?>