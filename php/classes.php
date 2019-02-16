<?php
    require_once("connection.php");

    class User {

        public $id;
        public $firstName;
        public $lastName;
        public $email;
        public $dateOfBirth;
        public $addressId;
        public $userTypeId;

        public static function userQuery($id){
            $DB = new DbConnection();

            $sql = "SELECT * FROM user WHERE id='".$id."'";
            $result = mysqli_query($DB->getdbconnect(), $sql);      

            list($id, $firstName, $lastName, $email, , $dateOfBirth, $addressId, $userTypeId) = mysqli_fetch_array($result);

        }

        //print the user:
        public static function print($id){
            $DB = new DbConnection();

            $sql = "SELECT * FROM user WHERE id='".$id."'";
            $result = mysqli_query($DB->getdbconnect(), $sql);      

            list($id, $firstName, $lastName, $email, , $dateOfBirth, $addressId, $userTypeId) = mysqli_fetch_array($result);

            echo"id:".$id;
            echo"<br>";
            echo"First Name: ".$firstName;
            echo"<br>";
        }

        public static function insertUser(){

        }
    }

?>