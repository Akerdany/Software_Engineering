<!DOCTYPE html>
<html>
<head>
<link href="../css/temp.css" rel="stylesheet" type="text/css">

<head>
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <style>
            body {
                font-family: "Lato", sans-serif;
            }

           
        </style>
    </head>

<?php
if (session_status() == PHP_SESSION_NONE) {
  session_start();
}
if((isset($_SESSION['userType']))){
    echo "<script>
    
        var xmlhttp = new XMLHttpRequest();
        xmlhttp.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
            document.getElementById('fields').innerHTML = ''; //empty form before appending
            document.getElementById('fields').innerHTML += this.responseText; // append retrieved fields
            }
        };
        xmlhttp.open('GET', 'buttons.php?id=' + '".$_SESSION['userType']."', true); //request to getFormFields with paymentMethodId to get the fields
        xmlhttp.send();
    
   
    
    </script>";
}
?>
<body>

<div id="mySidenav1" class="sidenav1">
  <a href="javascript:void(0)" class="closebtn" onclick="closeNav()">&times;</a>
  <a href='index.php' class='logo' class="sideNavLink"><img src="http://www.emss.gov.eg/assets/finle/images/logo-header.png" alt="" width="120px" height="100%"></a>

<div id = "fields">
  <a href="logIn.php" class="sideNavLink">SignIn</a>
  <a href="registration.php" class="sideNavLink">Signup</a>
  
  </div>
</div>

<span style="font-size:30px;cursor:pointer" onclick="openNav()">&#9776; open</span>

<script>
    function openNav() {
        document.getElementById("mySidenav1").style.width = "250px";
        document.getElementById("fields").style.width = "250px";
    }

    function closeNav() {
        document.getElementById("mySidenav1").style.width = "0";
        document.getElementById("fields").style.width = "0";
    }
</script>

</body>
</html>