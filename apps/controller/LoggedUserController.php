<?php
session_start();
include_once '../model/LoggedUser.php';
$loggedUserObj = new LoggedUser();
$status= $_REQUEST['status'];

switch ($status) {
    case 'viewLoggedUserDetails':
       $loggedUserId = $_SESSION['user']['user_id'];
       $result = $loggedUserObj->viewLoggedUserDetails($loggedUserId);
       //print_r($result);
        $row = $result->fetch_assoc();
        echo json_encode($row);
        break;

    case 'editLoggedUser':
        try {
            $loggedUserId = $_SESSION['user']['user_id'];
            $userFirstName = $_POST['userFirstName'];
            $userLastName = $_POST['userLastName'];
            $userContact = $_POST['userContact'];
            $userBirthday = $_POST['userBirthday'];
            $userNic = $_POST['userNic'];
            $userEmail = $_POST['userEmail'];
            $userAdd1 = $_POST['userAdd1'];
            $userAdd2 = $_POST['userAdd2'];
            $userAdd3 = $_POST['userAdd3'];

            if ($userFirstName == "") {
                throw new Exception("First name is required");
            }
            if ($userLastName == "") {
                throw new Exception("First name is required");
            }
            if ($userContact == "") {
                throw new Exception("First name is required");
            }
            if ($userBirthday == "") {
                throw new Exception("First name is required");
            }
            if ($userNic == "") {
                throw new Exception("First name is required");
            }
            if ($userEmail == "") {
                throw new Exception("First name is required");
            }
            if ($userAdd1 == "") {
                throw new Exception("First name is required");
            }
            if ($userAdd2 == "") {
                throw new Exception("First name is required");
            }
            if ($userAdd3 == "") {
                throw new Exception("First name is required");
            }
            if ($_FILES["userImage"]["name"] != "") {
                $image = $_FILES["userImage"]["name"];
                $imageExt = substr($image, strrpos($image, '.')); //split image name using dot
                $image = time() . $imageExt; //change image name with current time
                $temp_loc = $_FILES["userImage"]["tmp_name"]; //temporary location
                $new_loc = "../../images/user-images/$image"; //current location
                move_uploaded_file($temp_loc, $new_loc);
            } else {
                $image = 1;
            }
            $result = $loggedUserObj->editLoggedUser($loggedUserId,$userFirstName,$userLastName,$userContact,$userBirthday,$userNic,$userEmail,$userAdd1,$userAdd2,$userAdd3,$image);
            if ($result==1) {
                $res = 1;
                $getLoggedUserTbl = $loggedUserObj->viewLoggedUserDetails($loggedUserId);
                $loggedUserArray = array();
                while ($row = $getLoggedUserTbl->fetch_assoc()) {
                    array_push($loggedUserArray,$row);
                }
                $msg = $loggedUserArray;
            }
        } catch (Throwable $th) {
            $res = 2;
            $msg = $th->getMessage();
        }
        $data[0] = $res;
        $data[1] = $msg;
        echo json_encode($data);
        break;    
    
}