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
                <li class="breadcrumb-item active" aria-current="page">BACKUP</li>
            </ol>
        </nav>
    </div>
    <div class="card shadow-lg mt-3" style="border-radius: 20px;">
        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12" style="padding-top: 20px; padding-right: 20px;">
            <div class="float-end d-inline-flex">
                <button type="button" id="make_backup" class="btn text-light" style="background-color: #2f2e41;">Make BackUp</button>
                &nbsp;&nbsp;&nbsp;&nbsp;
                <!-- <button type="button" id="uploadBackup" class="btn text-light" style="background-color: #2f2e41;">Upload Backup</button> -->
                <a href="../view/uploadBackup.php" class="btn btn-dark float-end" role="button" style="background-color: #2f2e41;">Upload Backup</a>
            </div>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                    <table class="table  table-hover table-responsive-*" id="dataTable">
                        <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Backup Date</th>
                                <th scope="col">Backup Name</th>
                                <th scope="col">Options</th>
                            </tr>
                        </thead>
                        <tbody id="backupTable"></tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
</div>
<?php require_once "scriptInclude.php" ?>
<script>
    window.load(getBackupData());
</script>
<?php require_once "footer.php" ?>