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
<!-- view customer  in a table -->
<div id="content" class="content-expanded">
    <div class="card shadow-lg " style="border-radius: 10px; padding:0.4rem">
        <nav aria-label="breadcrumb" class="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="../view/dashboard.php" style="text-decoration: none; color:#2f2e41 !important"> HOME</a></li>
                <li class="breadcrumb-item active" aria-current="page">CUSTOMER MANAGEMENT</li>
            </ol>
        </nav>
    </div>
    <div class="card shadow-lg mt-3" style="border-radius: 20px;">
        <div class="card-body">
            <div class="row mb-3">
                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                    <button class="btn btn-dark float-end" data-bs-toggle="modal" data-bs-target="#addCustomer" style="background-color: #2f2e41;"><i class="far fa-plus"></i> ADD CUSTOMER</button>
                </div>
            </div>
            <div class="row">
                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                    <table class="table  table-hover table-responsive-*" id="dataTable">
                        <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Name</th>
                                <th scope="col">Contact</th>
                                <th scope="col">Email</th>
                                <th scope="col">Address</th>
                                <th scope="col">Option</th>
                            </tr>
                        </thead>
                        <tbody id="customerTable"></tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- modal start -->
<!-- add Customer -->
<div class="modal fade" tabindex="-1" aria-labelledby="addCustomer" id="addCustomer" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-xl">
        <div class="modal-content">
            <div class="modal-header text-light" style="background-color: #2f2e41;">
                <h5 class="modal-title">Add Customer</h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="" method="post" role="form" id="customerForm">
                    <div class="row">
                        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-6">
                            <div class="row mb-3">
                                <label for="customerFirstName" class="col-sm-3 col-form-label">First Name</label>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control" id="customerFirstName" name="customerFirstName">
                                </div>
                            </div>
                        </div>
                        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-6">
                            <div class="row mb-3">
                                <label for="customerLastName" class="col-sm-3 col-form-label"> Last Name </label>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control" id="customerLastName" name="customerLastName">
                                </div>
                            </div>
                        </div>
                        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-6">
                            <div class="row mb-3">
                                <label for="customerContact" class="col-sm-3 col-form-label"> Contact </label>
                                <div class="col-sm-9">
                                    <input type="number" class="form-control" id="customerContact" name="customerContact">
                                </div>
                            </div>
                        </div>
                        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-6">
                            <div class="row mb-3">
                                <label for="customerEmail" class="col-sm-3 col-form-label"> Email </label>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control" id="customerEmail" name="customerEmail">
                                </div>
                            </div>
                        </div>
                        <!-- <div class="col-xs-12 col-sm-12 col-md-12 col-lg-6">
                            <div class="row mb-3">
                                <label for="customerGender" class="col-sm-3 col-form-label"> Gender </label>
                                <div class="col-sm-9">
                                    <label class="form-check-label" for="Male"> Male </label>
                                    <input type="radio" class="form-check-input" name="customerGender" id="Male" value="1" checked>
                                    &nbsp; &nbsp;
                                    <label class="form-check-label" for="Female"> Female </label>
                                    <input type="radio" class="form-check-input" name="customerGender" id="Female" value="0">
                                </div>
                            </div>
                        </div> -->
                        <!-- <div class="col-xs-12 col-sm-12 col-md-12 col-lg-6">
                            <div class="row mb-3">
                                <label for="customerBirthday" class="col-sm-3 col-form-label"> Birthday </label>
                                <div class="col-sm-9">
                                    <input type="date" class="form-control" id="customerBirthday" name="customerBirthday">
                                </div>
                            </div>
                        </div> -->

                        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-3">
                            <div class="row mb-3">
                                <label for="customerAddress" class="col-sm-6 col-form-label">Address</label>
                                <div class="col-sm-6">
                                    <input class="form-control" type="text" id="customerAdd1" name="customerAdd1">
                                </div>

                            </div>
                        </div>
                        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-9">
                            <div class="row mb-3">
                                <div class="col-sm-6">
                                    <input class="form-control" type="text" id="customerAdd2" name="customerAdd2">
                                </div>
                                <div class="col-sm-6">
                                    <input class="form-control" type="text" id="customerAdd3" name="customerAdd3">
                                </div>
                            </div>
                        </div>
                        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-6">
                            <div class="row mb-3">
                                <label for="customerPostalCode" class="col-sm-3 col-form-label"> Postal Code </label>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control" id="customerPostalCode" name="customerPostalCode">
                                </div>
                            </div>
                        </div>
                        <!-- <div class="col-xs-12 col-sm-12 col-md-12 col-lg-6">
                            <div class="row mb-3">
                                <label for="customerNic" class="col-sm-3 col-form-label"> NIC </label>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control" id="customerNic" name="customerNic">
                                </div>
                            </div>
                        </div> -->
                        <div class="row mb-3">
                            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                                <div class="float-end d-inline-flex">
                                    <button type="reset" class="btn btn-danger">Reset</button>
                                    &nbsp;&nbsp;&nbsp;&nbsp;
                                    <button type="button" id="customerFormSubmit" class="btn btn-primary">Submit</button>
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
<!-- view Customer -->
<div class="modal fade" tabindex="-1" aria-labelledby="viewCustomer" id="viewCustomer" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-md">
        <div class="modal-content">
            <div class="modal-header text-light" style="background-color: #2f2e41;">
                <h5 class="modal-title">VIEW CUSTOMER</h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div id="viewCustomerContent"></div>
            </div>
            
        </div>
    </div>
</div>
<!-- modal end -->

<!-- modal start -->
<!-- edit customer -->
<div class="modal fade" tabindex="-1" aria-labelledby="editCustomer" id="editCustomer" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-xl">
        <div class="modal-content">
            <div class="modal-header text-light" style="background-color: #2f2e41;">
                <h5 class="modal-title">Edit Customer</h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="" method="post" role="form" id="editCustomerForm">
                    <div class="row">
                        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-6">
                            <div class="row mb-3">
                                <label for="editCustomerFirstName" class="col-sm-3 col-form-label">First Name</label>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control" id="editCustomerFirstName" name="editCustomerFirstName">
                                </div>
                            </div>
                        </div>
                        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-6">
                            <div class="row mb-3">
                                <label for="editCustomerLastName" class="col-sm-3 col-form-label"> Last Name </label>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control" id="editCustomerLastName" name="editCustomerLastName">
                                </div>
                            </div>
                        </div>
                        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-6">
                            <div class="row mb-3">
                                <label for="editCustomerContact" class="col-sm-3 col-form-label"> Contact </label>
                                <div class="col-sm-9">
                                    <input type="number" class="form-control" id="editCustomerContact" name="editCustomerContact">
                                </div>
                            </div>
                        </div>
                        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-6">
                            <div class="row mb-3">
                                <label for="editCustomerEmail" class="col-sm-3 col-form-label"> Email </label>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control" id="editCustomerEmail" name="editCustomerEmail">
                                </div>
                            </div>
                        </div>
                        <!-- <div class="col-xs-12 col-sm-12 col-md-12 col-lg-6">
                            <div class="row mb-3">
                                <label for="editCustomerGender" class="col-sm-3 col-form-label"> Gender </label>
                                <div class="col-sm-9">
                                    <label class="form-check-label" for="Male"> Male </label>
                                    <input type="radio" class="form-check-input" name="editCustomerGender" id="Male" value="1" checked>
                                    &nbsp; &nbsp;
                                    <label class="form-check-label" for="Female"> Female </label>
                                    <input type="radio" class="form-check-input" name="editCustomerGender" id="Female" value="0">
                                </div>
                            </div>
                        </div> -->
                        <!-- <div class="col-xs-12 col-sm-12 col-md-12 col-lg-6">
                            <div class="row mb-3">
                                <label for="editCustomerBirthday" class="col-sm-3 col-form-label"> Birthday </label>
                                <div class="col-sm-9">
                                    <input type="date" class="form-control" id="editCustomerBirthday" name="editCustomerBirthday">
                                </div>
                            </div>
                        </div> -->

                        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-3">
                            <div class="row mb-3">
                                <label for="editCustomerAddress" class="col-sm-6 col-form-label">Address</label>
                                <div class="col-sm-6">
                                    <input class="form-control" type="text" id="editCustomerAdd1" name="editCustomerAdd1">
                                </div>

                            </div>
                        </div>
                        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-9">
                            <div class="row mb-3">
                                <div class="col-sm-6">
                                    <input class="form-control" type="text" id="editCustomerAdd2" name="editCustomerAdd2">
                                </div>
                                <div class="col-sm-6">
                                    <input class="form-control" type="text" id="editCustomerAdd3" name="editCustomerAdd3">
                                </div>
                            </div>
                        </div>
                        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-6">
                            <div class="row mb-3">
                                <label for="editCustomerPostalCode" class="col-sm-3 col-form-label"> Postal Code </label>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control" id="editCustomerPostalCode" name="editCustomerPostalCode">
                                </div>
                            </div>
                        </div>
                        <!-- <div class="col-xs-12 col-sm-12 col-md-12 col-lg-6">
                            <div class="row mb-3">
                                <label for="editCustomerNic" class="col-sm-3 col-form-label"> NIC </label>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control" id="editCustomerNic" name="editCustomerNic">
                                </div>
                            </div>
                        </div> -->
                        <div class="row mb-3">
                            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                                <div class="float-end d-inline-flex">
                                    <button type="reset" class="btn btn-danger">Reset</button>
                                    &nbsp;&nbsp;&nbsp;&nbsp;
                                    <input type="hidden" id="editCustomerId" name="editCustomerId">
                                    <button type="button" id="saveEditCustomerForm" class="btn btn-primary">Submit</button>
                                </div>
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
    $(window).load(getCustomerData());
</script>
<?php require_once "footer.php"; ?>