<?php
include_once '../../config/dbConnection.php'; 
new dbConnection; 

class Login{
    private $db;

    public function __construct()
    {
        $this->db =new dbConnection();
    }
    public function validateLogin()
    {
        
        return $result;
    }
}
?>