<?php
    require_once("connection.php");

    class User {

        public $id;
        public $firstName;
        public $lastName;
        public $email;
        public $password;
        public $dateOfBirth;
        public $addressId;
        public $userTypeId;

        public static function userQuery($id){
            $DB = new DbConnection();

            $sql = "SELECT * FROM user WHERE id='".$id."'";
            $result = mysqli_query($DB->getdbconnect(), $sql);      

            list($id, $firstName, $lastName, $email, , $dateOfBirth, $addressId, $userTypeId) = mysqli_fetch_array($result);

        }

        public static function insertUser($tempUser){
            $DB = new DbConnection();

            $sql1 = "INSERT INTO `user` (`id`, `firstName`, `lastName`, `email`, `password`, `dateOfBirth`, `addressId`, `userTypeId`)
                        VALUES (NULL,'".$tempUser->firstName."','".$tempUser->lastName."','".$tempUser->email."','".$tempUser->password."',
                        '".$tempUser->dateOfBirth."','".$tempUser->addressId."','".$tempUser->userTypeId."')";
            
            if(mysqli_query($DB->getdbconnect(), $sql1)){
                header("location: ../php/logIn.php");
            }

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

        public static function updateUser(){
            $sql1 = "UPDATE user SET WHERE id='$id";
        }
    }

?>