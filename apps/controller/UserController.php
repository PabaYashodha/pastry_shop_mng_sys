<?php
include_once '../model/User.php'; //include the user.php  
$userObj = new User(); //create user object
$status = $_REQUEST['status']; //request status 

switch ($status) {
    case 'checkContactIsExist':
        $contact = $_POST['contact'];
        $result = $userObj->checkContactIsExist($contact);
        echo ($result == false) ? 1 : '';
        break;

    case 'checkEmailIsExist':
        $email = $_POST['email'];
        $result = $userObj->checkEmailIsExist($email);
        echo ($result == false) ? 1 : '';
        break;

    case 'checkNicIsExist':
        $nic = $_POST['nic'];
        $result = $userObj->checkNicIsExist($nic);
        echo ($result == false) ? 1 : '';
        break;

    case 'addUser':
        try {
            $firstName = $_POST['firstName'];
            $lastName = $_POST['lastName'];
            $contact = $_POST['contact'];
            $birthday = $_POST['birthday'];
            $gender = $_POST['gender'];
            $nic = $_POST['nic'];
            $email = $_POST['email'];
            $role = $_POST['role'];
            $add1 = $_POST['add1'];
            $add2 = $_POST['add2'];
            $add3 = $_POST['add3'];

            if ($firstName == "") {
                throw new Exception("First name is required");
            }
            if ($lastName == "") {
                throw new Exception("Last name is required");
            }
            if ($contact == "") {
                throw new Exception("Contact is required");
            }
            if ($birthday == "") {
                throw new Exception("Birthday is required");
            }
            if ($gender == "") {
                throw new Exception("Gender is required");
            }
            if ($nic == "") {
                throw new Exception("NIC is required");
            }
            if ($email == "") {
                throw new Exception("Email is required");
            }
            if ($role == "") {
                throw new Exception("Role is required");
            }
            if ($add1 == "") {
                throw new Exception("Address no is required");
            }
            if ($add2 == "") {
                throw new Exception("Lane is required");
            }
            if ($add3 == "") {
                throw new Exception("Street is required");
            }
            if ($_FILES["image"]["name"] != "") {
                $image = $_FILES["image"]["name"];
                $imageExt = substr($image, strrpos($image, '.')); //split image name using dot
                $image = time() . $imageExt; //change image name with current time
                $temp_loc = $_FILES["image"]["tmp_name"]; //tempory location
                $new_loc = "../../images/user-images/$image"; //current location
                move_uploaded_file($temp_loc, $new_loc);
            } else {
                throw new Exception("images is required");
            }
            $userId = $userObj->newEmp();
            if ($userId != "") {
                $result = $userObj->addUser($userId, $firstName, $lastName,  $contact, $birthday, $gender, $nic, $email, $role,  $add1,  $add2,  $add3, $image);
                if ($result > 0) {
                    $res = 1;
                    $msg = '';
                } else {
                    throw new Exception("oops! can't add user please contact admin");
                }
            } else {
                throw new Exception("oops! can't defined userId");
            }
        } catch (Throwable $th) {
            $res = 2;
            $msg = $th->getMessage();
        }
        $data[0] = $res;
        $data[1] = $msg;
        echo json_encode($data); //return result with json array
        break;

    case 'getUserData':
        $result = $userObj->getUserData();
        $userArray = array();
        while ($row = $result->fetch_assoc()) {
            array_push($userArray, $row);
        }
        echo json_encode($userArray);
        break;
}