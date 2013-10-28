<?php

class DatabaseLogin {
    
   //local Database
    /*
    private $db_host = 'localhost';
    private $db_database = 'mydb';
    private $db_username = 'root';
    private $db_password = '9AkumaDesu$$';
    */
 
    //remote db
    
    private $db_host = 'ec2-23-21-211-172.compute-1.amazonaws.com';
    private $db_database = 'mydbtm';
    private $db_username = 'TM';
    private $db_password = 'tarjetamultiproposito';
    
    
    public function getDbLocalHost() {
        return $this->db_host;
    }

    public function getDatabase() {
        return $this->db_database;
    }

    public function getDbUsername() {
        return $this->db_username;
    }

    public function getDbPassword() {
        return $this->db_password;
    }

}

?>
