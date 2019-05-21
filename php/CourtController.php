<!DOCTYPE html>
<html>
<head>
</head>
<body>
<?php
include('navbar.php');

    require_once('crudfacade.php');
    require_once('CourtView.php');
    
    //include('../ElaAdmin-master/navtest.html');
    echo '<link href="../css/temp.css" rel="stylesheet" type="text/css">';
    
    $view = new CourtView();
    $crud = new crudfacade();
    
    $number_of_results = $crud->numberOfCourts();
    $results_per_page = 20;
    
    function checkData($data) {
        // $DB = new DbConnection();
        $DB = DbConnection::getInstance();
    
        $data = strip_tags(mysqli_real_escape_string($DB->getdbconnect(), trim($data)));
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
    
        return $data;
    }
    
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
        echo '<meta http-equiv="refresh" content="0">';
    }
    if(isset($_POST['addButton']))
    {
        $crud = new crudfacade();
        $view->addCourtForm($crud->court->getAllSports(), $crud->court->getCourtSpecs());
        $view->Undisplay();
    }
    if(isset($_POST['addCourt']))
    {
        $crud = new crudfacade();
        $crud->court->courtNumber = checkData($_POST['courtnumber']);
        $crud->court->pricePerHour = checkData($_POST['courtprice']);
        $crud->court->sportid = checkData($_POST['sport']);
        $crud->court->specsid = checkData($_POST['specs']);
        $crud->addCourt($crud->court);
        echo '<meta http-equiv="refresh" content="0">';
    }
    if(isset($_POST['editButton']))
    {
        $crud = new crudfacade();
        $id = $_POST['editButton'];
        $court = $crud->court->getCourtDetails($id);
        $view->editCourtView($crud->court->getAllSports(), $crud->court->getCourtSpecs(), $court);
        $view->Undisplay();
    }
    if(isset($_POST['editCourt']))
    {
        $crud = new crudfacade();
        
        $crud->court->courtNumber = checkData($_POST['courtnumber']);
        $crud->court->pricePerHour = checkData($_POST['courtprice']);
        $crud->court->sportid = checkData($_POST['sport']);
        $crud->court->specsid = checkData($_POST['specs']);
        $crud->court->id = checkData($_POST['courtid']);
        $crud->editCourt($crud->court);
        echo '<meta http-equiv="refresh" content="0">';
    }
    //include('../ElaAdmin-master/footertest.html');
    ?>
</body>
<?php
include('footer.html');
?>
</html>
