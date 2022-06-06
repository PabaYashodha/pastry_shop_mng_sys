<?php
require_once "header.php";
require_once "sidebar.php";
if (isset($_SESSION['user'])) {
?>
    <div id="content" class="content-expanded">
        <div class="card shadow-lg " style="border-radius: 10px; padding:0.4rem">
            <nav aria-label="breadcrumb" class="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="../view/dashboard.php" style="text-decoration: none; color:#2f2e41 !important"> HOME</a></li>
                    <li class="breadcrumb-item active" aria-current="page">VIEW MY PROFILE</li>
                </ol>
            </nav>
        </div>

        <div class="card shadow-lg mt-3" style="border-radius: 20px;">
            <div class="card-body">
                <div id="viewLoggedUserContent"></div>
            </div>
        </div>
    </div>
    <!-- modal start -->

    <div class="modal fade" tabindex="-1" data-bs-backdrop="static" data-bs-keyboard="false" aria-labelledby="editMyProfile" id="editMyProfile" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-xl">
            <div class="modal-content">
                <div class="modal-header" style="background-color: #2f2e41;">
                    <h5 class="modal-title text-light">EDIT PROFILE</h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="" method="post" role="form" id="myProfileForm">
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-6">
                                <div class="row mb-3">
                                    <label for="userFirstName" class="col-sm-3 col-form-label">First Name</label>
                                    <div class="col-sm-9">
                                        <input type="text" class="form-control" id="userFirstName" name="userFirstName">
                                    </div>
                                </div>
                            </div>
                            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-6">
                                <div class="row mb-3">
                                    <label for="userLastName" class="col-sm-3 col-form-label"> Last Name </label>
                                    <div class="col-sm-9">
                                        <input type="text" class="form-control" id="userLastName" name="userLastName">
                                    </div>
                                </div>
                            </div>
                            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-6">
                                <div class="row mb-3">
                                    <label for="userContact" class="col-sm-3 col-form-label"> Contact </label>
                                    <div class="col-sm-9">
                                        <input type="text" class="form-control" id="userContact" name="userContact">
                                    </div>
                                </div>
                            </div>
                            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-6">
                                <div class="row mb-3">
                                    <label for="userBirthday" class="col-sm-3 col-form-label"> Birthday </label>
                                    <div class="col-sm-9">
                                        <input type="date" class="form-control" id="userBirthday" name="userBirthday">
                                    </div>
                                </div>
                            </div>
                            <!-- <div class="col-xs-12 col-sm-12 col-md-12 col-lg-6">
                                <div class="row mb-3">
                                    <label for="Gender" class="col-sm-3 col-form-label"> Gender </label>
                                    <div class="col-sm-9">
                                        <label class="form-check-label" for="Male"> Male </label>
                                        <input type="radio" class="form-check-input" name="gender" id="userMale" value="1">
                                        &nbsp; &nbsp;
                                        <label class="form-check-label" for="Female"> Female </label>
                                        <input type="radio" class="form-check-input" name="gender" id="userFemale" value="0">
                                    </div>
                                </div>
                            </div> -->
                            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-6">
                                <div class="row mb-3">
                                    <label for="userNic" class="col-sm-3 col-form-label"> NIC </label>
                                    <div class="col-sm-9">
                                        <input type="text" class="form-control" id="userNic" name="userNic">
                                    </div>
                                </div>
                            </div>
                            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-6">
                                <div class="row mb-3">
                                    <label for="userEmail" class="col-sm-3 col-form-label"> Email </label>
                                    <div class="col-sm-9">
                                        <input type="text" class="form-control" id="userEmail" name="userEmail">
                                    </div>
                                </div>
                            </div>
                            <!-- <div class="col-xs-12 col-sm-12 col-md-12 col-lg-6">
                                <div class="row mb-3">
                                    <label for="role" class="col-sm-3 col-form-label">Role</label>
                                    <div class="col-sm-9">
                                        <select class="form-select" aria-label="Default select example" id="userRole" name="userRole">
                                            <option selected value="">-- Select role --</option>
                                            <option value="1">Administrator</option>
                                            <option value="2">Owner</option>
                                            <option value="3">Waiter</option>
                                            <option value="4">Cashier</option>
                                            <option value="5">Delivery</option>
                                        </select>
                                    </div>
                                </div>
                            </div> -->
                            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-3">
                                <div class="row mb-3">
                                    <label for="address" class="col-sm-6 col-form-label">Address</label>
                                    <div class="col-sm-6">
                                        <input class="form-control" type="text" id="userAdd1" name="userAdd1">
                                    </div>

                                </div>
                            </div>
                            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-9">
                                <div class="row mb-3">
                                    <div class="col-sm-6">
                                        <input class="form-control" type="text" id="userAdd2" name="userAdd2">
                                    </div>
                                    <div class="col-sm-6">
                                        <input class="form-control" type="text" id="userAdd3" name="userAdd3">
                                    </div>
                                </div>
                            </div>
                            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-6">
                                <div class="row mb-3">
                                    <label for="image" class="col-sm-3 col-form-label">Image</label>
                                    <div class="col-sm-9">
                                        <input class="form-control" type="file" id="userImage" name="userImage" accept="image/png, image/jpg, image/jpeg" onchange="preview(this)">
                                    </div>
                                </div>
                            </div>
                            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-6">
                                <div class="row mb-3">
                                    <img id="user_pre_image">
                                </div>
                            </div>
                            <div class="row mb-3">
                                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                                    <div class="float-end d-inline-flex">
                                        <button type="reset" class="btn btn-danger">Reset</button>
                                        &nbsp;&nbsp;&nbsp;&nbsp;
                                        <button type="button" id="userLoggedFormSubmit" class="btn btn-primary">Submit</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
<?php
}
require_once "scriptInclude.php" ?>
<script>
    window.load(viewLoggedUser(),editLoggedUserDetails());
</script>
<?php require_once "footer.php"; ?>