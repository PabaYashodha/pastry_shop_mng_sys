<?php
require_once "header.php";
require_once "sidebar.php";
?>

<div id="content" class="content-expanded">
    <div class="card shadow-lg " style="border-radius: 10px; padding:0.4rem">
            <nav aria-label="breadcrumb" class="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="../view/dashboard.php" style="text-decoration: none;"> HOME</a></li>
                    <li class="breadcrumb-item active" aria-current="page">USER</li>
                </ol>
            </nav>
    </div>

    <div class="card shadow-lg mt-3" style="border-radius: 20px;">
        <div class="card-body">
            <div class="row mb-3">
                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                    <button class="btn btn-dark float-end" data-bs-toggle="modal" data-bs-target="#addUser"><i class="far fa-plus"></i> ADD USER</button>
                </div>
            </div>
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
                <tbody id="userTable"></tbody>
            </table>
        </div>
    </div>
</div>
<!-- modal start -->
<!-- add user -->
<div class="modal fade" tabindex="-1" aria-labelledby="addUser" id="addUser" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Add User</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="" method="post" role="form" id="userForm">
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
                                <label for="Gender" class="col-sm-3 col-form-label"> Gender </label>
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
                                <label for="nic" class="col-sm-3 col-form-label"> NIC </label>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control" id="nic" name="nic">
                                </div>
                            </div>
                        </div>
                        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-6">
                            <div class="row mb-3">
                                <label for="email" class="col-sm-3 col-form-label"> Email </label>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control" id="email" name="email">
                                </div>
                            </div>
                        </div>
                        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-6">
                            <div class="row mb-3">
                                <label for="role" class="col-sm-3 col-form-label">Role</label>
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
                                <label for="address" class="col-sm-6 col-form-label">Address</label>
                                <div class="col-sm-6">
                                    <input class="form-control" type="text" id="add1" name="add1">
                                </div>

                            </div>
                        </div>
                        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-9">
                            <div class="row mb-3">
                                <div class="col-sm-6">
                                    <input class="form-control" type="text" id="add2" name="add2">
                                </div>
                                <div class="col-sm-6">
                                    <input class="form-control" type="text" id="add3" name="add3">
                                </div>
                            </div>
                        </div>
                        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-6">
                            <div class="row mb-3">
                                <label for="image" class="col-sm-3 col-form-label">Image</label>
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
                </form>
            </div>
        </div>
    </div>
</div>

<!-- modal end -->

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

<!-- modal start -->
<!-- edit user -->
<div class="modal fade" tabindex="-1" data-bs-backdrop="static" data-bs-keyboard="false" aria-labelledby="editUser" id="editUser" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">EDIT USER</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="" method="post" role="form" id="editUserForm">
                <div class="modal-body">
                    <!-- <div id="editUserContent"></div> -->
                    <div class="row">
                        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-6">
                            <div class="row mb-3">
                                <label for="editFirstName" class="col-sm-3 col-form-label">First Name</label>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control" id="editFirstName" name="editFirstName">
                                </div>
                            </div>
                        </div>
                        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-6">
                            <div class="row mb-3">
                                <label for="editLastName" class="col-sm-3 col-form-label"> Last Name </label>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control" id="editLastName" name="editLastName">
                                </div>
                            </div>
                        </div>
                        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-6">
                            <div class="row mb-3">
                                <label for="editContact" class="col-sm-3 col-form-label"> Contact </label>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control" id="editContact" name="editContact">
                                </div>
                            </div>
                        </div>
                        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-6">
                            <div class="row mb-3">
                                <label for="editBirthday" class="col-sm-3 col-form-label"> Birthday </label>
                                <div class="col-sm-9">
                                    <input type="date" class="form-control" id="editBirthday" name="editBirthday">
                                </div>
                            </div>
                        </div>
                        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-6">
                            <div class="row mb-3">
                                <label for="editGender" class="col-sm-3 col-form-label"> Gender </label>
                                <div class="col-sm-9">
                                    <label class="form-check-label" for="Male"> Male </label>
                                    <input type="radio" class="form-check-input" name="editGender" id="Male" value="1" checked>
                                    &nbsp; &nbsp;
                                    <label class="form-check-label" for="Female"> Female </label>
                                    <input type="radio" class="form-check-input" name="editGender" id="Female" value="0">
                                </div>
                            </div>
                        </div>
                        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-6">
                            <div class="row mb-3">
                                <label for="editNic" class="col-sm-3 col-form-label"> NIC </label>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control" id="editNic" name="editNic">
                                </div>
                            </div>
                        </div>
                        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-6">
                            <div class="row mb-3">
                                <label for="editEmail" class="col-sm-3 col-form-label"> Email </label>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control" id="editEmail" name="editEmail">
                                </div>
                            </div>
                        </div>
                        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-6">
                            <div class="row mb-3">
                                <label for="editRole" class="col-sm-3 col-form-label">Role</label>
                                <div class="col-sm-9">
                                    <select class="form-select" aria-label="Default select example" id="editRole" name="editRole">
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
                                <label for="editAddress" class="col-sm-6 col-form-label">Address</label>
                                <div class="col-sm-6">
                                    <input class="form-control" type="text" id="editAdd1" name="editAdd1">
                                </div>
                            </div>
                        </div>
                        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-9">
                            <div class="row mb-3">
                                <div class="col-sm-6">
                                    <input class="form-control" type="text" id="editAdd2" name="editAdd2">
                                </div>
                                <div class="col-sm-6">
                                    <input class="form-control" type="text" id="editAdd3" name="editAdd3">
                                </div>
                            </div>
                        </div>
                        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-6">
                            <div class="row mb-3">
                                <label for="editImage" class="col-sm-3 col-form-label">Image</label>
                                <div class="col-sm-9">
                                    <input class="form-control" type="file" id="editImage" name="editImage" onchange="preview(this)">
                                </div>
                            </div>
                        </div>
                        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-6">
                            <div class="row mb-3">
                                <img id="pre_image">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="reset" class="btn btn-danger">Reset</button>
                    <input type="hidden" id="editUserId" name="editUserId">
                    <button type="button" id="saveEditForm" class="btn btn-primary">Submit</button>
                </div>
            </form>
        </div>
    </div>
</div>
<!-- modal end -->
<?php require_once "scriptInclude.php" ?>
<script>
    // console.log(new FormData($('#userForm')[0]))
    // $(document).ready( getUserData() );
    $(window).load(getUserData());
</script>
<?php require_once "footer.php"; ?>