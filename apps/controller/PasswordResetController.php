<?php
session_start();
include_once '../model/PasswordReset.php';
$passwordResetObj = new PasswordReset();
$status = $_REQUEST['status'];

switch ($status) {
    case 'getUserName':
        $searchKey = $_REQUEST['userResetName'];
        $getUserName = $passwordResetObj->getUserName($searchKey);
        // $searchResult[] = array();
       // print_r($getUserName);
        while ($row = $getUserName->fetch_assoc()) {
            $searchResult[] = array(
                "id" => $row['user_id'],
                "value" => $row['user_fname'],
                "name"=> $row['user_lname']
                // "price" => $row['user_nic']
            );
        }
        echo json_encode($searchResult);
        break;

    case 'adminResetPassword':
        $userResetId= base64_decode($_POST['userResetId']);
        $getNic = $passwordResetObj->getNic($userResetId);
        $nic = $getNic->fetch_assoc();
        $resetPassword = sha1($nic['user_nic']);
        $resetPassword = strtoupper($resetPassword); //convert password to uppercase
        $updatePassword = $passwordResetObj->updatePassword($resetPassword, $userResetId);
        // print_r($updatePassword) ; 
        if ($updatePassword>0) {
            echo 1;
        }else{
            echo $updatePassword;
        } 
        break;    

    case 'resetPassword':
        $currentPassword = sha1($_POST['currentPassword']) ;
        $newPassword =$_POST['newPassword'];
        $confirmPassword = sha1($_POST['confirmPassword']);
        $confirmPassword = strtoupper($confirmPassword);

        if ($currentPassword=="") {
            throw new Exception("Current password is required");
        }
        if ($newPassword=="") {
            throw new Exception("New password is required");
        }
        if ($confirmPassword=="") {
            throw new Exception("confirm password is required");
        }
        $userId = $_SESSION['user']['user_id'];
        $result = $passwordResetObj->checkCurrentPassword($currentPassword,$userId);
        //print_r($result) ;
        if ($result->num_rows!=1) {
            throw new Exception("Current password is not match");
        }
        $updateUserPassword = $passwordResetObj->updateUserPassword($userId,$confirmPassword);
       // print_r($updateUserPassword);
        if ($updateUserPassword>0) {
            echo 1;
        }else{
            echo $updateUserPassword;
        }
        break;    
}
