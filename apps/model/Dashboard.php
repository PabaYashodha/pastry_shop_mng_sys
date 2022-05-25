<?php
include_once '../../config/dbConnection.php';
class Module
{

    private $db;

    public function __construct()
    {
        $this->db = new dbConnection; //create object of dbConnection class
    }

    public function getModule()
    {
        $conn = $this->db->connection();
        $sql = "SELECT * FROM `module`";
        $result = $conn->query($sql) or die($conn->error);
        return $result;
    }

    public function getNewOrderCount()
    {
        $conn = $this->db->connection();
        $sql = "SELECT COUNT(`ordertb_status`) FROM `ordertb` WHERE `ordertb_status`='1'";
        $result = $conn->query($sql) or die($conn->error);
        return $result;
    }
}
