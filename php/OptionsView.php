<html>
    <head>
        <!-- <link href="../css/temp.css" rel="stylesheet" type="text/css"> -->
    </head>
    <body>
<?php
class optionsView {

    public function __construct() {

    }

    public static function displayOptionsV($data,$numOfPages, $currentPage) {
        echo '<table id=pmtable class = "table text-center table-dark table-striped table-hover table-bordered" style="width:70%">';
        echo '<tr>'
            . '<th>Option Name</th>'
            . '<th>Option Type</th>'
            . '<th>Edit Option</th>'
            . '<th>Delete Option</th>'
            . '</tr>';

        for ($i = 0; $i < count($data); $i++) {
            echo '<tr>'
            . '<td>' . $data[$i]->optionsName . '</td>'
            . '<td>' . $data[$i]->optionsType . '</td>'
            . '<td> <form action = "OptionsController.php" method = "POST">'
            . '<button class="btn btn-lg btn-primary" type = "submit" name = "editButton" value = "' . $data[$i]->optionsID . '">Edit</button> </td>'
            . '</form>'
            . '<td> <form action = "OptionsController.php" method = "POST">'
            . '<button class = "btn btn-lg btn-danger" type = "submit" name = "deleteButton" value = "' . $data[$i]->optionsID . '">Delete</button>'
                . '</form>'
                . '</tr>';
        }
        echo '<tr style = "background-color: white;">';
        echo '<td align = "center" colspan = "6">';
        echo '<div class = "pagination">';
        for($page=1; $page<=$numOfPages; $page++) {
            if($page == $currentPage)
            {
                echo '<a class="btn btn-sm btn-primary" href="OptionsController.php?p=' . $page . '" class = "active">' . $page . '</a> ';
            }
            else
            {
                echo '<a class="btn btn-link" href="OptionsController.php?p=' . $page . '">' . $page . '</a> ';
            }
        }
        echo '</div>';
        echo '</td>';
        echo '</tr>';
        echo '<tr> <td> <form method=POST> <button class="btn btn-lg btn-primary" type=submit name= "addBtn" class="button"> Add New Option </button> </form> </td> </tr>'
            . '</table>';
    }
    public static function Undisplay() {
        echo '<script>
                    var myNode = document.getElementById("pmtable");
                   while (myNode.firstChild) {
                    myNode.removeChild(myNode.firstChild);
                }
                    </script>';
    }
    public static function addMethodV() {
        echo '<form action = "" method = "POST">
                        <label>Option Name</label>
                        <input class="form-control" type = "text" maxlength="25" name = "optionName">
                        <label>Option Type</label>
                        <input class="form-control" type = "text" maxlength="25" name = "optionType">
                        <input class="btn btn-lg btn-primary" type = "submit" name = "addOptionSubmit" value = "Add Option">
                        </form>';
    }
    public static function editOptionV($data) {
        echo '<form action = "" method = "POST">
                  <label>Option Name</label>
                  <input class="form-control" type = "text" maxlength="25" name = "optionName" value = "' . $data->optionsName . '">';
        echo '<label>Option Type</label>
                 <input class="form-control" type = "text" maxlength="25" name = "optionType" value = "' . $data->optionsType . '">';
        echo ' <button class="btn btn-lg btn-primary" type = "submit" name = "editBtnSubmit" value = ' . $data->optionsID . '> Update </button>
                  </form>';
    }
}
?>
    </body>
</html>

