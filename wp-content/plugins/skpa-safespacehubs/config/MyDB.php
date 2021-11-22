<?php

Class MyDB {

protected $_DB_HOST = 'localhost';
protected $_DB_USER = 'root';
protected $_DB_PASS = 'admin';
protected $_DB_NAME = 'dbsafespaces';
protected $_conn;

    public function __construct() {
        $this->_conn = mysqli_connect($this->_DB_HOST, $this->_DB_USER, $this->_DB_PASS);
        if($this->_conn) {
        //    echo 'We are connected!<br>';
        }
    }

    public function connect() {
        if(!mysqli_select_db($this->_conn, $this->_DB_NAME)) {
            die("failed to connect to database<br>");
        }

        return $this->_conn;
    }

}

?>