<?php
session_start();
include_once '../model/Login.php';
$status = $_REQUEST['status'];
$loginObj = new Login(); //make login Object
switch($status){

    case"login":
        $username = $_POST["username"];
        $password = $_POST["password"];
        $password = sha1($password); // encrypting the pw
        $password = strtoupper($password); // convert the pw to uppercase
        $result = $loginObj->validateLogin($username, $password);
        //print_r($result);
        if ($result->num_rows==1){
            $userRow = $result->fetch_assoc();
            $userId = $userRow["user_id"];
            $roleId = $userRow["role_role_id"];
            $firstName = $userRow["user_fname"];
            $lastName = $userRow["user_lname"];
            $userArray = array("user_fname"=>$firstName, "user_lname"=>$lastName,
                "role_role_id"=>$roleId, "user_id"=>$userId);
           // print_r($userArray) ;   
            $_SESSION["user"] = $userArray; //add to session
            if ($userRow["user_login_pwd_change"]==0){
                // header("location:../view/passwordReset.php");
                echo 1;
            }elseif (isset($_SESSION["user"])){
                // header("location:../view/dashboard.php"); // others login
                echo 2;
            }
        }
        else{
            $msg = "The Credentials: username and the password does not match!";                        
            echo $msg;
            //header("location:../view/login.php?error=$msg;");
        }
     break;

    // case "logout":
    //     session_destroy();
    //     header("location:../view/login.php");
    //break;

}
