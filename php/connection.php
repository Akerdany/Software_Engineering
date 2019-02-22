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

    function getConnection(){
 
        return $connection;
    }
    Class DbConnection{
        function getdbconnect(){
            $conn = mysqli_connect("localhost", "root", "", "Database") or die("Couldn't connect");
    
            return $conn;
        }
    }
?>