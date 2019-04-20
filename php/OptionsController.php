<?php
include_once("OptionsModel.php");
include_once("OptionsView.php");
include_once("navbar.php");

class optionsController 
{
    public $Model;
    public $View;
    public function __construct(){
       $this->Model= new optionsModel(0);
       $this->View= new optionsView();
    }

    public static function displayOptionsC()
    {
        $data=optionsModel::displayOptionsM();
        optionsView::displayOptionsV($data);
    }

    public static function deleteOptionC($id)
    {
        optionsModel::deleteOptionM($id);
        echo '<meta http-equiv="refresh" content="0">';
    }
    public static function addOptionC()
    {
        $opModel= new optionsModel(0);
        if(!empty(trim($_POST['optionType'])) && !empty(trim($_POST['optionName']))
          && ctype_alpha($_POST['optionType']) && ctype_alpha($_POST['optionName']) )
        {
            $opModel->optionsName=trim($_POST['optionName']);
            $opModel->optionsType=trim($_POST['optionType']);
            $opModel->addOptionM($opModel);
        }
        echo '<meta http-equiv="refresh" content="0">';
    }


    public static function editOptionDisplay($id)
    {
    $data= new optionsModel($id);
    optionsView::editOptionV($data);
    }

    public static function editOptionC()
    {
        $opModel= new optionsModel(0);
        if(!empty(trim($_POST['optionType'])) && !empty(trim($_POST['optionName']))
        && ctype_alpha($_POST['optionType']) && ctype_alpha($_POST['optionName']) )
      {
          $opModel->optionsName=trim($_POST['optionName']);
          $opModel->optionsType=trim($_POST['optionType']);
          $opModel->optionsID=$_POST['editBtnSubmit'];
          $opModel->updateOption($opModel);
      }
      echo '<meta http-equiv="refresh" content="0">';
    } 
}
$optionsC=new optionsController();
$optionsC->displayOptionsC();

if (isset($_POST['deleteButton']))
{
    $ID = $_POST['deleteButton'];
    $optionsC->deleteOptionC($ID);
}

if (isset($_POST['addBtn']))
{
    optionsView::Undisplay();
    optionsView::addMethodV();
}

if (isset($_POST['addOptionSubmit']))
{
 $optionsC->addOptionC();
}

if(isset($_POST["editButton"]))
{
    optionsView::Undisplay();
   $optionsC->editOptionDisplay($_POST["editButton"]);
}
if (isset($_POST['editBtnSubmit']))
{
  $optionsC->editOptionC();
}
?>