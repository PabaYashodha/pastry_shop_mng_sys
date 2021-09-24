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
    <div class="card" style="border-radius: 20px;">
        <div class="card-body">
            <div class="row mb-3">
                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                    <button class="btn btn-dark float-end" data-bs-toggle="modal" data-bs-target="#addDiningTable"><i class="far fa-plus"></i> ADD DINING TABLE</button>
                </div>
            </div>

            <div class="row">
                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                    <table class="table  table-hover table-responsive-*" id="dataTable">
                        <thead class="table-primary">
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Table Name</th>
                                <th scope="col">Table Capacity</th>
                                <th scope="col">Status</th>
                                <th scope="col">Option</th>
                            </tr>
                        </thead>
                        <tbody id="diningTable"></tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- modal start -->
<!-- add dining table -->
<div class="modal fade" tabindex="-1" aria-labelledby="addDiningTable" id="addDiningTable" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-md">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Add DiningTable</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="" method="post" role="form" id="diningTableForm">
                    <div class="row">
                        <div class="col-xs-12 col-sm-12 col-md-12">
                            <div class="row mb-3">
                                <label for="tableName" class="col-sm-3 col-form-label">Table Name</label>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control" id="tableName" name="tableName">
                                </div>
                            </div>
                        </div>
                        <div class="col-xs-12 col-sm-12 col-md-12">
                            <div class="row mb-3">
                                <label for="tableCapacity" class="col-sm-3 col-form-label">Table Capacity</label>
                                <div class="col-sm-9">
                                    <input type="number" class="form-control" id="tableCapacity" name="tableCapacity">
                                </div>
                            </div>
                        </div>
                        <div class="col-xs-12 col-sm-12 col-md-12">
                            <div class="float-end d-inline-flex">
                                <button type="reset" class="btn btn-danger">Reset</button>
                                &nbsp;&nbsp;&nbsp;&nbsp;
                                <button type="button" id="tableFormSubmit" class="btn btn-primary">Submit</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer"></div>
        </div>
    </div>
</div>
<!-- modal end -->

<!-- modal start -->
<!-- view dining table -->
<div class="modal fade" tabindex="-1" aria-labelledby="viewDiningTable" id="viewDiningTable" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-md">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">VIEW DINING TABLE</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div id="viewDiningTableContent"></div>
            </div>
            <div class="modal-footer"></div>
        </div>
    </div>
</div>
<!-- modal end -->

<!-- modal start -->
<!-- edit dining table -->
<div class="modal fade" tabindex="-1" aria-labelledby="editDiningTable" id="editDiningTable" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-md">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">EDIT DINING TABLE</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
            <form action="" method="post" role="form" id="editDiningTableForm">
                    <div class="row">
                        <div class="col-xs-12 col-sm-12 col-md-12">
                            <div class="row mb-3">
                                <label for="editTableName" class="col-sm-3 col-form-label">Table Name</label>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control" id="editTableName" name="editTableName">
                                </div>
                            </div>
                        </div>
                        <div class="col-xs-12 col-sm-12 col-md-12">
                            <div class="row mb-3">
                                <label for="editTableCapacity" class="col-sm-3 col-form-label">Table Capacity</label>
                                <div class="col-sm-9">
                                    <input type="number" class="form-control" id="editTableCapacity" name="editTableCapacity">
                                </div>
                            </div>
                        </div>
                        <div class="col-xs-12 col-sm-12 col-md-12">
                            <div class="float-end d-inline-flex">
                                <button type="reset" class="btn btn-danger">Reset</button>
                                &nbsp;&nbsp;&nbsp;&nbsp;
                                <button type="button" id="editTableFormSubmit" class="btn btn-primary">Submit</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer"></div>
        </div>
    </div>
</div>
<!-- modal end -->
<?php require_once "scriptInclude.php" ?>
<script>
    $(window).load(getDiningTableData());
</script>
<?php require_once "footer.php"; ?>