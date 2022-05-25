<?php
include_once '../../config/dbConnection.php';
class PasswordReset
{
    private $db;
    public function __construct()
    {
        $this->db = new dbConnection();
    }

    public function getUserName($searchKey)
    {
        $conn = $this->db->connection();
        $sql = "SELECT `user_fname`, `user_lname`, `user_id` FROM `user` WHERE (`user_fname` LIKE '%$searchKey%' OR `user_lname` LIKE '%$searchKey%')";
        $getUserName = $conn->query($sql) or die($conn->error);
        return $getUserName;
    }
    public function getNic($userResetId)
    {
        $conn = $this->db->connection();
        $sql = "SELECT `user_nic` FROM `user` WHERE `user_id`='$userResetId'";
        $getNic = $conn->query($sql) or die($conn->error);
        return $getNic;
    }
    public function updatePassword($resetPassword,$userResetId) //admin user password reset
    {
       $conn = $this->db->connection();
       $sql = "UPDATE `user_login` SET `user_login_password` = '$resetPassword' , `user_login_pwd_change`='1' WHERE `user_user_id`='$userResetId'";
       $updatePassword = $conn->query($sql) or die($conn->error);
       return $updatePassword;
    }

    public function checkCurrentPassword($currentPassword,$userId)
    {
        $conn = $this->db->connection();
        $sql = "SELECT `user_login_password` FROM `user_login` WHERE `user_login_password`='$currentPassword' AND `user_user_id`='$userId'";
        $result=$conn->query($sql) or die($conn->error);
        return $result;
    }

    public function updateUserPassword($userId,$confirmPassword)
    {
        $conn = $this->db->connection();
       $sql = "UPDATE `user_login` SET `user_login_password` = '$confirmPassword' , `user_login_pwd_change`='1' WHERE `user_user_id`='$userId'";
       $updateUserPassword = $conn->query($sql) or die($conn->error);
       return $updateUserPassword;
    }
}
