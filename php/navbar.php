

<html>
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">

        

         <!-- Bootstrap CSS CDN -->
        <!-- <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css"> -->
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">

        <!-- Our Custom CSS -->
        <link rel="stylesheet"href="../css/style5.css">
    </head>
    <body>
    
    <?php
    echo'<link href="../css/BG.css" rel="stylesheet" type="text/css">';
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
                        xmlhttp.open('GET', 'buttons1.php?id=' + '".$_SESSION['userType']."', true); //request to getFormFields with paymentMethodId to get the fields
                        xmlhttp.send();
                    
                
                    
                    </script>";
                }
                ?>
    


    <button  type="button" id="sidebarCollapse" class="navbar-btn active">
        
        <span ></span>
        <span ></span>
        <span ></span>
    </button>     
        <div class="wrapper">
        
            <nav id="sidebar" class = "active">
           
                <div class="sidebar-header">
               
                        <a href='index.php' class='logo' class="sideNavLink"><img src="http://www.emss.gov.eg/assets/finle/images/logo-header.png" alt="" width="120px" height="120px"></a>
                </div>

                <ul id = "fields" class="list-unstyled components">
                   
                    <li class="active">
                            <a href="logIn.php" class="sideNavLink">SignIn</a>
                            <a href="registration.php" class="sideNavLink">Signup</a>
                    </li>
                  
                </ul>

                
            </nav>

            <!-- Page Content Holder -->
            <div id="content">

                

                
            </div>
        </div>





        <!-- jQuery CDN -->
         <script src="https://code.jquery.com/jquery-1.12.0.min.js"></script>
         <!-- Bootstrap Js CDN -->
         <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>

         <script type="text/javascript">
             $(document).ready(function () {
                 $('#sidebarCollapse').on('click', function () {
                     $('#sidebar').toggleClass('active');
                     $(this).toggleClass('active');
                 });
             });
         </script>
       
        <body>
</html>
