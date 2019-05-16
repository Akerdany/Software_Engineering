<?php
require_once('crudfacade.php');
require_once('CourtView.php');
include('navbar.php');
//include('../ElaAdmin-master/navtest.html');
echo '<link href="../css/temp.css" rel="stylesheet" type="text/css">';

$view = new CourtView();
$crud = new crudfacade();

$number_of_results = $crud->numberOfCourts();
$results_per_page = 2;

$number_of_pages = ceil($number_of_results/$results_per_page);

if (!isset($_GET['p'])) {
    $page = 1;
}else {
    $page = $_GET['p'];
}

$this_page_first_result = ($page-1)*$results_per_page;

$courts = $crud->displayCourts($this_page_first_result, $results_per_page);
$view->displayCourts($courts, $number_of_pages, $page);



if(isset($_POST['deleteButton']))
{
    $crud = new crudfacade();
    $id = $_POST['deleteButton'];
    $crud->deleteCourt($id);
    header('Location: CourtController.php');
}
if(isset($_POST['addButton']))
{
    $crud = new crudfacade();
    $view->addCourtForm($crud->court->getAllSports(), $crud->court->getCourtSpecs());
}
if(isset($_POST['addCourt']))
{
    $crud = new crudfacade();
    $crud->court->courtNumber = $_POST['courtnumber'];
    $crud->court->pricePerHour = $_POST['courtprice'];
    $crud->court->sportid = $_POST['sport'];
    $crud->court->specsid = $_POST['specs'];
    $crud->addCourt($crud->court);
    header('Location: CourtController.php');
}
if(isset($_POST['editButton']))
{
    $crud = new crudfacade();
    $id = $_POST['editButton'];
    $court = $crud->court->getCourtDetails($id);
    $view->editCourtView($crud->court->getAllSports(), $crud->court->getCourtSpecs(), $court);
}
if(isset($_POST['editCourt']))
{
    $crud = new crudfacade();
    
    $crud->court->courtNumber = $_POST['courtnumber'];
    $crud->court->pricePerHour = $_POST['courtprice'];
    $crud->court->sportid = $_POST['sport'];
    $crud->court->specsid = $_POST['specs'];
    $crud->court->id = $_POST['courtid'];
    $crud->editCourt($crud->court);
    header('Location: CourtController.php');
}
//include('../ElaAdmin-master/footertest.html');

?>