<?php
    require_once("connection.php");

    class User {

        public $id;
        public $firstName;
        public $lastName;
        public $email;
        public $password;
        public $dateOfBirth;
        public $telephone;
        public $ssn;
        public $addressId;
        public $userTypeId;
        public $userType;

        public function userData($ID, $FIRSTNAME, $LASTNAME, $EMAIL, $PASSWORD, $DATEOFBIRTH, $TELEPHONE, $SSN, $ADDRESS, $USER){
            $id = $ID;
            $firstName = $FIRSTNAME;
            $lastName = $LASTNAME;
            $email = $EMAIL;
            $password = $PASSWORD;
            $dateOfBirth = $DATEOFBIRTH;
            $telephone = $TELEPHONE;
            $ssn = $SSN;
            $addressId = $ADDRESS;
            $userTypeId = $USER;
        }

        public static function userQuery($id, $userTypeID){
            $DB = new DbConnection();

            $sql = "SELECT * FROM user WHERE id='".$id."'";
            $result = mysqli_query($DB->getdbconnect(), $sql);      

            list($id, $firstName, $lastName, $email, $password, $dateOfBirth, $dateOfBirth, $telephone, $ssn, $addressId, $userTypeId) = mysqli_fetch_array($result);

        }

        public static function insertUser($tempUser){
            $DB = new DbConnection();

            $sql = "INSERT INTO `user` (`id`, `firstName`, `lastName`, `email`, `password`, `dateOfBirth`, `addressId`, `userTypeId`)
                        VALUES (NULL,'".$tempUser->firstName."','".$tempUser->lastName."','".$tempUser->email."','".$tempUser->password."',
                        '".$tempUser->dateOfBirth."','".$tempUser->addressId."','".$tempUser->userTypeId."')";
            
            if($result = mysqli_query($DB->getdbconnect(), $sql)){
                return true;
            }      
            else{
                echo "ERROR: Could not able to execute $sql. ". mysqli_error($DB->getdbconnect());
                return false;
            }
        }

        //print the user:
        public static function print($id){
            $DB = new DbConnection();

            $sql = "SELECT * FROM user WHERE id='".$id."'";
            $connection = getConnection();
            $result = mysqli_query($connection, $sql);      

            list($id, $firstName, $lastName, $email, , $dateOfBirth, $addressId, $userTypeId) = mysqli_fetch_array($result);

            echo"id:".$id;
            echo"<br>";
            echo"First Name: ".$firstName;
            echo"<br>";
        }

        public static function updateUser($tempUser){
            $DB = new DbConnection();

            $sql = "UPDATE user SET firstName=$tempUser->firstName, lastName=$tempUser->lastName, email=$tempUser->email, 
                        password=$tempUser->password, dateOfBirth=$tempUser->dateOfBirth, telephone=$tempUser->telephone, 
                        ssn=$tempUser->ssn, addressId=$tempUser->addressId, userTypeId=$tempUser->userTypeId WHERE id='$tempUser->id";

            if($result = mysqli_query($DB->getdbconnect(), $sql)){
                return true;
            }      
            else{
                echo "ERROR: Could not able to execute $sql. ". mysqli_error($DB->getdbconnect());
                return false;
            }
        }

        public static function deleteUser($id){
            $DB = new DbConnection();

            $sql = "DELETE FROM user WHERE id=$id";

            if($result = mysqli_query($DB->getdbconnect(), $sql)){
                return true;
            }      
            else{
                echo "ERROR: Could not able to execute $sql. ". mysqli_error($DB->getdbconnect());
                return false;
            }
        }
    }

?>