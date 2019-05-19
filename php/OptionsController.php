<?php
// include_once "OptionsModel.php";
// include_once "OptionsView.php";
require_once 'factoryClass.php';
include_once "navbar.php";

class optionsController {
    public $Model;
    public $View;
    public function __construct() {
        // $this->Model = new optionsModel(0);
        // $this->View  = new optionsView();
        $this->Model = factoryClass::create("Model", "Options", 0);
        $this->View  = factoryClass::create("View", "Options", null);

    }

    public static function displayOptionsC($this_page_first_result,$results_per_page,$page,$number_of_pages) {
        $data = optionsModel::displayOptionsM($this_page_first_result,$results_per_page);
        optionsView::displayOptionsV($data,$number_of_pages, $page);
    }

    public static function deleteOptionC($id) {
        optionsModel::deleteOptionM($id);
        echo '<meta http-equiv="refresh" content="0">';
    }
    public static function addOptionC() {
        // $opModel = new optionsModel(0);
        $opModel = factoryClass::create("Model", "Options", 0);
       
        if (empty(trim($_POST['optionType'])) || empty(trim($_POST['optionName'])))
        {
            echo "<script> alert('Fill Empty Fields'); </script>";
        }
        else if (!ctype_alpha($_POST['optionType']))
        {
            echo "<script> alert('Only letters are allowed in Option Type'); </script>";
        }
        else if (!empty(trim($_POST['optionType'])) && !empty(trim($_POST['optionName']))
            && ctype_alpha($_POST['optionType']) ) 
        {
            if ($opModel->getIdenticalName(trim($_POST['optionName'])) > 0)
                echo "<script> alert('Option already exists'); </script>";
            else 
            {
                $opModel->optionsName = optionsController::checkData(trim($_POST['optionName']));
                $opModel->optionsType = optionsController::checkData(trim($_POST['optionType']));
                $opModel->addOptionM($opModel);
            }

        }
        echo '<meta http-equiv="refresh" content="0">';
    }

    public static function editOptionDisplay($id) {
        // $data = new optionsModel($id);
        $data = factoryClass::create("Model", "Options", $id);
        optionsView::editOptionV($data);
    }

    public static function editOptionC() {
        // $opModel = new optionsModel(0);
        $opModel = factoryClass::create("Model", "Options", 0);
        if (empty(trim($_POST['optionType'])) || empty(trim($_POST['optionName'])))
        {
            echo "<script> alert('Fill Empty Fields'); </script>";
        }
        else if (!ctype_alpha($_POST['optionType']))
        {
            echo "<script> alert('Only letters are allowed in Option Type'); </script>";
        }
        else if (!empty(trim($_POST['optionType'])) && !empty(trim($_POST['optionName']))
            && ctype_alpha($_POST['optionType']) && isset($_POST['editBtnSubmit'])) 
        {
            if ($opModel->getIdenticalName(trim($_POST['optionName'])) > 0)
                {// echo "<script> alert('Option already exists'); </script>";
                }
            else {
            $opModel->optionsName = optionsController::checkData(trim($_POST['optionName']));
            $opModel->optionsType = optionsController::checkData(trim($_POST['optionType']));
            $opModel->optionsID   = $_POST['editBtnSubmit'];
            $opModel->updateOption($opModel);
        }
        }
        echo '<meta http-equiv="refresh" content="0">';
    }
    public static function checkData($data) {
        $DB = DbConnection::getInstance();
        $data = strip_tags(mysqli_real_escape_string($DB->getdbconnect(), trim($data)));
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }
}

$number_of_results = optionsModel::getNumberofOptions();
$results_per_page = 2;

$number_of_pages = ceil($number_of_results/$results_per_page);

if (!isset($_GET['p'])) {
    $page = 1;
}else {
    $page = $_GET['p'];
}

$this_page_first_result = ($page-1)*$results_per_page;

$optionsC = new optionsController();
$optionsC->displayOptionsC($this_page_first_result,$results_per_page,$page,$number_of_pages);

if (isset($_POST['deleteButton'])) {
    $ID = $_POST['deleteButton'];
    $optionsC->deleteOptionC($ID);
}

if (isset($_POST['addBtn'])) {
    optionsView::Undisplay();
    optionsView::addMethodV();
}

if (isset($_POST['addOptionSubmit'])) {
    $optionsC->addOptionC();
}

if (isset($_POST["editButton"])) {
    optionsView::Undisplay();
    $optionsC->editOptionDisplay($_POST["editButton"]);
}
if (isset($_POST['editBtnSubmit'])) {
    $optionsC->editOptionC();
}
include_once('footer.html');
?>