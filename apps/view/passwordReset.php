<?php
// require_once "header.php";
// require_once "sidebar.php";
// 
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <link rel="stylesheet" type="text/css" href="../../resources/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="../../resources/toastr/build/toastr.min.css">
    <link rel="stylesheet" type="text/css" href="../../resources/fontawesome/css/all.min.css" />
    <link rel="stylesheet" type="text/css" href="../../resources/DataTables/datatables.min.css" />
    <link rel="stylesheet" type="text/css" href="../../css/style.css" />
</head>
<style>
    input::-webkit-outer-spin-button,
    input::-webkit-inner-spin-button {
        -webkit-appearance: none;
        margin: 0;
    }

    /* Firefox */
    input[type=number] {
        -moz-appearance: textfield;
    }
</style>

<div class="card mx-auto mt-5" style="width: 30rem;">
    <div class="card-header" style="background-color: #2f2e41;">
        <h3 class="text-light"><i class="fas fa-lock-alt"></i> Password Reset</h3>
    </div>
    <div class="card-body">
        <form action="" method="post" role="form" id="passwordResetForm">
            <div class="mb-3">
                <label for="currentPassword" class="form-label">Current Password</label>
                <input type="password" class="form-control" id="currentPassword" name="currentPassword">
            </div>
            <div class="mb-3">
                <label for="newPassword" class="form-label">New Password</label>
                <div class="input-group mb-3">
                    <input type="password" class="form-control" id="newPassword" name="newPassword">
                    <button class="btn btn-outline-secondary" type="button" id="button-addon2"><i class="fas fa-eye"></i></button>
                </div>
            </div>
            <div class="mb-3">
                <label for="confirmPassword" class="form-label">Confirm Password</label>
                <input type="password" class="form-control" id="confirmPassword" name="confirmPassword">
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="float-end d-inline-flex">
                    <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Reset</button>
                    &nbsp;&nbsp;&nbsp;&nbsp;
                    <button type="button" id="resetPassword" class="btn btn-primary">Submit</button>
                </div>
            </div>
        </form>
    </div>
</div>

<?php require_once "scriptInclude.php" ?>
<?php require_once "footer.php" ?>