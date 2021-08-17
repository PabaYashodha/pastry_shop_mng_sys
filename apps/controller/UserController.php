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
                $temp_loc = $_FILES["image"]["tmp_name"]; //temporary location
                $new_loc = "../../images/user-images/$image"; //current location
                move_uploaded_file($temp_loc, $new_loc);
            } else {
                throw new Exception("images is required");
            }
            $userId = $userObj->newEmp();
            if ($userId != "") {
                $result = $userObj->addUser($userId, $firstName, $lastName,  $contact, $birthday, $gender, $nic, $email, $role,  $add1,  $add2,  $add3, $image);
                if ($result > 0) {
                    $result = $userObj->makeUserLogin($email, sha1($nic), $userId);
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

    // case 'viewUserDetails':
    //     $userId = base64_decode($_POST['userId']);
    //     $result = $userObj->viewUserDetails($userId);
    //     $row = $result->fetch_assoc();
        // echo json_encode($row);
        ?>
                <!-- <div class="row">                    
                    <div class="col-xs-4 col-sm-4 col-md-4 col-lg-4">
                        <img src="../../images/user-images/<?php echo $row['user_image']?>" alt="" width="350px" height="350px" class="m-auto">
                    </div>
                    <div class="col-xs-8 col-sm-8 col-md-8 col-lg-8">                       
                        <div class="row">
                            <label for="name" class="col-sm-12 col-form-label" style="padding-left: 8rem;"> <h2><?php echo $row['user_fname'].' '.$row['user_lname']?></h2></label>
                            <label for="createDate" class="col-sm-4 col-form-label text-end">Create Date  </label>
                            <label for="createDate" class="col-sm-8 col-form-label text-start mb-2"> : <?php echo $row['user_create_date']?> </label>
                            <label for="contact" class="col-sm-4 col-form-label text-end">Contact  </label>
                            <label for="contact" class="col-sm-8 col-form-label text-start mb-2"> : <?php echo $row['user_contact']?> </label>
                            <label for="email" class="col-sm-4 col-form-label text-end"> Email </label>
                            <label for="email" class="col-sm-8 col-form-label text-start mb-2"> : <?php echo $row['user_email']?> </label>
                            <label for="address" class="col-sm-4 col-form-label text-end"> Address </label>
                            <label for="address" class="col-sm-8 col-form-label text-start mb-2"> : <?php echo $row['user_add1'].', '.$row['user_add2'].', '.$row['user_add3']?> </label>
                            <label for="gender" class="col-sm-4 col-form-label text-end"> Gender </label>
                            <label for="gender" class="col-sm-8 col-form-label text-start mb-2"> : <?php echo ($row['user_gender']==1)? 'Male' : 'Female' ?></label>
                            <label for="birthday" class="col-sm-4 col-form-label text-end"> Birthday </label>
                            <label for="birthday" class="col-sm-8 col-form-label text-start mb-2"> : <?php echo $row['user_dob']?></label>                            
                            <label for="nic" class="col-sm-4 col-form-label text-end"> NIC </label>
                            <label for="nic" class="col-sm-8 col-form-label text-start mb-2"> : <?php echo $row['user_nic']?></label>                                                       
                            <label for="status" class="col-sm-4 col-form-label text-end"> Status </label>
                            <label for="status" class="col-sm-8 col-form-label text-start mb-2"> : <?php echo ($row['user_status']==1)? '<span style="color:green">Active</span>' : '<span style="color:red">Deactivate</span>' ?></label>                                                       
                        </div>
                    </div>                    
                </div> -->

        <?php
        //break;

        case 'viewUserDetails':
            $userId = base64_decode($_POST['userId']);
            $result = $userObj->viewUserDetails($userId);
            $row = $result->fetch_assoc();
            echo json_encode($row);           
            break;

        case 'editUser':
            try {
                $userId = base64_decode($_POST['editUserId']);
                $firstName = $_POST['editFirstName'];
                $lastName = $_POST['editLastName'];
                $contact = $_POST['editContact'];
                $birthday = $_POST['editBirthday'];
                $gender = $_POST['editGender'];
                $nic = $_POST['editNic'];
                $email = $_POST['editEmail'];
                $role = $_POST['editRole'];
                $add1 = $_POST['editAdd1'];
                $add2 = $_POST['editAdd2'];
                $add3 = $_POST['editAdd3'];

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
                if ($_FILES["editImage"]["name"] != "") {
                    $image = $_FILES["editImage"]["name"];
                    $imageExt = substr($image, strrpos($image, '.')); //split image name using dot
                    $image = time() . $imageExt; //change image name with current time
                    $temp_loc = $_FILES["editImage"]["tmp_name"]; //temporary location
                    $new_loc = "../../images/user-images/$image"; //current location
                    move_uploaded_file($temp_loc, $new_loc);
                } else {
                    $image = 1;
                }
                $result = $userObj->editUser($userId, $firstName, $lastName,  $contact, $birthday, $gender, $nic, $email, $role,  $add1,  $add2,  $add3, $image);
                if ($result == 1) {
                    $res = 1;
                    $getUserTbl = $userObj->getUserData();
                    $userArray = array();
                    while ($row = $getUserTbl->fetch_assoc()) {
                        array_push($userArray, $row);
                    }
                    $msg = $userArray;
                }
            } catch (Throwable $th) {
                $res = 2;
                $msg = $th->getMessage();
            }
            $data[0] = $res;
            $data[1] = $msg;
            echo json_encode($data);
            break;

        case 'changeUserStatus':
            $userId = base64_decode($_POST['userId']);
            $userStatus = $_POST['userStatus'];
            $result = $userObj->changeUserStatus($userId, $userStatus);
            if ($result == 1) {
                $res = 1;
                $getUserTbl = $userObj->getUserData();
                $userArray = array();
                while ($row = $getUserTbl->fetch_assoc()) {
                    array_push($userArray, $row);
                }
                $msg = $userArray;
            }else{
                $res = 2;
                $msg ="Oops! user can't deactivate";
            }
            $data[0] = $res;
            $data[1] = $msg;
            echo json_encode($data);
            break;   
    
}