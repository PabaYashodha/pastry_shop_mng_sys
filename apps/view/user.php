<?php
include_once'../model/User.php';
$userObj = new User();
$getAllUser = $userObj->getUserData();
print_r($getAllUser);
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add user</title>
    <link rel="stylesheet" type="text/css" href="../../resources/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="../../resources/toastr/build/toastr.min.css">
    <link rel="stylesheet" type="text/css" href="../../resources/DataTables/datatables.min.css" />
    <link rel="stylesheet" type="text/css" href="../../resources/fontawesome/css/all.min.css" />
    <link rel="stylesheet" type="text/css" href="../../css/style.css" />


</head>

<body>
    <div class="container">
        <div class="card shadow-lg mt-5" style="border-radius: 20px;">
            <div class="card-body">
                <table class="table  table-hover table-responsive-*" id="dataTable">
                    <thead class="table-primary">
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Image</th>
                            <th scope="col">Name</th>
                            <th scope="col">Email</th>
                            <th scope="col">Contact</th>
                            <th scope="col">Status</th>
                            <th scope="col">Option</th>
                        </tr>
                    </thead>
                    <tbody id="userTable">
                    <?php ?>
                    <tr>
                        <th scope="row">result[index].user_id</th>            
                        <td><img src="../../images/user-images/result[index].user_image" width="40" height="40"></td>
                        <td>result[index].user_fname result[index].user_lname</td>
                        <td>result[index].user_email</td>
                        <td>result[index].user_contact</td><td>;           
                        if((result[index].user_status)==1){
                            row =<button class="btn btn-outline-success rounded shadow" onclick="deactivateUser((result[index].user_id))">Active</button>;
                        }else{
                            row =<button class="btn btn-outline-danger rounded shadow" onclick="activateUser((result[index].user_id))">Deactivate</button>;
                        }
                        </td>
                        <td>
                        <div class="d-inline-flex justify-content-start">
                        <button class="btn  btn-info" data-bs-toggle="modal" data-bs-target="#viewUser" onclick="viewUserDetails((result[index].user_id))"><i class="fal fa-eye"></i></button>&nbsp;&nbsp;&nbsp;
                        <button class="btn  btn-warning "><i class="fad fa-edit"></i></button>&nbsp;&nbsp;&nbsp;
                        <button class="btn  btn-danger "><i class="fal fa-trash-alt"></i></button></div></td>&nbsp;&nbsp;&nbsp;
                    </tr>
                    </tbody>
                </table>
                <!-- <form action="" method="post" role="form" id="userForm">
                    <div class="row">
                        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-6">
                            <div class="row mb-3">
                                <label for="firstName" class="col-sm-3 col-form-label">First Name</label>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control" id="firstName" name="firstName">
                                </div>
                            </div>
                        </div>
                        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-6">
                            <div class="row mb-3">
                                <label for="lastName" class="col-sm-3 col-form-label"> Last Name </label>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control" id="lastName" name="lastName">
                                </div>
                            </div>
                        </div>
                        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-6">
                            <div class="row mb-3">
                                <label for="contact" class="col-sm-3 col-form-label"> Contact </label>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control" id="contact" name="contact">
                                </div>
                            </div>
                        </div>
                        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-6">
                            <div class="row mb-3">
                                <label for="birthday" class="col-sm-3 col-form-label"> Birthday </label>
                                <div class="col-sm-9">
                                    <input type="date" class="form-control" id="birthday" name="birthday">
                                </div>
                            </div>
                        </div>
                        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-6">
                            <div class="row mb-3">
                                <label for="Gender" class="col-sm-3 col-form-label" > Gender </label>
                                <div class="col-sm-9">
                                    <label class="form-check-label" for="Male"> Male </label>
                                    <input type="radio" class="form-check-input" name="gender" id="Male" value="1" checked>
                                    &nbsp; &nbsp;
                                    <label class="form-check-label" for="Female"> Female </label>
                                    <input type="radio" class="form-check-input" name="gender" id="Female" value="0">
                                </div>
                            </div>
                        </div>
                        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-6">
                            <div class="row mb-3">
                                <label for="birthday" class="col-sm-3 col-form-label"> NIC </label>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control" id="nic" name="nic">
                                </div>
                            </div>
                        </div>                        
                        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-6">
                            <div class="row mb-3">
                                <label for="birthday" class="col-sm-3 col-form-label"> Email </label>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control" id="email" name="email">
                                </div>
                            </div>
                        </div>
                        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-6">
                            <div class="row mb-3">
                                <label for="formFile" class="col-sm-3 col-form-label">Role</label>
                                <div class="col-sm-9">
                                    <select class="form-select" aria-label="Default select example" id="role" name="role">
                                        <option selected value="">-- Select role --</option>
                                        <option value="1">Administrator</option>
                                        <option value="2">Owner</option>
                                        <option value="3">Waiter</option>
                                        <option value="4">Cashier</option>
                                        <option value="5">Delivery</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-3">
                            <div class="row mb-3">
                                <label for="formFile" class="col-sm-6 col-form-label">Address</label>
                                <div class="col-sm-6">
                                    <input class="form-control" type="text" id="add1" name="add1">
                                </div>

                            </div>
                        </div>
                        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-9">
                            <div class="row mb-3">
                                <div class="col-sm-6">
                                    <input class="form-control" type="text"  id="add2" name="add2">
                                </div>
                                <div class="col-sm-6">
                                    <input class="form-control" type="text"  id="add3" name="add3">
                                </div>
                            </div>
                        </div>
                        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-6">
                            <div class="row mb-3">
                                <label for="formFile" class="col-sm-3 col-form-label">Image</label>
                                <div class="col-sm-9">
                                    <input class="form-control" type="file" id="image" name="image" onchange="preview(this)">
                                </div>
                            </div>
                        </div>
                        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-6">
                            <div class="row mb-3">
                                <img id="pre_image">
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                                <div class="float-end d-inline-flex">
                                    <button type="reset" class="btn btn-danger">Reset</button>
                                    &nbsp;&nbsp;&nbsp;&nbsp;
                                    <button type="button" id="userFormSubmit" class="btn btn-primary">Submit</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </form> -->
            </div>
        </div>
    </div>
    <!-- modal start -->
    <!-- view user -->
    <div class="modal fade" tabindex="-1" aria-labelledby="viewUser" id="viewUser" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-xl">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">VIEW USER</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div id="viewUserContent"></div>
                </div>
                <div class="modal-footer"></div>
            </div>
        </div>
    </div>
    <!-- modal end -->
    <script type="text/javascript" src="../../js/jquery-3.6.0.min.js"></script>
    <script type="text/javascript" src="../../resources/bootstrap/js/bootstrap.min.js"></script>
    <script type="text/javascript" src="../../js/validation.js"></script>
    <script type="text/javascript" src="../../resources/sweetalert.js"></script>
    <script type="text/javascript" src="../../resources/toastr/build/toastr.min.js"></script>
    <script type="text/javascript" src="../../js/script.js"></script>
    <script type="text/javascript" src="../../resources/DataTables/datatables.min.js"></script>
    <script type="text/javascript" src="../../resources/fontawesome/js/all.min.js"></script>
    <script>
        // console.log(new FormData($('#userForm')[0]))
    </script>
</body>

</html>