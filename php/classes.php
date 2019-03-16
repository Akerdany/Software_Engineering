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

            $date = date('Y-m-d H:i:s');

            $sql = "INSERT INTO `user` (`id`, `firstName`, `lastName`, `email`, `password`, `dateOfBirth`, `addressId`, `userTypeId`, `telephone`, `ssn`, `creationDate`)
                        VALUES (NULL,'".$tempUser->firstName."','".$tempUser->lastName."','".$tempUser->email."','".$tempUser->password."',
                        '".$tempUser->dateOfBirth."','".$tempUser->addressId."','".$tempUser->userTypeId."','".$tempUser->telephone."','".$tempUser->ssn."','".$date."')";
            
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

        public function activateUser($id){
            $DB = new DbConnection();

            $sql = "UPDATE user SET isDeleted=0 WHERE id=$id";

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

        public function checkData($data){
            $DB = new DbConnection();

            $data = strip_tags(mysqli_real_escape_string($DB->getdbconnect(), trim($data)));
            $data = stripslashes($data);
            $data = htmlspecialchars($data);

            return $data;
        }

        public function encrypt($password){
            $password .= "!#$%&'()*+,-./:;<=>?@[\]^_`{|}~";
            $password = sha1($password);
            return $password;
        }

        public static function isSimilar($password, $enteredPassword){
            $enteredPassword = sha1($enteredPassword."!#$%&'()*+,-./:;<=>?@[\]^_`{|}~");
            if($password == $enteredPassword){
                return true;
            }
            else{
                return false;
            }
        }

        public function displayAllUsers(){
            $sql = "SELECT * FROM user";
            $DB = new DbConnection();

            $result = mysqli_query($DB->getdbconnect(), $sql);
    
            if(mysqli_num_rows($result) > 0){
                // echo"<form id='form' name='form' method='post' action=''>";
                // echo "<input type='submit' id='Activate_Account' name='Activate_Account' value='Activate Account'>";
                // echo "<input type='submit' id='Decline_Account' name='Decline_Account' value='Decline Account'>";
                echo"<table id='table' border='1' class='displaytables'>
                    <tr>
                    <th>#</th>
                    <th>ID</th>
                    <th>Email</th>
                    <th>First Name</th>
                    <th>Last Name</th>
                    <th>Date of Birth</th>
                    <th>Telephone Number</th>
                    <th>SSN</th>
                    <th>Address</th>
                    <th>Type of User</th>
                    <th>Account Status</th>
                    <th>Action</th>
                    <th>Date & Time Joined</th>
                    </tr>";
    
                while($row = mysqli_fetch_array($result)){
                    echo "<tr>";
                    echo "<td><input type='checkbox' name='checkbox[]' id='checkbox[]' value=".$row['id']."></td>";
                    echo "<td>" .$row['id']. "</td>";
                    echo "<td>" .$row['email']. "</td>";
                    echo "<td>" .$row['firstName']. "</td>";
                    echo "<td>" .$row['lastName']."</td>";
                    echo "<td>" .$row['dateOfBirth']. "</td>";
                    echo "<td>" .$row['telephone']."</td>";
                    echo "<td>" .$row['ssn']. "</td>";
                    echo "<td>" .$row['addressId']. "</td>";
    
                    $userType = mysqli_query($DB->getdbconnect(), "SELECT * FROM usertype WHERE id='".$row["userTypeId"]."'");
                    if($r = mysqli_fetch_array($userType)){
                        echo "<td>" .$r['userTypeName']. "</td>";
                    }
    
                    if($row['isDeleted'] == 0){
                        echo "<td>Active</td>";
                        echo '<td> <form action="deleteUser.php" method="POST">'
                        .'<button type="submit" name="deleteUserButton" value="'.$row['id'].'">Delete User</button>'
                        .'</form></td>';
                    }
                    else{
                        echo "<td>Deleted</td>";
                        echo '<td> <form action="activateUser.php" method="POST">'
                        .'<button type="submit" name="activateUserButton" value="'.$row['id'].'">Activate User</button>'
                        .'</form></td>';
                    }
    
                    echo "<td>".$row['creationDate']."</td>";
                    echo "</tr>";
                }
                echo "</table>";
                // echo "</form>";
            }   
            echo '<a href= "registration.php" class="button">Add User</a><br><br>';
            mysqli_close($DB->getdbconnect()); 
        }
    }

?>