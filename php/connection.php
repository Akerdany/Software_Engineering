<?php
Class DbConnection {

    private $_connection;
    private static $_instance;
    private $_host     = "localhost";
    private $_username = "root";
    private $_password = "";
    private $_database = "Database";

    public static function getInstance() {

        if (!self::$_instance) {
            // If no instance then make one
            self::$_instance = new self();
        }
        return self::$_instance;
    }

    // Constructor
    public function __construct() {

        $this->_connection = new mysqli($this->_host, $this->_username,
            $this->_password, $this->_database);

        if (mysqli_connect_error()) {
            trigger_error("Failed to conencto to MySQL: " . mysql_connect_error(),
                E_USER_ERROR);
        }
    }

    private function __clone() {}

    public function getdbconnect() {

        return $this->_connection;
    }

    public function closeConnection() {
        mysqli_close($this->_connection);
        echo "Connection was closed";
    }
}
?>