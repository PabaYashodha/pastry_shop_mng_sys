<?php
include_once '../../config/dbConnection.php'; 
new dbConnection; 

class Login{
    private $db;

    public function __construct()
    {
        $this->db =new dbConnection();
    }
    public function validateLogin($username, $password)
    {
        $conn= $this->db->connection();
        $sql = "SELECT `u`.`user_fname`, `u`.`user_lname`, `u`.`role_role_id`, `u`.`user_id`, `l`.`user_login_pwd_change` FROM `user_login` `l`, `user` `u`
          WHERE `u`.`user_id` = `l`.`user_user_id` AND `l`.`user_login_username`='$username' AND `l`.`user_login_password`='$password'";
        $result = $conn->query($sql) or die($conn->error);
        return $result;
    }

    public function getRoleName($userRoleId)
    {
        $conn= $this->db->connection();
        $sql = "SELECT `role_name` FROM `role` WHERE `role_id`= $userRoleId";
        $result = $conn->query($sql) or die($conn->error);
        return $result;
    }

    public function getUserImage($userId)
    {
        $conn= $this->db->connection();
        $sql = "SELECT `user_image` FROM `user` WHERE `user_id`= '$userId'";
        $result = $conn->query($sql) or die($conn->error);
        return $result;
    }
}
?>