<html>
    <head>
        <!-- <link href="../css/temp.css" rel="stylesheet" type="text/css"> -->
    </head>
    <body>
<?php
class optionsView {

    public function __construct() {

    }

    public static function displayOptionsV($data) {
         
        echo'<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    
        <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/bs4/jq-3.3.1/dt-1.10.18/b-1.5.6/datatables.min.css"/>
        <script type="text/javascript" src="https://cdn.datatables.net/v/bs4/jq-3.3.1/dt-1.10.18/b-1.5.6/datatables.min.js"></script>';
        if(!empty($_SESSION))
        {
        echo '<div id="myDiv" style="width:70%">';
        echo '<table id=pmtable class = "table text-center table-dark table-striped table-hover table-bordered">';
        echo '<thead><tr>'
            . '<th>Option Name</th>'
            . '<th>Option Type</th>'
            . '<th>Edit Option</th>'
            . '<th>Delete Option</th>'
            . '</tr></thead><tbody>';

        for ($i = 0; $i < count($data); $i++) {
            echo '<tr>'
            . '<td>' . $data[$i]->optionsName . '</td>'
            . '<td>' . $data[$i]->optionsType . '</td>'
            . '<td> <form action = "OptionsController.php" method = "POST">'
            . '<button class="btn btn-lg btn-primary" type = "submit" name = "editButton" value = "' . $data[$i]->optionsID . '">Edit</button> '
            . '</form></td>'
            . '<td> <form action = "OptionsController.php" method = "POST">'
            . '<button class = "btn btn-lg btn-danger" type = "submit" name = "deleteButton" value = "' . $data[$i]->optionsID . '">Delete</button>'
                . '</td></form>'
                . '</tr>';
        }
        // echo '<tr style = "background-color: white;">';
        // echo '<td align = "center" colspan = "6">';
        // echo '<div class = "pagination">';
        // for($page=1; $page<=$numOfPages; $page++) {
        //     if($page == $currentPage)
        //     {
        //         echo '<a class="btn btn-sm btn-primary" href="OptionsController.php?p=' . $page . '" class = "active">' . $page . '</a> ';
        //     }
        //     else
        //     {
        //         echo '<a class="btn btn-link" href="OptionsController.php?p=' . $page . '">' . $page . '</a> ';
        //     }
        // }
        // echo '</div>';
        // echo '</td>';
        // echo '</tr>';
            echo '</table>';
            echo '<br> <form method=POST> <button class="btn btn-lg btn-primary" type=submit name= "addBtn" class="button"> Add New Option </button> </form>';
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

