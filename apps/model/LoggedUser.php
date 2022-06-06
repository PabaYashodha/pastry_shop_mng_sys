<?php
include_once '../../config/dbConnection.php';

class LoggedUser
{
    private $db;
    public function __construct()
    {
        $this->db = new dbConnection();
    }

    public function viewLoggedUserDetails($loggedUserId)
    {
        $conn = $this->db->connection();
        $sql =  "SELECT * FROM `user` WHERE `user_id`= '$loggedUserId'";
        $result = $conn->query($sql) or die($conn->error);
        return $result;
    }

    public function editLoggedUser($loggedUserId,$userFirstName,$userLastName,$userContact,$userBirthday,$userNic,$userEmail,$userAdd1,$userAdd2,$userAdd3,$image)
    {
        $conn = $this->db->connection();
        if ($image == 1) {
            $sql = "UPDATE `user` SET  `user_fname`='$userFirstName', `user_lname`='$userLastName',  `user_contact`='$userContact', `user_dob`='$userBirthday', `user_nic`='$userNic', `user_email`='$userEmail', `user_add1`='$userAdd1', `user_add2`='$userAdd2',  `user_add3`='$userAdd3' WHERE `user_id`='$loggedUserId' "; 
        }else{
            $sql = "UPDATE `user` SET  `user_fname`='$userFirstName', `user_lname`='$userLastName',  `user_contact`='$userContact', `user_dob`='$userBirthday', `user_nic`='$userNic', `user_email`='$userEmail', `user_add1`='$userAdd1', `user_add2`='$userAdd2',  `user_add3`='$userAdd3', `user_image`='$image' WHERE `user_id`='$loggedUserId' ";
        }
        $result = $conn->query($sql) or die($conn->error);
        return $result;
    }
}