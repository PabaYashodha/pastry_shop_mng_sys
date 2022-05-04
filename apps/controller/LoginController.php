<?php
session_start();
$status = $_REQUEST['status'];
include '../model/loginModel.php';
$loginObj = new login(); //make login Object
switch($status){

    case"login":
        $uname = $_POST["username"];
        $pw = $_POST["password"];
        $pw = sha1($pw); // encrypting the pw
        $pw = strtoupper($pw); // convert the pw to uppercase
        $result = $loginObj->validateLogin($uname, $pw);
        if ($result->num_rows==1){
            $userRow = $result->fetch_assoc();
            $userId = $userRow["emp_id"];
            $roleId = $userRow["role_role_id"];
            $firstName = $userRow["emp_fname"];
            $lastName = $userRow["emp_lname"];
            $initials = $userRow["emp_initials"];
            $userArray = array("firstName"=>$firstName, "lastName"=>$lastName,
                "role_role_id"=>$roleId, "user_id"=>$userId, "initials"=>$initials);
            $_SESSION["user"] = $userArray; //add to session
            if ($userRow["login_pwChange"]==0){
                header("location:../view/changePw.php");
            }elseif (isset($_SESSION["user"]) && $_SESSION["user"]["role_role_id"]==4){ // cashier login
                header("location:../view/dashboard1.php?page=dashboardHome");
            }elseif (isset($_SESSION["user"])){
                header("location:../view/dashboard.php?page=dashboardHome"); // others login
            }
        }
        else{
            $msg = "The Credentials: username and the password does not match!";
            $msg = base64_encode($msg);
            header("location:../view/login.php?error=$msg;");
        }
    break;

    case "logout":
        session_destroy();
        header("location:../view/login.php");
    break;
}
