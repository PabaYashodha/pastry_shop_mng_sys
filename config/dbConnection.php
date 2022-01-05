<?php
class dbConnection{
    private $conn;
    private const hostname = "localhost";
    private const username = "root";
    private const password = "";
    private const dbname = "pastryshop_db";

    private $result;

    public function __construct()//when db object create this function automatically call 
    {
        $this->conn = new mysqli(//create db connection
            self::hostname,
            self::username,
            self::password,
            self::dbname
        );
        
        if (!$this->conn->connect_error) {
            $this->result = $this->conn;
        }else{
            $this->result = $this->conn;
        }           
    }

    public function connection(){
        $result = $this->result;
        return $result;
    }
}