<?php
include_once 'navbar.php';
require_once 'factoryClass.php';

if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js" type="text/javascript"></script>
    <link rel="stylesheet" href="../assets/css/cs-skin-elastic.css">
    <link rel="stylesheet" href="../assets/css/style.css">
    <title>Control Panel</title>

    <script type="text/javascript">

    $(document).ready(function () {
        $("#newUserType").click(function () {
            $("#userTypeTable").hide();
            $("#newUserTypeForm").fadeIn(1000);
        });
    });

    $(document).ready(function () {
        $("#getBack").click(function () {
            $("#newUserTypeForm").hide();
            $("#userTypeTable").fadeIn(1000);
        });
    });

</script>
</head>
<body>

<div id="newUserTypeForm" style="display:none;">
<form action="userController.php" method="POST"">
User Type Name:<br>
<input type="text" name="name" id="name" required>
<input type="submit" name="newUsertype" value="Add new usertype">
</form>
<button name='getBack' id='getBack'> Get Back </button>
</div>

</body>
</html>

<?php
$userTypes = factoryClass::create("Model", "User", null);

if ($tempArray = $userTypes->getUserTypes()) {
    echo '<div id="userTypeTable">';
    print("<table border='1'");
    echo "<thd><th>ID</th></td><thd><th>Name</th></td>";
    foreach ($tempArray as $x => $x_value) {
        print("<tr>");
        foreach ($x_value as $y => $y_value) {
            print("<td>" . $y_value . "</td>");
        }
        print("</tr>");
    }
    print("</table>");
    echo "<button name='newUserType' id='newUserType'> Add New Usertype </button>";
    echo '</div';
    echo "<hr>";
}
?>