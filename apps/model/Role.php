<?php 
include_once '../../config/dbConnection.php';

class Role 
{
    private $db;

    public function __construct()
    {
      $this->db= new dbConnection();  
    }

    public function getRoleNameById($roleId)
    {
        $conn= $this->db->connection();
        $sql = "SELECT `role_id`, `role_name` FROM `role` WHERE `role_id` = '$roleId'";
        $roleName = $conn->query($sql) or die($conn->error);
        return $roleName;
    }

    public function getRole()
    {
        $conn= $this->db->connection();
        $sql= "SELECT `role_id`, `role_name` FROM `role`";
        $getRole =$conn->query($sql) or die($conn->error);
        return $getRole;
    }
}