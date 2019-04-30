<html>
    <head>
        <link href="../css/temp.css" rel="stylesheet" type="text/css">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    </head>
    <body>
            <?php
class PmView {

    public function __construct() {

    }

    public static function displayMethodsV($data) {
        echo '<table id=pmtable class = "displaytables">';
        echo '<tr>'
            . '<th>Payment Method</th>'
            . '<th>Options</th>'
            . '<th>Edit Method</th>'
            . '<th>Delete Method</th>'
            . '</tr>';

        for ($i = 0; $i < count($data); $i++) {
            echo '<tr>'
            . '<td>' . $data[$i]->methodName . '</td>';
            echo '<td>';

            $options = $data[$i]->optionsName;

            for ($j = 0; $j < count($options); $j++) {
                echo $options[$j] . '<br>';
            }
            echo '</td>'
            . '<td> <form action = "PmController.php" method = "POST">'
            . '<button type = "submit" name = "editButton" value = "' . $data[$i]->pmID . '">Edit</button> </td>'
            . '</form>'
            . '<td> <form action = "PmController.php" method = "POST">'
            . '<button class = "button" type = "submit" name = "deleteButton" value = "' . $data[$i]->pmID . '">Delete</button>'
                . '</form>'
                . '</tr>';
        }
        echo '<tr> <td> <form method=POST> <button type=submit name= "addBtn" class="button"> Add New Method </button> </form> </td> </tr>';
        echo '</table>';
    }
    public static function Undisplay() {
        echo '<script>
                    var myNode = document.getElementById("pmtable");
                while (myNode.firstChild) {
                    myNode.removeChild(myNode.firstChild);
                }
                    </script>';

    }
    public static function addMethodV($data) {
        echo '<form action = "" method = "POST">
                        <label>Method Name</label>
                        <input type = "text" name = "methodName">
                        <table id="optionsTable" class = "displaytables" style=display:none;>
                        <tr> <th> Option</th> <th> Priority</th> </tr>
                        </table>
                       <label>Add Option</label>
                       <select id="Optionsdrpdwn" name="Optionsdrpdwn" style="width:15%" onchange="addoption()">
                       <option disabled selected value="none"> -- select an option -- </option>';

        for ($i = 0; $i < count($data); $i++) {
            echo '<option  value=' . $data[$i]['id'] . '>' . $data[$i]['name'] . '</option>';
        }

        echo '</select>
                   <input type = "submit" name = "addMethodsubmit" value = "Add Method">
                   </form>';
    }
    public static function editMethodV($data) {
        echo '<form action = "" method = "POST">
                  <label>Method Name</label>
                  <input type = "text" name = "methodName" value = "' . $data[0]->methodName . '">';
        echo '<table class = "displaytables">
                  <tr>
                  <th> Option</th> <th> Priority</th> <th> Delete </th> </tr>';
        $optionsName = $data[0]->optionsName;
        $soid        = $data[0]->selectedOptionsId;
        $priority    = $data[0]->priority;
        $pmID        = $data[0]->pmID;
        $options     = $data[1];

        for ($i = 0; $i < count($options); $i++) {
            $allOptionsName[] = $options[$i]['name'];
        }

        for ($i = 0; $i < count($optionsName); $i++) {
            echo '<tr>';
            echo '<td> <label>' . $optionsName[$i] . '</label> </td> ';
            echo '<input type=checkbox name = "Checkedconstraints[]"  style="display:none" value=' . $soid[$i] . ' checked >';
            echo '<td> <input type = "text" name=priority' . $soid[$i] . ' value=' . $priority[$i] . ' style="width:15%"> </td>
                           <td> <input type=checkbox name = "delete[]"  value=' . $soid[$i] . ' > </td>';
            echo '</tr>';
            $key = array_search($optionsName[$i], $allOptionsName);
            unset($options[$key]);
        }
        $options = array_values($options); //reset array indexes after unsetting elements

        echo '</table>';
        echo '<div id="addOption"></div>
                      <label> Add Option </label>

                 <select id="InOptions"  onchange="onselection()" style=width:15%>
                 <option disabled selected value> -- select an option -- </option>';

        for ($i = 0; $i < count($options); $i++) {
            echo '<option name="optionsOut" value=' . $options[$i]['id'] . '>' . $options[$i]['name'] . '</option>';
        }

        echo '</select>  <br>';
        echo ' <button type = "submit" name = "editBtnSubmit" value = ' . $pmID . '> Update </button>
                  </form>';

    }
}

?>
    </body>

</html>

