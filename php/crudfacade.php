<?php
require_once('EventModel.php');
require_once('CourtModel.php');

class crudfacade
{
    public $court;
    public $event;

    function __construct()
    {
        $this->court = new CourtModel();
        $this->event = new EventModel();
    }

    function displayEvents()
    {
        return $this->event->display();
    }

    function addEvent($event)
    {
        $this->event->add($event);
    }

    function editEvent($event)
    {
        $this->event->edit($event);
    }

    function deleteEvent($id)
    {
        $this->event->delete($id);
    }

    function displayCourts()
    {
        return $this->court->display();
    }

    function addCourt($court)
    {
        $this->court->add($court);
    }
    
    function editCourt($court)
    {
        $this->court->edit($court);
    }

    function deleteCourt($id)
    {
        $this->court->delete($id);
    }
}


?>