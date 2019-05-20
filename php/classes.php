<?php
require_once "connection.php";

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
    public $notifier;

    public function userData($ID, $FIRSTNAME, $LASTNAME, $EMAIL, $PASSWORD, $DATEOFBIRTH, $TELEPHONE, $SSN, $ADDRESS, $USER, $NOTIFIER) {
        $this->id          = $ID;
        $this->firstName   = $FIRSTNAME;
        $this->lastName    = $LASTNAME;
        $this->email       = $EMAIL;
        $this->password    = $PASSWORD;
        $this->dateOfBirth = $DATEOFBIRTH;
        $this->telephone   = $TELEPHONE;
        $this->ssn         = $SSN;
        $this->addressId   = $ADDRESS;
        $this->userTypeId  = $USER;
        $this->notifier    = $NOTIFIER;
    }

    public function userQuery($id) {
        // $DB = new DbConnection();
        $DB = DbConnection::getInstance();

        $sql    = "SELECT * FROM user WHERE id='" . $id . "'";
        $result = mysqli_query($DB->getdbconnect(), $sql);

        // list($id, $firstName, $lastName, $email, $password, $dateOfBirth, $telephone, $ssn, $addressId, $userTypeId, $isDeleted) = mysqli_fetch_array($result);
        if ($row = mysqli_fetch_array($result)) {

            $this->id          = $row['id'];
            $this->firstName   = $row['firstName'];
            $this->lastName    = $row['lastName'];
            $this->email       = $row['email'];
            $this->password    = $row['password'];
            $this->dateOfBirth = $row['dateOfBirth'];
            $this->telephone   = $row['telephone'];
            $this->ssn         = $row['ssn'];
            $this->addressId   = $row['addressId'];
            $this->userTypeId  = $row['userTypeId'];
            $this->isDeleted   = $row['isDeleted'];

            return true;
        } else {
            echo "ERROR: Could not able to execute $sql. " . mysqli_error($DB->getdbconnect());
            return false;
        }
    }

    public function insertUser($tempUser) {
        // $DB = new DbConnection();
        $DB = DbConnection::getInstance();

        $date = date('Y-m-d H:i:s');

        $query      = "SELECT * FROM user WHERE email='$tempUser->email'";
        $result     = mysqli_query($DB->getdbconnect(), $query);
        $user_count = mysqli_num_rows($result);

        if ($user_count > 0) {
            return false;
        } else {

            $sql = "INSERT INTO `user` (`id`, `firstName`, `lastName`, `email`, `password`, `dateOfBirth`, `addressId`, `userTypeId`, `telephone`, `ssn`, `creationDate`)
            VALUES (NULL,'" . $tempUser->firstName . "','" . $tempUser->lastName . "','" . $tempUser->email . "','" . $tempUser->password . "',
            '" . $tempUser->dateOfBirth . "','" . $tempUser->addressId . "','" . $tempUser->userTypeId . "','" . $tempUser->telephone . "','" . $tempUser->ssn . "','" . $date . "')";

            if ($result = mysqli_query($DB->getdbconnect(), $sql)) {

                $sql2    = "SELECT * FROM user WHERE email='$tempUser->email' AND creationDate='$date'";
                $result2 = mysqli_query($DB->getdbconnect(), $sql2);

                $userId = mysqli_fetch_assoc($result2);
                $userId = $userId['id'];
                print_r($userId);

                if ($tempUser->notifier == 1) {
                    $detail = "+2" . $tempUser->telephone;
                } elseif ($tempUser->notifier == 2) {
                    $detail = $tempUser->email;
                }

                $sql3 = "INSERT INTO `user_notifiers` VALUES(NULL, $userId,'$tempUser->notifier','$detail')";
                if ($result3 = mysqli_query($DB->getdbconnect(), $sql3)) {
                    return true;
                } else {
                    echo "ERROR: Could not able to execute $sql3. " . mysqli_error($DB->getdbconnect());
                    return false;
                }
            } else {
                echo "ERROR: Could not able to execute $sql. " . mysqli_error($DB->getdbconnect());
                return false;
            }
        }
    }

    //print the user:

    public function printo() {

        // $DB = new DbConnection();

        // $sql = "SELECT * FROM user WHERE id='".$id."'";
        // $result = mysqli_query($DB->getdbconnect(), $sql);

        // list($id, $firstName, $lastName, $email, $password, $dateOfBirth, $telephone, $ssn, $addressId, $userTypeId, $isDeleted) = mysqli_fetch_array($result);

        echo "id: " . $this->id;
        echo "<br>";
        echo "First Name: " . $this->firstName;
        echo "<br>";
        echo "Last Name: " . $this->lastName;
        echo "<br>";
        echo "Email: " . $this->email;
        echo "<br>";
        echo "Password: " . $this->password;
        echo "<br>";
        echo "dateOfBirth: " . $this->dateOfBirth;
        echo "<br>";
        echo "Telephone: " . $this->telephone;
        echo "<br>";
        echo "SSN: " . $this->ssn;
        echo "<br>";

    }

    public function updateUser($tempUser) {
        // $DB = new DbConnection();
        $DB = DbConnection::getInstance();

        $sql = "UPDATE user SET firstName='$tempUser->firstName', lastName='$tempUser->lastName', email='$tempUser->email',
                        password='$tempUser->password', dateOfBirth='$tempUser->dateOfBirth', telephone='$tempUser->telephone',
                        ssn='$tempUser->ssn', addressId='$tempUser->addressId', userTypeId='$tempUser->userTypeId' WHERE id=$tempUser->id";

        if ($result = mysqli_query($DB->getdbconnect(), $sql)) {
            return true;
        } else {
            echo "ERROR: Could not able to execute $sql. " . mysqli_error($DB->getdbconnect());
            return false;
        }
    }

    public function deleteUser($id) {
        // $DB = new DbConnection();
        $DB = DbConnection::getInstance();

        $sql = "UPDATE user SET isDeleted=1 WHERE id=$id";

        if ($result = mysqli_query($DB->getdbconnect(), $sql)) {
            return true;
        } else {
            echo "ERROR: Could not able to execute $sql. " . mysqli_error($DB->getdbconnect());
            return false;
        }
    }

    public function activateUser($id) {
        // $DB = new DbConnection();
        $DB = DbConnection::getInstance();

        $sql = "UPDATE user SET isDeleted=0 WHERE id=$id";

        if ($result = mysqli_query($DB->getdbconnect(), $sql)) {
            return true;
        } else {
            echo "ERROR: Could not able to execute $sql. " . mysqli_error($DB->getdbconnect());
            return false;
        }
    }

    public function editUserType($id, $newUserType) {
        // $DB = new DbConnection();
        $DB = DbConnection::getInstance();

        $sql = "UPDATE user SET userTypeId=$newUserType WHERE id=$id";

        if ($result = mysqli_query($DB->getdbconnect(), $sql)) {
            return true;
        } else {
            echo "ERROR: Could not able to execute $sql. " . mysqli_error($DB->getdbconnect());
            return false;
        }
    }

    public function logIn($email, $pass) {
        // $DB = new DbConnection();
        $DB = DbConnection::getInstance();

        $sql    = "SELECT * FROM user WHERE email='" . $email . "'";
        $result = mysqli_query($DB->getdbconnect(), $sql);

        if (mysqli_num_rows($result) > 0) {
            $row           = mysqli_fetch_array($result);
            $password_hash = $row['password'];

            if (password_verify($pass, $password_hash) && $row['isDeleted'] == 0) {
                if (session_status() == PHP_SESSION_NONE) {
                    session_start();
                }

                $_SESSION['id']        = $row['id'];
                $_SESSION['email']     = $row['email'];
                $_SESSION['userType']  = $row['userTypeId'];
                $_SESSION['addressID'] = $row['addressId'];

                //log hhh
                $logSql = 'INSERT INTO log (userID)
                VALUES("'.$_SESSION['id'].'")';
                mysqli_query($DB->getdbconnect(), $logSql);


                return true;
            } else {
                return false;
            }
        } else {
            return false;
        }
    }

    public function checkData($data) {
        // $DB = new DbConnection();
        $DB = DbConnection::getInstance();

        $data = strip_tags(mysqli_real_escape_string($DB->getdbconnect(), trim($data)));
        $data = stripslashes($data);
        $data = htmlspecialchars($data);

        return $data;
    }

    public function encrypt($password) {
        $password .= "!#$%&'()*+,-./:;<=>?@[\]^_`{|}~";
        $password = sha1($password);
        return $password;
    }

    public static function isSimilar($password, $enteredPassword) {
        $enteredPassword = sha1($enteredPassword . "!#$%&'()*+,-./:;<=>?@[\]^_`{|}~");
        if ($password == $enteredPassword) {
            return true;
        } else {
            return false;
        }
    }

    public function getPrivilege() {
        $DB     = DbConnection::getInstance();
        $sql    = "SELECT * FROM priviliges";
        $result = mysqli_query($DB->getdbconnect(), $sql);
        $array  = array();

        while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
            array_push($array, $row);
        }

        //free the memory is important with large data !!
        mysqli_free_result($result);

        return $array;
    }

    public function getUserTypes() {
        $DB     = DbConnection::getInstance();
        $sql    = "SELECT * FROM usertype";
        $result = mysqli_query($DB->getdbconnect(), $sql);
        $array  = array();

        while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
            array_push($array, $row);
        }

        //free the memory is important with large data !!
        mysqli_free_result($result);

        return $array;
    }

    public function addUserType($name) {
        $DB  = DbConnection::getInstance();
        $sql = "INSERT INTO `usertype` VALUES (NULL,'$name')";

        if ($result = mysqli_query($DB->getdbconnect(), $sql)) {
            return true;
        } else {
            echo "ERROR: Could not able to execute $sql. " . mysqli_error($DB->getdbconnect());
            return false;
        }
    }

    public function displayAllUsers() {
        // $DB = new DbConnection();
        $DB = DbConnection::getInstance();

        $sql    = "SELECT * FROM user";
        $result = mysqli_query($DB->getdbconnect(), $sql);
        $array  = array();

        while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
            array_push($array, $row);
        }

        //free the memory is important with large data !!
        mysqli_free_result($result);

        return $array;
    }

    public function getPermission($name) {
        $DB = DbConnection::getInstance();

        $permissionId = "SELECT * FROM permission WHERE name='$name'";

        if ($result = mysqli_query($DB->getdbconnect(), $permissionId)) {

            $ID = mysqli_fetch_assoc($result);
            $ID = $ID['id'];

            $userPermission = mysqli_query($DB->getdbconnect(), "SELECT * From usertype_permission WHERE userTypeId='" . $_SESSION["userType"] . "' AND permissionId=$ID");

            if (mysqli_num_rows($userPermission) > 0) {
                return true;
            } else {
                return false;
            }
        } else {
            return false;
        }
    }

    public function getUserTypeName($id) {
        $DB = DbConnection::getInstance();

        $usertypeId = "SELECT * FROM usertype WHERE id='$id'";

        $result = mysqli_query($DB->getdbconnect(), $usertypeId);

        $usertype = mysqli_fetch_assoc($result);

        return $usertype['userTypeName'];
    }
}

?>