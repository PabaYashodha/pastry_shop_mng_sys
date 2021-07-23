<?php
include_once '../../config/dbConnection.php'; //include database page
new dbConnection; //create database object

class User
{
    public function newEmp()
    { //get new employee id
        $conn = $GLOBALS['con'];
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
        $conn = $GLOBALS['con'];
        $sql = "SELECT `user_contact` FROM `user` WHERE `user_contact`='$contact'";
        $result = $conn->query($sql) or die($conn->error);
        return ($result->num_rows>0) ? false : true;        
    }

    public function checkEmailIsExist($email)
    {
        $conn = $GLOBALS['con'];
        $sql = "SELECT `user_email` FROM `user` WHERE `user_email`='$email'";
        $result = $conn->query($sql) or die($conn->error);
        return ($result->num_rows>0) ? false : true;
    }

    public function checkNicIsExist($nic)
    {
       $conn = $GLOBALS['con'];
       $sql = "SELECT `user_nic` FROM `user` WHERE `user_nic`='$nic'";
       $result= $conn->query($sql) or die($conn->error);
       return ($result->num_rows>0) ? false : true;
    }
    

    public function addUser($userId, $firstName, $lastName,  $contact, $birthday, $gender, $nic, $email, $role,  $add1,  $add2,  $add3, $image)
    {
        $today = date("Y-m-d");
        $conn = $GLOBALS['con'];
        $sql = "INSERT INTO `user` (`user_id`, `user_fname`, `user_lname`,  `user_contact`, `user_dob`, `user_gender`, `user_nic`, `user_email`, `role_role_id`,  `user_add1`, `user_add2`,  `user_add3`, `user_image`, `user_create_date`)
                VALUES ('$userId', '$firstName', '$lastName',  '$contact','$birthday', '$gender', '$nic', '$email', '$role', '$add1', '$add2', '$add3', '$image', '$today')";
        $result = $conn->query($sql) or die($conn->error);
        return $result;
    }

    public function getUserData()
    {
        $conn = $GLOBALS['con'];
        $sql = "SELECT * FROM `user`";
        $result = $conn->query($sql) or die($conn->error);
        return $result;
    }
}