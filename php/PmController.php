<?php
// include_once "PmModel.php";
// include_once "PmView.php";
require_once 'factoryClass.php';
include_once "navbar.php";

class PmController {
    public $Model;
    public $View;
    public function __construct() {
        // $this->Model = new PmModel(0);
        // $this->View = new PmView();

        $this->Model = factoryClass::create("Model", "Pm", 0);
        $this->View  = factoryClass::create("View", "Pm", null);
    }

    public static function displayMethodsC() {
        $data = PmModel::displayMethodsM();
        PmView::displayMethodsV($data);
    }
    public static function deleteMethodC($id) {
        PmModel::deleteMethodM($id);
        header('Location: PmController.php');
    }
    public static function addMethodDisplay() {
        $data = PmModel::selectAllOptions();
        PmView::addMethodV($data);
    }
    public static function addMethodC() {
        // $paymentM = new PmModel(0);
        $paymentM = factoryClass::create("Model", "Pm", 0);

        if (!empty($_POST['constraints']) && !empty(trim($_POST['methodName']))) {
            $paymentM->methodName = trim($_POST['methodName']);
            $paymentM->addMethodM($paymentM);

            foreach ($_POST['constraints'] as $selected) {
                $isPriority = true;
                if (isset($_POST['priority' . $selected])) {
                    foreach ($_POST['constraints'] as $compared) {

                        if ($_POST['priority' . $selected] == $_POST['priority' . $compared] && $selected != $compared) {
                            $isPriority = false;
                            break;
                        }
                    }
                }
                if ($isPriority) {
                    $paymentM->priority  = $_POST['priority' . $selected];
                    $paymentM->optionsID = $selected;
                    $paymentM->pmID      = $paymentM->getMaxPMid();
                    $paymentM->insertSelectedoptions($paymentM);
                }
            }
        }
        header('Location: PmController.php');
    }

    public static function editMethodDisplay($id) {
        $data = [];
        // $obj     = new PmModel($id);
        $obj     = factoryClass::create("Model", "Pm", $id);
        $data[0] = $obj;
        array_push($data, PmModel::selectAllOptions());
        PmView::editMethodV($data);
    }

    public static function editMethodC() {
        // $paymentM       = new PmModel(0);
        $paymentM       = factoryClass::create("Model", "Pm", 0);
        $paymentM->pmID = $_POST['editBtnSubmit'];

        if (!empty(trim($_POST['methodName']))) {
            $paymentM->methodName = trim($_POST['methodName']);
            $paymentM->updateMethod($paymentM);
        }

        if (!empty($_POST['Checkedconstraints'])) {
            foreach ($_POST['Checkedconstraints'] as $selected) {
                $isPriority = true;
                if (isset($_POST['priority' . $selected])) {
                    foreach ($_POST['Checkedconstraints'] as $compared) {
                        if ($_POST['priority' . $selected] == $_POST['priority' . $compared] && $selected != $compared) {
                            $isPriority                    = false;
                            $data                          = $paymentM->selectAllselectedOptions($selected);
                            $_POST['priority' . $selected] = $data[0]['priority'];
                            break;
                        }
                    }
                }
                if ($isPriority) {
                    $paymentM->priority          = $_POST['priority' . $selected];
                    $paymentM->selectedOptionsId = $selected;
                    $paymentM->updateSelectedoptions($paymentM);
                }
            }
        }
        if (!empty($_POST['delete'])) {
            foreach ($_POST['delete'] as $selected) {
                $paymentM->selectedOptionsId = $selected;
                $paymentM->DeleteSelectedoptions($paymentM);
            }
        }

        if (!empty($_POST['unCheckedconstraints'])) {
            $isPriority = true;
            foreach ($_POST['unCheckedconstraints'] as $selected) {
                if (isset($_POST['priority' . $selected])) {
                    foreach ($_POST['Checkedconstraints'] as $compared) {
                        if ($_POST['priority' . $selected] == $_POST['priority' . $compared]) {
                            $isPriority = false;
                            break;
                        }
                    }
                }
                if ($isPriority) {
                    $paymentM->priority  = $_POST['priority' . $selected];
                    $paymentM->optionsID = $selected;
                    $paymentM->insertSelectedoptions($paymentM);
                }
            }
        }
        header('Location: PmController.php');
    }

}

$pm = new PmController();
$pm->displayMethodsC();

if (isset($_POST['deleteButton'])) {
    $ID = $_POST['deleteButton'];
    $pm->deleteMethodC($ID);
}

if (isset($_POST['addBtn'])) {
    PmView::Undisplay();
    $pm->addMethodDisplay();
}

if (isset($_POST['addMethodsubmit'])) {
    $pm->addMethodC();
}

if (isset($_POST["editButton"])) {
    PmView::Undisplay();
    $pm->editMethodDisplay($_POST["editButton"]);
}

if (isset($_POST['editBtnSubmit'])) {
    $pm->editMethodC();
}
?>

<script>
var newOp=document.getElementById("optionsTable");
var Addhtml;
var Addselect=document.getElementById("Optionsdrpdwn");
function addoption()
{
  newOp.style.display="inline-table";
  var selectedVal=Addselect.options[Addselect.selectedIndex].value;
  Addhtml= '<tr> <td>'+Addselect.options[Addselect.selectedIndex].text+'</td>'
    +'<td> <input type = "text" name=priority'+selectedVal+' style="width:15%"> </td> </tr>'
    +'<input style="display:none" type = "checkbox" name = "constraints[]" value='+selectedVal+' checked>';
 newOp.innerHTML+= Addhtml;
 $("#Optionsdrpdwn option[value='"+selectedVal+"']").remove();
 $("#Optionsdrpdwn").val('none');
}

var editOp=document.getElementById("addOption");
var editHtml;
var Editselect=document.getElementById("InOptions");
function onselection()
{
    editHtml= '<input type=checkbox name = "unCheckedconstraints[]" style="display:none" value='+Editselect.options[Editselect.selectedIndex].value+' checked >'
    +'<label> Option: '+Editselect.options[Editselect.selectedIndex].text+ '</label> <br>'
    +'<label> Priority: </label> <input type="text" name=priority'+Editselect.options[Editselect.selectedIndex].value+' style="width:15%"> <br>';
    editOp.innerHTML= editHtml;
}
</script>