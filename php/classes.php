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
        public $isDeleted;

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

        public function userQuery($id){
            $DB = new DbConnection();

            $sql = "SELECT * FROM user WHERE id='".$id."'";
            $result = mysqli_query($DB->getdbconnect(), $sql);      

            // list($id, $firstName, $lastName, $email, $password, $dateOfBirth, $telephone, $ssn, $addressId, $userTypeId, $isDeleted) = mysqli_fetch_array($result);
            if($row = mysqli_fetch_array($result)){

                $this->id=$row['id'];
                $this->firstName=$row['firstName'];
                $this->lastName=$row['lastName'];
                $this->email=$row['email'];
                $this->password=$row['password'];
                $this->dateOfBirth=$row['dateOfBirth'];
                $this->telephone=$row['telephone'];
                $this->ssn=$row['ssn'];
                $this->addressId=$row['addressId'];
                $this->userTypeId=$row['userTypeId'];
                $this->isDeleted=$row['isDeleted'];

                return true;
            }
            else{
                echo "ERROR: Could not able to execute $sql. ". mysqli_error($DB->getdbconnect());
                return false;
            }
        }

        public function insertUser($tempUser){
            $DB = new DbConnection();

            $sql = "INSERT INTO `user` (`id`, `firstName`, `lastName`, `email`, `password`, `dateOfBirth`, `addressId`, `userTypeId`, `telephone`, `ssn`)
                        VALUES (NULL,'".$tempUser->firstName."','".$tempUser->lastName."','".$tempUser->email."','".$tempUser->password."',
                        '".$tempUser->dateOfBirth."','".$tempUser->addressId."','".$tempUser->userTypeId."','".$tempUser->telephone."','".$tempUser->ssn."')";
            
            if($result = mysqli_query($DB->getdbconnect(), $sql)){
                return true;
            }      
            else{
                echo "ERROR: Could not able to execute $sql. ". mysqli_error($DB->getdbconnect());
                return false;
            }
        }

        //print the user:

        public function printo(){

            // $DB = new DbConnection();

            // $sql = "SELECT * FROM user WHERE id='".$id."'";
            // $result = mysqli_query($DB->getdbconnect(), $sql);      

            // list($id, $firstName, $lastName, $email, $password, $dateOfBirth, $telephone, $ssn, $addressId, $userTypeId, $isDeleted) = mysqli_fetch_array($result);

            echo"id: ".$this->id;
            echo"<br>";
            echo"First Name: ".$this->firstName;
            echo"<br>";
            echo"Last Name: ".$this->lastName;
            echo"<br>";
            echo"Email: ".$this->email;
            echo"<br>";
            echo"Password: ".$this->password;
            echo"<br>";
            echo"dateOfBirth: ".$this->dateOfBirth;
            echo"<br>";
            echo"Telephone: ".$this->telephone;
            echo"<br>";
            echo"SSN: ".$this->ssn;
            echo"<br>";

        }

        public function updateUser($tempUser){
            $DB = new DbConnection();

            $sql = "UPDATE user SET firstName='$tempUser->firstName', lastName='$tempUser->lastName', email='$tempUser->email', 
                        password='$tempUser->password', dateOfBirth='$tempUser->dateOfBirth', telephone='$tempUser->telephone', 
                        ssn='$tempUser->ssn', addressId='$tempUser->addressId', userTypeId='$tempUser->userTypeId' WHERE id=$tempUser->id";

            if($result = mysqli_query($DB->getdbconnect(), $sql)){
                return true;
            }      
            else{
                echo "ERROR: Could not able to execute $sql. ". mysqli_error($DB->getdbconnect());
                return false;
            }
        }

        public function deleteUser($id){
            $DB = new DbConnection();

            $sql = "UPDATE user SET isDeleted=1 WHERE id=$id";

            if($result = mysqli_query($DB->getdbconnect(), $sql)){
                return true;
            }      
            else{
                echo "ERROR: Could not able to execute $sql. ". mysqli_error($DB->getdbconnect());
                return false;
            }
        }

        public function logIn($email, $pass){
            $DB = new DbConnection();


            $sql = "SELECT * FROM user WHERE email='".$email."'";
            $result = mysqli_query($DB->getdbconnect(), $sql);      
    
            if(mysqli_num_rows($result) > 0){
                $row = mysqli_fetch_array($result);
                $password_hash = $row['password'];
    
                if(password_verify($pass, $password_hash) && $row['isDeleted'] == 0){
                    session_start();
    
                    $_SESSION['id'] = $row['id'];
                    $_SESSION['email'] = $row['email'];
                    $_SESSION['userType'] = $row['userTypeId'];
                    $_SESSION['addressID'] = $row['addressId'];

                    return true;
                }
                else{
                    return false;
                }
            }
            else{
                return false;
            }
        }
    }

?>