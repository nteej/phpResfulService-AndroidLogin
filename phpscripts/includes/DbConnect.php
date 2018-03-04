<?php

class DbConnect{
    private $conn;
    function _construct(){

    }
    function connect(){
        include_once dirname(__FILE__).'/constants.php';
    $this->conn= new mysqli(db_host,db_user,db_password,db_name);

    if(mysqli_connect_errno()){
        echo "Failed to connect to the database".mysqli_connect_error();
    }
    return $this->conn;
    }
}