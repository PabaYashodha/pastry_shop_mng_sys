<?php
include_once '../../config/dbConnection.php'; //include database page
// new dbConnection; //create database object
class User
{
    private $db;

    public function __construct()
    {
        $this->db = new dbConnection;
    }

    public function newEmp()
    { //get new employee id
        $conn = $this->db->connection();
        $sql = "SELECT count(user_id) FROM user";
        $result = $conn->query($sql);
        $row = $result->num_rows;
        if ($row == 0) {
            $newId = "EMP0001";
            return $newId;
        } else {
            $row = $result->fetch_array();
            $count = $row[0];
            $count++;
            $newId = "EMP" . str_pad($count, 5, "0", STR_PAD_LEFT);
            return $newId;
        }
    }

    public function checkContactIsExist($contact)
    {
         $conn = $this->db->connection();
        $sql = "SELECT `user_contact` FROM `user` WHERE `user_contact`='$contact'";
        $result = $conn->query($sql) or die($conn->error);
        return ($result->num_rows>0) ? false : true;        
    }

    public function checkEmailIsExist($email)
    {
         $conn = $this->db->connection();
        $sql = "SELECT `user_email` FROM `user` WHERE `user_email`='$email'";
        $result = $conn->query($sql) or die($conn->error);
        return ($result->num_rows>0) ? false : true;
    }

    public function checkNicIsExist($nic)
    {
        $conn = $this->db->connection();
       $sql = "SELECT `user_nic` FROM `user` WHERE `user_nic`='$nic'";
       $result= $conn->query($sql) or die($conn->error);
       return ($result->num_rows>0) ? false : true;
    }
    
    public function addUser($userId, $firstName, $lastName,  $contact, $birthday, $gender, $nic, $email, $role,  $add1,  $add2,  $add3, $image)
    {
        $today = date("Y-m-d");
         $conn = $this->db->connection();
        $sql = "INSERT INTO `user` (`user_id`, `user_fname`, `user_lname`,  `user_contact`, `user_dob`, `user_gender`, `user_nic`, `user_email`, `role_role_id`,  `user_add1`, `user_add2`,  `user_add3`, `user_image`, `user_create_date`)
                VALUES ('$userId', '$firstName', '$lastName',  '$contact','$birthday', '$gender', '$nic', '$email', '$role', '$add1', '$add2', '$add3', '$image', '$today')";
        $result = $conn->query($sql) or die($conn->error);
        return $result;
    }

    public function getUserData()
    {
         $conn = $this->db->connection();
        $sql = "SELECT * FROM `user`";
        $result = $conn->query($sql) or die($conn->error);
        return $result;
    }

    public function viewUserDetails($userId)
    {
         $conn = $this->db->connection();
        $sql = "SELECT * FROM `user` WHERE `user_id`='$userId'";
        $result = $conn->query($sql) or die($conn->error);
        return $result;
    }
    
    public function editUser($userId, $firstName, $lastName,  $contact, $birthday, $gender, $nic, $email, $role,  $add1,  $add2,  $add3, $image)
    {
         $conn = $this->db->connection();
        if ($image == 1) {
            $sql = "UPDATE `user` SET  `user_fname`='$firstName', `user_lname`='$lastName',  `user_contact`='$contact', `user_dob`='$birthday', `user_gender`='$gender', `user_nic`='$nic', `user_email`='$email', `role_role_id`='$role',  `user_add1`='$add1', `user_add2`='$add2',  `user_add3`='$add3' WHERE `user_id`='$userId' "; 
        }else{
            $sql = "UPDATE `user` SET  `user_fname`='$firstName', `user_lname`='$lastName',  `user_contact`='$contact', `user_dob`='$birthday', `user_gender`='$gender', `user_nic`='$nic', `user_email`='$email', `role_role_id`='$role',  `user_add1`='$add1', `user_add2`='$add2',  `user_add3`='$add3', `user_image`='$image' WHERE `user_id`='$userId' ";
        }
        $result = $conn->query($sql) or die($conn->error);
        return $result;
    }
    
    public function changeUserStatus($userId, $userStatus)
    {
         $conn = $this->db->connection();
        $sql = "UPDATE `user` SET `user_status` = '$userStatus' WHERE `user_id` = '$userId'";
        if ($userStatus == 1) {
            $sql1 = "UPDATE `user_login` SET `user_login_status` = '1' WHERE `user_user_id` = '$userId'";
        }else{
            $sql1 = "UPDATE `user_login` SET `user_login_status` = '0' WHERE `user_user_id` = '$userId'";
        }
        $result = $conn->query($sql) or die($conn->error);
        $conn->query($sql1) or die($conn->error);
        return $result;
    }

    public function makeUserLogin($userName, $password, $userId)
    {
         $conn = $this->db->connection();
        $sql = "INSERT INTO `user_login` (`user_login_username`, `user_login_password`, `user_user_id`) VALUES('$userName', '$password', '$userId')";
        $result = $conn->query($sql) or die($conn->error);
        return $result;
    }
}