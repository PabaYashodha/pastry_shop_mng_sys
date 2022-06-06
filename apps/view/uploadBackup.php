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
</style>
<div id="content" class="content-expanded">
    <div class="card shadow-lg " style="border-radius: 10px; padding:0.4rem">
        <nav aria-label="breadcrumb" class="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="../view/dashboard.php" style="text-decoration: none; color:#2f2e41 !important"> HOME</a></li>
                <li class="breadcrumb-item"><a href="../view/backup.php" style="text-decoration: none; color:#2f2e41 !important"> BACKUP</a></li>
                <li class="breadcrumb-item active" aria-current="page">UPLOAD BACKUP</li>
            </ol>
        </nav>
    </div>
    <div class="card shadow-lg mt-3" style="border-radius: 20px;">
        <div class="card-body" style="height: 50vh;">
            <form action="" enctype="multipart/form-data" method="post" role="form" id="uploadBackupForm">
                <div class="row mt-5">
                    <!-- <label for="uploadFile" class="col-sm-3 col-form-label">File</label> -->
                    <div class="col-2">&nbsp;</div>
                    <div class="col-sm-8">
                        <input class="form-control" type="file" id="uploadFile" name="uploadFile" accept="">
                    </div>
                    <div class="col-1">
                        <button type="button" id="uploadBackupSubmit" class="btn btn-primary">Upload</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

<?php require_once "scriptInclude.php" ?>
<?php require_once "footer.php" ?>