<!DOCTYPE html>
<html>
<head>
    
</head>
<style>


.sidebar {
  margin: 0;
  padding: 0;
  width: 200px;
  background-color: #63a9e4;
  position: fixed;
  height: 100%;
  overflow: auto;
}

.sidebar a {
  display: block;
  color: black;
  padding: 16px;
  text-decoration: none;
}
 
.sidebar a.active {
  background-color: #2082d6;
  color: white;
}

.sidebar a:hover:not(.logo):not(.active) {
  background-color: #555;
  color: white;
}

div.content {
  margin-left: 200px;
  padding: 1px 16px;
  height: 1000px;
}




}
</style>
</head>

<?php
session_start();
if(!(isset($_SESSION['userType']))){
    echo "<script>
    
        var xmlhttp = new XMLHttpRequest();
        xmlhttp.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
            document.getElementById('fields').innerHTML = ''; //empty form before appending
            document.getElementById('fields').innerHTML += this.responseText; // append retrieved fields
            }
        };
        xmlhttp.open('GET', 'buttons.php?id=' + "."1".", true); //request to getFormFields with paymentMethodId to get the fields
        xmlhttp.send();
    
   
    
    </script>";
}
?>
<body>

<div class="sidebar">
<a href='#' class='logo' ><img src="http://www.emss.gov.eg/assets/finle/images/logo-header.png" alt="" width="120px" height="100%"></a>

<div id = "fields">
<a  href="#home">SignIn</a>
  <a href="logOut.php">Signup</a>
  
  </div>
</div>
</body>
</html>