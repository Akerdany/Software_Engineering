<?php
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbName = "Database";

    // Create connection
    $connection = new mysqli($servername, $username, $password, $dbName);

    // Check connection
    if ($connection->connect_error) {
        die("Connection failed: " . $connection->connect_error);
    }

    //Database Conection for Classes:
    Class DbConnection{
        function getdbconnect(){
            $conn = mysqli_connect("localhost", "root", "", "Database");

            if ($conn->connect_error) {
                die("Connection failed: " . $conn->connect_error);
            }        
    
            return $conn;
        }
    }
?>