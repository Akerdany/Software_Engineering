<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Display Users</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="../css/temp.css" rel="stylesheet" type="text/css">
    <script src="main.js"></script>

</head>
<body>
    <?php
require_once "factoryClass.php";
include "navbar.php";

$myUser = factoryClass::create("Controller", "User", null);

$addAccess    = $myUser->getPermission("addUser");
$deleteAccess = $myUser->getPermission("deleteUser");
$editAccess   = $myUser->getPermission("editUser");
$myData       = $myUser->displayUsers();
$userTypes    = $myUser->getAllUserTypes();

echo '<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/dt/dt-1.10.18/datatables.min.css"/>
<script type="text/javascript" src="https://cdn.datatables.net/v/dt/dt-1.10.18/datatables.min.js"></script>';

print("<table id='displayUsersTable' border='1' class='table text-center table-striped table-hover table-bordered'>");

echo "<thead>
        <tr>
        <th>ID</th>
        <th>First Name</th>
        <th>Last Name</th>
        <th>Email</th>
        <th>Date Of Birth</th>
        <th>Telephone Number</th>
        <th>SSN</th>
        <th>Type of User</th>";

if ($editAccess) {
    echo "<th>Edit User Type</th>";
}

echo "<th>Account Status</th>";
if ($deleteAccess) {
    echo "<th>Action</th>";
}

echo "<th>Date & Time Joined</th>
        </tr>
        </thead>
        <tbody>";

foreach ($myData as $x => $x_value) {
    print("<tr>");
    foreach ($x_value as $y => $y_value) {
        if ($y != "password" && $y != "addressId") {
            if ($y == "userTypeId") {
                echo "<td>" . $myUser->getUsertypeName($y_value) . "</td>";

                if ($editAccess) {
                    if ($x_value['userTypeId'] != 1) {
                        echo '<td><form action="userController.php" method="POST">';

                        echo "<select name='userType'>";
                        echo "<option value=0>Choose</option>";
                        foreach ($userTypes as $key => $value) {
                            echo '<option value="' . $value['id'] . '">' . $value['userTypeName'] . '</option>';
                        }
                        echo "</select><br>";

                        echo '<button type="submit" name="editUserTypeButtonOnly" value="' . $x_value['id'] . '">Save</button>'
                            . '</form></td>';
                    } else {
                        echo "<td>No Actions</td>";
                    }
                }
            } elseif ($y == "isDeleted") {
                if ($y_value == 0) {
                    echo "<td>Active</td>";
                    if ($deleteAccess) {
                        echo '<td> <form action="userController.php" method="POST">'
                            . '<button type="submit" name="deleteUserButton" value="' . $x_value['id'] . '">Delete User</button>'
                            . '</form></td>';
                    }
                } else {
                    echo "<td>Deleted</td>";
                    if ($deleteAccess) {
                        echo '<td> <form action="userController.php" method="POST">'
                            . '<button type="submit" name="activateUserButton" value="' . $x_value['id'] . '">Activate User</button>'
                            . '</form></td>';
                    }
                }
            } else {
                print("<td>" . $y_value . "</td>");
            }
        }
    }
    print("</tr>");
}
print("</tbody></table>");

echo "<script>
        $('#displayUsersTable').DataTable();
        </script>
";

if ($addAccess) {
    echo '<a href= "registration.php" class="button">Add User</a><br><br><br><br><br><br><br>';
}
include 'footer.html';
?>
</body>
</html>