<html>
    <head>
        <!-- <link href="../css/temp.css" rel="stylesheet" type="text/css"> -->
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    </head>
    <body>
            <?php
class PmView {

    public function __construct() {

    }

    public static function displayMethodsV($data) {
        
        echo'<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    
        <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/bs4/jq-3.3.1/dt-1.10.18/b-1.5.6/datatables.min.css"/>
        <script type="text/javascript" src="https://cdn.datatables.net/v/bs4/jq-3.3.1/dt-1.10.18/b-1.5.6/datatables.min.js"></script>';
        if(!empty($_SESSION))
        {
        echo '<div id="myDiv" style="width:70%">';
        echo '<table id="pmtable" class = "table text-center table-dark table-striped table-hover table-bordered">';
        echo '<thead><tr>'
            . '<th>Payment Method</th>'
            . '<th>Options</th>'
            . '<th>Edit Method</th>'
            . '<th>Delete Method</th>'
            . '</tr></thead><tbody>';

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
            . '<button class="btn btn-lg btn-primary" type = "submit" name = "editButton" value = "' . $data[$i]->pmID . '">Edit</button>'
            . '</form> </td>'
            . '<td> <form action = "PmController.php" method = "POST">'
            . '<button class = "btn btn-lg btn-danger" type = "submit" name = "deleteButton" value = "' . $data[$i]->pmID . '">Delete</button>'
                . '</form></td>'
                . '</tr>';
        }
        // echo '<tr style = "background-color: white;">';
        // echo '<td align = "center" colspan = "6">';
        // echo '<div class = "pagination">';
        // for($page=1; $page<=$numOfPages; $page++) {
        //     if($page == $currentPage)
        //     {
        //         echo '<a class="btn btn-sm btn-primary" href="PmController.php?p=' . $page . '" >' . $page . '</a> ';
        //     }
        //     else
        //     {
        //         echo '<a class="btn btn-link" href="PmController.php?p=' . $page . '">' . $page . '</a> ';
        //     }
        // }
        // echo '</div>';
        // echo '</td>';
        // echo '</tr>';

        echo '</tbody></table>';
        echo '<br> <form method=POST> <button class="btn btn-lg btn-primary" type=submit name= "addBtn" class="button"> Add New Method </button></form>';
        echo '</div>';
        echo"<script>
        $(document).ready( function () {
            $('#pmtable').DataTable();
        } );
         </script>";
    }
    }
    public static function Undisplay() {
        echo '<script>
                    var myNode = document.getElementById("myDiv");
                while (myNode.firstChild) {
                    myNode.removeChild(myNode.firstChild);
                }
                    </script>';

    }
    public static function addMethodV($data) {
        echo '<form action = "" method = "POST">
                        <label>Method Name</label>
                        <input class="form-control" type = "text" name = "methodName" maxlength="25">
                        <label>Add Option</label>
                        <select  class="form-control" id="Optionsdrpdwn" name="Optionsdrpdwn"  onchange="addoption()">
                        <option disabled selected value="none"> -- select an option -- </option>';
                        for ($i = 0; $i < count($data); $i++) {
                            echo '<option  value=' . $data[$i]['id'] . '>' . $data[$i]['name'] . '</option>';
                        }
                        echo '</select>';
           echo'<table id="optionsTable" class = "table text-center table-dark table-striped table-hover table-bordered" style="display:none; width:70%;">
                        <tr> <th> Option</th> <th> Priority</th> </tr>
                        </table>';
           echo'<input class="btn btn-lg btn-primary" type = "submit" name = "addMethodsubmit" value = "Add Method" style="margin-left:40px;">
                   </form>';
    }
    public static function editMethodV($data) {
        echo '<form action = "" method = "POST">
                  <label>Method Name</label>
                  <input class="form-control" type = "text" maxlength="25" name = "methodName" value = "' . $data[0]->methodName . '">';
        echo '<table id=editTable class = "table text-center table-dark table-striped table-hover table-bordered">
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
            echo '<td> <input class="form-control" type = "number" min=1 max=9999 name=priority' . $soid[$i] . ' value=' . $priority[$i] . ' style="width:30%"> </td>
                  <td> <input class="single-checkbox" style="  width: 25px;  height: 25px;" type=checkbox name = "delete[]"  value=' . $soid[$i] . ' > </td>';
            echo '</tr>';
            $key = array_search($optionsName[$i], $allOptionsName);
            unset($options[$key]);
        }
        $options = array_values($options); //reset array indexes after unsetting elements

        echo '</table>';
        echo '<div id="addOption"></div>
                      <label> Add Option </label>
                 <select class="form-control" id="InOptions"  onchange="onselection()" style=width:30%>
                 <option disabled selected value> -- select an option -- </option>';

        for ($i = 0; $i < count($options); $i++) {
            echo '<option name="optionsOut" value=' . $options[$i]['id'] . '>' . $options[$i]['name'] . '</option>';
        }

        echo '</select>  <br>';
        echo ' <button class="btn btn-lg btn-primary" type = "submit" name = "editBtnSubmit" value = ' . $pmID . ' style="margin-bottom:100px;"> Update </button>
                  </form>';

    }
}

?>
    </body>

</html>

