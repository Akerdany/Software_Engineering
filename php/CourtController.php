<?php
require_once('CourtView.php');
require_once('CourtModel.php');
include('navbar.php');
echo '<link href="../css/temp.css" rel="stylesheet" type="text/css">';

$view = new CourtView();
$model = new CourtModel();
$courts = $model->getAllCourts();
$view->displayCourts($courts);
if(isset($_POST['deleteButton']))
{
    $id = $_POST['deleteButton'];
    $model->deleteCourt($id);
    header('Location: CourtController.php');
}
if(isset($_POST['addButton']))
{
    $view->addCourtForm($model->getAllSports(), $model->getCourtSpecs());
}
if(isset($_POST['addCourt']))
{
    $court = new CourtModel();
    $court->courtNumber = $_POST['courtnumber'];
    $court->pricePerHour = $_POST['courtprice'];
    $court->sportid = $_POST['sport'];
    $court->specsid = $_POST['specs'];
    $court->addCourt($court);
    header('Location: CourtController.php');
}
if(isset($_POST['editButton']))
{
    $id = $_POST['editButton'];
    $court = $model->getCourtDetails($id);
    $view->editCourtView($model->getAllSports(), $model->getCourtSpecs(), $court);
}
if(isset($_POST['editCourt']))
{
    $court = new CourtModel();
    
    $court->courtNumber = $_POST['courtnumber'];
    $court->pricePerHour = $_POST['courtprice'];
    $court->sportid = $_POST['sport'];
    $court->specsid = $_POST['specs'];
    $court->id = $_POST['courtid'];
    $court->editCourt($court);
    header('Location: CourtController.php');
}
?>