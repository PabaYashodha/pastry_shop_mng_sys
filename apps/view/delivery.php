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
                <li class="breadcrumb-item active" aria-current="page">DELIVERY MANAGEMENT</li>
            </ol>
        </nav>
    </div>
    <div class="card shadow-lg mt-3" style="border-radius: 20px;">
        <div class="card-body">
            <div class="row mb-3">
                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                    <a href="../view/user.php"><button class="btn btn-dark float-end" style="background-color: #2f2e41;"><i class="far fa-plus"></i> ADD DELIVERY PERSON</button></a>
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                <ul class="nav nav-pills mb-3" id="pills-tab" role="tablist">
                    <li class="nav-item" role="presentation">
                        <button class="nav-link active nav-link2" id="pills-home-tab" data-bs-toggle="pill" data-bs-target="#pills-home" type="button" role="tab" aria-controls="pills-home" aria-selected="true">Ready to Delivery </button>
                    </li>
                    <li class="nav-item" role="presentation">
                        <button class="nav-link nav-link2" id="pills-profile-tab" data-bs-toggle="pill" data-bs-target="#pills-profile" type="button" role="tab" aria-controls="pills-profile" aria-selected="false">Order Delivered</button>
                    </li>
                    <li class="nav-item" role="presentation">
                        <button class="nav-link nav-link2" id="pills-contact-tab" data-bs-toggle="pill" data-bs-target="#pills-contact" type="button" role="tab" aria-controls="pills-contact" aria-selected="false">Delivery Person Details</button>
                    </li>
                </ul>

                <!-- ready to delivery -->
                <div class="tab-content" id="pills-tabContent">
                    <div class="tab-pane fade show active" id="pills-home" role="tabpanel" aria-labelledby="pills-home-tab">
                        <div class="row">
                            <div class="row">
                                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                                    <table class="table  table-hover table-responsive-*" id="dataTable">
                                        <thead>
                                            <tr>
                                                <th scope="col">#</th>
                                                <th scope="col">Invoice Id</th>
                                                <th scope="col">Delivery Date</th>
                                                <th scope="col">Delivery Status</th>
                                                <th scope="col">Option</th>
                                            </tr>
                                        </thead>
                                        <tbody id="readyToDeliveryTable"></tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- order completed -->
                    <div class="tab-pane fade" id="pills-profile" role="tabpanel" aria-labelledby="pills-profile-tab">
                        <div class="row">
                            <div class="row">
                                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                                    <table class="table tablePill table-hover table-responsive-*" id="dataTable">
                                        <thead>
                                            <tr>
                                                <th scope="col">#</th>
                                                <th scope="col">Invoice Id</th>
                                                <th scope="col">Delivery Date</th>
                                                <th scope="col">Delivery Status</th>
                                                <th scope="col">Option</th>
                                            </tr>
                                        </thead>
                                        <tbody id="orderCompletedTable"></tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- delivery person -->
                    <div class="tab-pane fade" id="pills-contact" role="tabpanel" aria-labelledby="pills-contact-tab">
                        <div class="row">
                            <div class="row">
                                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                                    <table class="table tablePill table-hover table-responsive-*" id="dataTable">
                                        <thead>
                                            <tr>
                                                <th scope="col">#</th>
                                                <th scope="col">Employee Id</th>
                                                <th scope="col">Name</th>
                                                <th scope="col">Contact</th>
                                                <th scope="col">Status</th>
                                                <th scope="col">Option</th>
                                            </tr>
                                        </thead>
                                        <tbody id="deliveryPersonTable"></tbody>
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




<!-- modal start  -->
<!-- add delivery -->
<div class="modal fade" tabindex="-1" aria-labelledby="addDeliveryPerson" id="addDeliveryPerson" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-md">
        <div class="modal-content">
            <div class="modal-header text-light" style="background-color:#2f2e41;">
                <h5 class="modal-title">Add Delivery Person</h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
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
        </div>
    </div>
</div>
<!-- modal end -->

<!-- assign delivery person -->
<!-- modal start -->
<div class="modal fade" tabindex="-1" aria-labelledby="assignDeliveryPerson" id="assignDeliveryPerson" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-md">
        <div class="modal-content">
            <div class="modal-header text-light" style="background-color:#2f2e41;">
                <h5 class="modal-title">ASSIGN DELIVERY PERSON</h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="" method="post" role="form" id="assignDeliveryForm">
                    <div class="row">
                        <div class="col-xs-12 col-sm-12 col-md-12">
                            <div class="row mb-3">
                                <label for="deliveryPerson" class="col-sm-3 col-form-label">Delivery Person</label>
                                <div class="col-sm-9">
                                    <select class="form-select" aria-label="Default select example" id="deliveryPerson" name="deliveryPerson">
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="col-xs-12 col-sm-12 col-md-12">
                            <div class="float-end d-inline-flex">
                                <button type="reset" class="btn btn-danger">Reset</button>
                                &nbsp;&nbsp;&nbsp;&nbsp;
                                <input type="hidden" id="orderId" name="orderId">
                                <button type="button" id="assignPersonFormSubmit" class="btn btn-primary">Submit</button>
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
<div class="modal fade" tabindex="-1" aria-labelledby="viewDeliveryPerson" id="viewDeliveryPersonDetails" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-xl">
        <div class="modal-content">
            <div class="modal-header" style="background-color: #2f2e41;">
                <h5 class="modal-title text-light">VIEW DELIVERY PERSON</h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div id="viewDeliveryPersonContent"></div>
            </div>
        </div>
    </div>
</div>
<!-- modal end -->
<?php require_once "scriptInclude.php"; ?>
<script>
    window.load(readyToDeliveryTableBody(), deliveryCompletedTableBody(), deliveryPerson(), deliveryPersonName())
</script>
<?php require_once "footer.php"; ?>