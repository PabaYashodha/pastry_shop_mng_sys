<?php
require_once "header.php";
require_once "sidebar.php";
?>
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

    .form-control-plaintext:focus {
        /* border: 0px solid #ffffff !important; */
        outline: none;
    }
</style>
<div id="content" class="content-expanded">
    <div class="card shadow-lg " style="border-radius: 10px; padding:0.4rem">
        <nav aria-label="breadcrumb" class="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="../view/dashboard.php" style="text-decoration: none; color:#2f2e41 !important"> HOME</a></li>
                <li class="breadcrumb-item active" aria-current="page">ADMIN PASSWORD RESET</li>
            </ol>
        </nav>
    </div>
    <div class="card shadow-lg mx-auto mt-3" style="width: 30rem;">
        <div class="card-header" style="background-color: #2f2e41;">
            <h3 class="text-light"><i class="fas fa-lock-alt"></i> Password Reset</h3>
        </div>
        <div class="card-body">
        <form action="" method="post" role="form" id="adminPasswordResetForm">
            <div class="mb-3">
                <label for="userName" class="form-label">User Name</label>
                <input type="hidden" class="form-control" id="userResetId" name="userResetId">
                <!-- <input type="hidden" class="form-control" id="userResetNic" name="userResetNic"> -->
                <input type="text" class="form-control" id="userResetName" name="userResetName">
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="float-end d-inline-flex">
                    <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Reset</button>
                    &nbsp;&nbsp;&nbsp;&nbsp;
                    <button type="button" id="adminResetPassword" class="btn btn-primary">Submit</button>
                </div>
            </div>
        </form>
        </div>
    </div>
</div>

<?php require_once "scriptInclude.php" ?>
<!-- <script>
    $(window).load(getRowItemData(), getGrnNumber(), );
</script> -->
<?php require_once "footer.php" ?>