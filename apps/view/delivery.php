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
                    <button class="btn btn-dark float-end" data-bs-toggle="modal" data-bs-target="#addDeliveryPerson"><i class="far fa-plus"></i> ADD DELIVERY PERSON</button>
                </div>
            </div>

            <div class="row">
                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                    <table class="table  table-hover table-responsive-*" id="dataTable">
                        <thead class="table-primary">
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Name</th>
                                <th scope="col">Contact No.</th>
                                <th scope="col">Delivery Status</th>
                                <th scope="col">Options</th>
                            </tr>
                        </thead>
                        <tbody id="deliveryPerson"></tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- modal start  -->
<!-- add delivery -->
<div class="modal fade" tabindex="-1" aria-labelledby="addDeliveryPerson" id="addDeliveryPerson" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Add Delivery Person</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="" method="post" role="form" id="deliveryForm">
                    <div class="row">
                        <div class="col-xs-12 col-sm-12 col-md-12">
                            <div class="row mb-3">
                                <label for="deliveryPersonName" class="col-sm-3 col-form-label">Name</label>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control" id="deliveryPersonName" name="deliveryPersonName">
                                </div>
                            </div>
                        </div>
                        <div class="col-xs-12 col-sm-12 col-md-12">
                            <div class="row mb-3">
                                <label for="deliveryPersonAge" class="col-sm-3 col-form-label">Age</label>
                                <div class="col-sm-9">
                                    <input type="number" class="form-control" id="deliveryPersonAge" name="deliveryPersonAge">
                                </div>
                            </div>
                        </div>
                        <div class="col-xs-12 col-sm-12 col-md-12">
                            <div class="row mb-3">
                                <label for="deliveryPersonContact" class="col-sm-3 col-form-label">Contact No</label>
                                <div class="col-sm-9">
                                    <input type="number" class="form-control" id="deliveryPersonContact" name="deliveryPersonContact">
                                </div>
                            </div>
                        </div>
                        <div class="col-xs-12 col-sm-12 col-md-12">
                            <div class="row mb-3">
                                <label for="deliveryPersonEmail" class="col-sm-3 col-form-label">Email</label>
                                <div class="col-sm-9">
                                    <input type="number" class="form-control" id="deliveryPersonEmail" name="deliveryPersonEmail">
                                </div>
                            </div>
                        </div>
                        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-3">
                            <div class="row mb-3">
                                <label for="deliveryPersonAddress" class="col-sm-6 col-form-label">Address</label>
                                <div class="col-sm-6">
                                    <input class="form-control" type="text" id="deliveryPersonAdd1" name="deliveryPersonAdd1">
                                </div>

                            </div>
                        </div>
                        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-9">
                            <div class="row mb-3">
                                <div class="col-sm-6">
                                    <input class="form-control" type="text" id="deliveryPersonAdd2" name="deliveryPersonAdd2">
                                </div>
                                <div class="col-sm-6">
                                    <input class="form-control" type="text" id="deliveryPersonAdd3" name="deliveryPersonAdd3">
                                </div>
                            </div>
                        </div>
                        <div class="col-xs-12 col-sm-12 col-md-12">
                            <div class="float-end d-inline-flex">
                                <button type="reset" class="btn btn-danger">Reset</button>
                                &nbsp;&nbsp;&nbsp;&nbsp;
                                <button type="button" id="deliveryPersonFormSubmit" class="btn btn-primary">Submit</button>
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

<?php require_once "scriptInclude.php"; ?>
<?php require_once "footer.php"; ?>