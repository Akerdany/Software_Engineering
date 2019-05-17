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

    function displayEvents($this_page_first_result, $results_per_page)
    {
        return $this->event->display($this_page_first_result, $results_per_page);
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

    function numberOfEvents()
    {
        return $this->event->getNumberOfResults();
    }

    function numberOfCourts()
    {
        return $this->court->getNumberOfResults();
    }

    function displayCourts($this_page_first_result, $results_per_page)
    {
        return $this->court->display($this_page_first_result, $results_per_page);
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