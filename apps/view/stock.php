<?php
require_once '../view/header.php';
require_once '../view/sidebar.php';
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
                    <ul class="nav nav-pills mb-3" id="pills-tab" role="tablist">
                        <li class="nav-item" role="presentation">
                            <button class="nav-link active nav-link2" id="pills-home-tab" data-bs-toggle="pill" data-bs-target="#pills-home" type="button" role="tab" aria-controls="pills-home" aria-selected="true">Stock</button>
                        </li>
                        <li class="nav-item" role="presentation">
                            <button class="nav-link nav-link2" id="pills-profile-tab" data-bs-toggle="pill" data-bs-target="#pills-profile" type="button" role="tab" aria-controls="pills-profile" aria-selected="false">Row Items</button>
                        </li>
                        <li class="nav-item" role="presentation">
                            <button class="nav-link nav-link2" id="pills-contact-tab" data-bs-toggle="pill" data-bs-target="#pills-contact" type="button" role="tab" aria-controls="pills-contact" aria-selected="false">GRN</button>
                        </li>
                    </ul>
                    <!-- stock -->
                    <div class="tab-content" id="pills-tabContent">
                        <div class="tab-pane fade show active" id="pills-home" role="tabpanel" aria-labelledby="pills-home-tab">
                            <div class="row">
                                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 mb-3">
                                    <a href="../view/addStock.php" class="btn btn-dark float-end" role="button"><i class="far fa-plus"></i>ADD STOCK</a>
                                </div>
                                <div class="row">
                                    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                                        <table class="table  table-hover table-responsive-*" id="dataTable">
                                            <thead>
                                                <tr>
                                                    <th scope="col">#</th>
                                                    <th scope="col"></th>
                                                    <th scope="col"></th>
                                                    <th scope="col"></th>
                                                    <th scope="col"></th>
                                                    <th scope="col"></th>
                                                </tr>
                                            </thead>
                                            <tbody id="stockTable"></tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- row item -->
                        <div class="tab-pane fade" id="pills-profile" role="tabpanel" aria-labelledby="pills-profile-tab">
                            <div class="row">
                                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 mb-3">
                                    <button class="btn btn-dark float-end" data-bs-toggle="modal" data-bs-target="#addRowItems"><i class="far fa-plus"></i> ADD ROW ITEMS</button>
                                </div>
                                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                                    <table class="table  table-hover table-responsive-*" id="dataTable">
                                        <thead>
                                            <tr>
                                                <th scope="col">#</th>
                                                <th scope="col">Row Item Name</th>
                                                <th scope="col">Status</th>
                                                <th scope="col">Options</th>
                                            </tr>
                                        </thead>
                                        <tbody id="rowItemTable"></tbody>
                                    </table>
                                </div>
                            </div>
                        </div>

                        <div class="tab-pane fade" id="pills-contact" role="tabpanel" aria-labelledby="pills-contact-tab">
                            <div class="row">
                                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 mb-3">
                                    <button class="btn btn-dark float-end" data-bs-toggle="modal" data-bs-target="#addGrn"><i class="far fa-plus"></i> ADD GRN</button>
                                </div>
                                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                                    <table class="table  table-hover table-responsive-*" id="dataTable">
                                        <thead>
                                            <tr>
                                                <th scope="col">#</th>
                                                <th scope="col">Grn Reference No</th>
                                                <th scope="col">Grn Date</th>
                                                <th scope="col">Grn Price</th>
                                                <th scope="col">Supplier Contact Name</th>
                                                <th scope="col">Status</th>
                                                <th scope="col">Options</th>
                                            </tr>
                                        </thead>
                                        <tbody id="grnTable"></tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- row item -->
<!-- modal start -->
<!-- add row items -->
<div class="modal fade" tabindex="-1" aria-labelledby="addRowItems" id="addRowItems" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-md">
        <div class="modal-content">
            <div class="modal-header text-light" style="background-color:#2f2e41;">
                <h5 class="modal-title"><i class="fad fa-box-full fa-2x" style="margin-right: 10px;"></i>Add Row Items</h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="" method="post" role="form" id="rowItemForm">
                    <div class="row">
                        <div class="col-xs-12 col-sm-12 col-md-12">
                            <div class="row mb-3">
                                <label for="rowItemName" class="col-sm-3 col-form-label">Item Name</label>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control" id="rowItemName" name="rowItemName">
                                </div>
                            </div>
                        </div>
                        <div class="col-xs-12 col-sm-12 col-md-12">
                            <div class="float-end d-inline-flex">
                                <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Reset</button>
                                &nbsp;&nbsp;&nbsp;&nbsp;
                                <button type="button" id="rowItemFormSubmit" class="btn btn-primary">Submit</button>
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
<!-- edit row item -->
<div class="modal fade" tabindex="-1" aria-labelledby="editRowItem" id="editRowItem" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-md">
        <div class="modal-content">
            <div class="modal-header text-light" style="background-color:#2f2e41;">
                <h5 class="modal-title"><i class="fad fa-burger-soda fa-2x" style="margin-right: 10px;"></i>Edit Row Item</h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="" method="post" role="form" id="editRowItemForm">
                    <div class="row">
                        <div class="col-xs-12 col-sm-12 col-md-12">
                            <div class="row mb-3">
                                <label for="editRowItemName" class="col-sm-3 col-form-label">Item Name</label>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control" id="editRowItemName" name="editRowItemName">
                                </div>
                            </div>
                        </div>
                        <div class="col-xs-12 col-sm-12 col-md-12">
                            <div class="float-end d-inline-flex">
                                <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Reset</button>
                                &nbsp;&nbsp;&nbsp;&nbsp;
                                <button type="button" id="editRowItemFormSubmit" class="btn btn-primary">Submit</button>
                                <input type="hidden" id="editRowItemId" name="editRowItemId">
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<!-- modal end -->

<!-- stock -->
<!-- add stock -->
<!-- modal start -->
<!-- <div class="modal fade" tabindex="-1" aria-labelledby="addStock" id="addStock" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-xl">
        <div class="modal-content">
            <div class="modal-header text-light" style="background-color:#2f2e41;">
                <h5 class="modal-title"><i class="fad fa-container-storage fa-lg" style="margin-right: 10px;"></i>Add Stock</h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="" method="post" role="form" id="stockForm">
                    <div class="row">
                        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-6">
                            <div class="row mb-3">
                                <label for="stockRowItemName" class="col-sm-3 col-form-label">Row Item</label>
                                <div class="col-sm-9">
                                    <select class="form-select" aria-label="Default select example" id="stockRowItemName" name="stockRowItemName">
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-6">
                            <div class="row mb-3">
                                <label for="stockReferenceNo" class="col-sm-3 col-form-label"> Reference No. </label>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control" id="stockReferenceNo" name="stockReferenceNo">
                                </div>
                            </div>
                        </div>
                        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-6">
                            <div class="row mb-3">
                                <label for="stockAddingCount" class="col-sm-3 col-form-label">Adding Count </label>
                                <div class="col-sm-9">
                                    <input type="number" class="form-control" id="stockAddingCount" name="stockAddingCount">
                                </div>
                            </div>
                        </div>
                        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-6">
                            <div class="row mb-3">
                                <label for="stockCurrentCount" class="col-sm-3 col-form-label"> Current Count </label>
                                <div class="col-sm-9">
                                    <input type="number" class="form-control" id="stockCurrentCount" name="stockCurrentCount">
                                </div>
                            </div>
                        </div>
                        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-6">
                            <div class="row mb-3">
                                <label for="stockCostPerUnit" class="col-sm-3 col-form-label"> Stock Unit Price </label>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control" id="stockCostPerUnit" name="stockCostPerUnit">
                                </div>
                            </div>
                        </div>
                        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-6">
                            <div class="row mb-3">
                                <label for="stockMnfData" class="col-sm-3 col-form-label"> Manufacture Date </label>
                                <div class="col-sm-9">
                                    <input type="date" class="form-control" id="stockMnfData" name="stockMnfData">
                                </div>
                            </div>
                        </div>
                        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-6">
                            <div class="row mb-3">
                                <label for="stockExpDate" class="col-sm-3 col-form-label"> Expire Date </label>
                                <div class="col-sm-9">
                                    <input type="date" class="form-control" id="stockExpDate" name="stockExpDate">
                                </div>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                                <div class="float-end d-inline-flex">
                                    <button type="reset" class="btn btn-danger">Reset</button>
                                    &nbsp;&nbsp;&nbsp;&nbsp;
                                    <button type="button" id="stockFormSubmit" class="btn btn-primary">Submit</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div> -->
<!-- modal end -->

<!-- GRN -->
<!-- add grn -->
<!-- modal start -->
<div class="modal fade" tabindex="-1" aria-labelledby="addGrn" id="addGrn" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-md">
        <div class="modal-content">
            <div class="modal-header text-light" style="background-color:#2f2e41;">
                <h5 class="modal-title"><i class="fal fa-file-invoice fa-lg" style="margin-right: 10px;"></i>Add Goods Receipt Note</h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="" method="post" role="form" id="grnForm">
                    <div class="row">
                        <div class="col-xs-12 col-sm-12 col-md-12">
                            <div class="row mb-3">
                                <label for="grnDate" class="col-sm-3 col-form-label">Date</label>
                                <div class="col-sm-9">
                                    <input type="date" class="form-control" id="grnDate" name="grnDate">
                                </div>
                            </div>
                        </div>
                        <div class="col-xs-12 col-sm-12 col-md-12">
                            <div class="row mb-3">
                                <label for="grnPrice" class="col-sm-3 col-form-label">Price(Rs)</label>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control" id="grnPrice" name="grnPrice">
                                </div>
                            </div>
                        </div>
                        <div class="col-xs-12 col-sm-12 col-md-12 ">
                            <div class="row mb-3">
                                <label for="grnSupplierName" class="col-sm-3 col-form-label">Supplier Name</label>
                                <div class="col-sm-9">
                                    <select class="form-select" aria-label="Default select example" id="grnSupplierName" name="grnSupplierName">
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="col-xs-12 col-sm-12 col-md-12">
                            <div class="float-end d-inline-flex">
                                <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Reset</button>
                                &nbsp;&nbsp;&nbsp;&nbsp;
                                <button type="button" id="grnFormSubmit" class="btn btn-primary">Submit</button>
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
<!-- edit grn -->
<div class="modal fade" tabindex="-1" aria-labelledby="editGrn" id="editGrn" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-md">
        <div class="modal-content">
            <div class="modal-header text-light" style="background-color:#2f2e41;">
                <h5 class="modal-title"><i class="fal fa-file-invoice fa-lg" style="margin-right: 10px;"></i>Edit Goods Receipt Note</h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="" method="post" role="form" id="editGrnForm">
                    <div class="row">
                        <div class="col-xs-12 col-sm-12 col-md-12">
                            <div class="row mb-3">
                                <label for="editGrnDate" class="col-sm-3 col-form-label">Date</label>
                                <div class="col-sm-9">
                                    <input type="date" class="form-control" id="editGrnDate" name="editGrnDate">
                                </div>
                            </div>
                        </div>
                        <div class="col-xs-12 col-sm-12 col-md-12">
                            <div class="row mb-3">
                                <label for="editGrnPrice" class="col-sm-3 col-form-label">Price(Rs)</label>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control" id="editGrnPrice" name="editGrnPrice">
                                </div>
                            </div>
                        </div>
                        <div class="col-xs-12 col-sm-12 col-md-12 ">
                            <div class="row mb-3">
                                <label for="editGrnSupplierName" class="col-sm-3 col-form-label">Supplier Name</label>
                                <div class="col-sm-9">
                                    <select class="form-select" aria-label="Default select example" id="editGrnSupplierName" name="editGrnSupplierName">
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="col-xs-12 col-sm-12 col-md-12">
                            <div class="float-end d-inline-flex">
                                <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Reset</button>
                                &nbsp;&nbsp;&nbsp;&nbsp;
                                <input type="hidden" id="editGrnId" name="editGrnId">
                                <button type="button" id="editGrnFormSubmit" class="btn btn-primary">Submit</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<!-- modal end -->
<?php require_once '../view/scriptInclude.php'; ?>
<script>
    $(window).load(getRowItemData(),getSupplierData(), getGrnData());
</script>
<?php require_once '../view/footer.php'; ?>