<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Supplier Manage</title>
    <link rel="stylesheet" type="text/css" href="../../resources/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="../../resources/toastr/build/toastr.min.css">
    <link rel="stylesheet" type="text/css" href="../../resources/fontawesome/css/all.min.css" />
    <link rel="stylesheet" type="text/css" href="../../resources/DataTables/datatables.min.css" />
    <link rel="stylesheet" type="text/css" href="../../css/style.css" />

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
</head>

<body>

    <div class="container">
        <div class="card shadow-lg mt-5" style="border-radius: 20px;">
            <div class="card-body">
                <div class="row mb-3">
                    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                        <button class="btn btn-dark float-end" data-bs-toggle="modal" data-bs-target="#addSupplier"><i class="far fa-plus"></i> ADD SUPPLIER</button>
                    </div>
                </div>

                <div class="row">
                    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                        <table class="table  table-hover table-responsive-*" id="dataTable">
                            <thead class="table-primary">
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">Name</th>
                                    <th scope="col">Contact Name</th>
                                    <th scope="col">Email</th>
                                    <th scope="col">Contact</th>
                                    <th scope="col">Option</th>
                                </tr>
                            </thead>
                            <tbody id="supplierTable"></tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- modal start -->
    <!-- add supplier -->
    <div class="modal fade" tabindex="-1" aria-labelledby="addSupplier" id="addSupplier" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-xl">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Add Supplier</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="" method="post" role="form" id="supplierForm">
                        <div class="row">
                            <div class="row mb-3">
                                <label for="supplierName" class="col-sm-3 col-form-label">Supplier Name</label>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control" id="supplierName" name="supplierName">
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label for="supplierContactName" class="col-sm-3 col-form-label">Supplier Contact Name</label>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control" id="supplierContactName" name="supplierContactName">
                                </div>
                            </div>
                            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-6">
                                <div class="row mb-3">
                                    <label for="supplierEmail" class="col-sm-3 col-form-label">Email</label>
                                    <div class="col-sm-9">
                                        <input type="email" class="form-control" id="supplierEmail" name="supplierEmail">
                                    </div>
                                </div>
                            </div>
                            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-6">
                                <div class="row mb-3">
                                    <label for="supplierContact" class="col-sm-3 col-form-label">Contact</label>
                                    <div class="col-sm-9">
                                        <input type="number" class="form-control" id="supplierContact" name="supplierContact">
                                    </div>
                                </div>
                            </div>
                            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-3">
                                <div class="row mb-3">
                                    <label for="supplierAddress" class="col-sm-6 col-form-label">Address</label>
                                    <div class="col-sm-6">
                                        <input class="form-control" type="text" id="supplierAdd1" name="supplierAdd1">
                                    </div>
                                </div>
                            </div>
                            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-9">
                                <div class="row mb-3">
                                    <div class="col-sm-6">
                                        <input class="form-control" type="text" id="supplierAdd2" name="supplierAdd2">
                                    </div>
                                    <div class="col-sm-6">
                                        <input class="form-control" type="text" id="supplierAdd3" name="supplierAdd3">
                                    </div>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                                    <div class="float-end d-inline-flex">
                                        <button type="reset" class="btn btn-danger">Reset</button>
                                        &nbsp;&nbsp;&nbsp;&nbsp;
                                        <button type="button" id="supplierFormSubmit" class="btn btn-primary">Submit</button>
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

     <!-- modal start -->
    <!-- view supplier -->
    <div class="modal fade" tabindex="-1" aria-labelledby="viewSupplier" id="viewSupplier" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-md">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">VIEW SUPPLIER</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div id="viewSupplierContent"></div>
                </div>
                <div class="modal-footer"></div>
            </div>
        </div>
    </div>
    <!-- modal end -->

    <!-- modal start -->
    <!-- edit supplier -->
    <div class="modal fade" tabindex="-1" aria-labelledby="editSupplier" id="editSupplier" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">EDIT SUPPLIER</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                <form action="" method="post" role="form" id="editSupplierForm">
                        <div class="row">
                            <div class="row mb-3">
                                <label for="editSupplierName" class="col-sm-3 col-form-label">Supplier Name</label>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control" id="editSupplierName" name="editSupplierName">
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label for="editSupplierContactName" class="col-sm-3 col-form-label">Supplier Contact Name</label>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control" id="editSupplierContactName" name="editSupplierContactName">
                                </div>
                            </div>
                            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-6">
                                <div class="row mb-3">
                                    <label for="editSupplierEmail" class="col-sm-3 col-form-label">Email</label>
                                    <div class="col-sm-9">
                                        <input type="email" class="form-control" id="editSupplierEmail" name="editSupplierEmail">
                                    </div>
                                </div>
                            </div>
                            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-6">
                                <div class="row mb-3">
                                    <label for="editSupplierContact" class="col-sm-3 col-form-label">Contact</label>
                                    <div class="col-sm-9">
                                        <input type="number" class="form-control" id="editSupplierContact" name="editSupplierContact">
                                    </div>
                                </div>
                            </div>
                            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-3">
                                <div class="row mb-3">
                                    <label for="editSupplierAddress" class="col-sm-6 col-form-label">Address</label>
                                    <div class="col-sm-6">
                                        <input class="form-control" type="text" id="editSupplierAdd1" name="editSupplierAdd1">
                                    </div>
                                </div>
                            </div>
                            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-9">
                                <div class="row mb-3">
                                    <div class="col-sm-6">
                                        <input class="form-control" type="text" id="editSupplierAdd2" name="editSupplierAdd2">
                                    </div>
                                    <div class="col-sm-6">
                                        <input class="form-control" type="text" id="editSupplierAdd3" name="editSupplierAdd3">
                                    </div>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                                    <div class="float-end d-inline-flex">
                                        <button type="reset" class="btn btn-danger">Reset</button>
                                        &nbsp;&nbsp;&nbsp;&nbsp;
                                        <input type="hidden" id="editSupplierId" name="editSupplierId">
                                        <button type="button" id="saveEditSupplierForm" class="btn btn-primary">Submit</button>
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
</body>
<script type="text/javascript" src="../../js/jquery-3.6.0.min.js"></script>
<script type="text/javascript" src="../../resources/bootstrap/js/bootstrap.min.js"></script>
<script type="text/javascript" src="../../js/validation.js"></script>
<script type="text/javascript" src="../../resources/sweetalert.js"></script>
<script type="text/javascript" src="../../resources/toastr/build/toastr.min.js"></script>
<script type="text/javascript" src="../../resources/fontawesome/js/all.min.js"></script>
<script type="text/javascript" src="../../resources/DataTables/datatables.min.js"></script>
<script type="text/javascript" src="../../js/script.js"></script>

</html>