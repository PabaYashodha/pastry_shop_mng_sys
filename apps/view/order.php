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
                <li class="breadcrumb-item active" aria-current="page">ORDER MANAGEMENT</li>
            </ol>
        </nav>
    </div>

    <div class="card shadow-lg mt-3" style="border-radius: 20px;">
        <div class="card-body">
            <div class="row mb-3">
                <div class="row mb-3">
                    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 mb-3">
                        <a href="../view/makeOrder.php" class="btn btn-dark float-end" role="button" style="background-color: #2f2e41;"><i class="far fa-plus"></i> MAKE AN ORDER</a>
                    </div>
                </div>
                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                    <ul class="nav nav-pills mb-3" id="pills-tab" role="tablist">
                        <li class="nav-item" role="presentation">
                            <button class="nav-link active nav-link2" id="pills-home-tab" data-bs-toggle="pill" data-bs-target="#pills-home" type="button" role="tab" aria-controls="pills-home" aria-selected="true">Online Orders</button>
                        </li>
                        <li class="nav-item" role="presentation">
                            <button class="nav-link nav-link2" id="pills-profile-tab" data-bs-toggle="pill" data-bs-target="#pills-profile" type="button" role="tab" aria-controls="pills-profile" aria-selected="false">New Orders</button>
                        </li>
                    </ul>

                    <!-- online orders -->
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
                                                    <th scope="col">Invoice Total</th>
                                                    <th scope="col">Invoice Date</th>
                                                    <th scope="col">Status</th>
                                                    <th scope="col">Option</th>
                                                </tr>
                                            </thead>
                                            <tbody id="onlineOrderTable"></tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- new orders -->
                        <div class="tab-pane fade" id="pills-profile" role="tabpanel" aria-labelledby="pills-profile-tab">
                            <div class="row">
                                <div class="row">
                                    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                                        <table class="table tablePill table-hover table-responsive-*" id="dataTable">
                                            <thead>
                                                <tr>
                                                    <th scope="col">#</th>
                                                    <th scope="col">Invoice Id</th>
                                                    <th scope="col">Invoice Total</th>
                                                    <th scope="col">Invoice Date</th>
                                                    <th scope="col">Status</th>
                                                    <th scope="col">Option</th>
                                                </tr>
                                            </thead>
                                            <tbody id="newOrderTable"></tbody>
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
</div>

<!-- view online order -->
<div class="modal fade" tabindex="-1" aria-labelledby="viewOnlineOrder" id="viewOnlineOrder" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content">
            <div class="modal-header text-light" style="background-color:#2f2e41;">
                <h5 class="modal-title">Online Order Details</h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div id="viewOnlineOrderDetails"></div>

                <table class="table table-striped">
                    <thead style="background-color: #2f2e41;">
                        <th scope="col">#</th>
                        <th scope="col">Food Item Name</th>
                        <th scope="col">Food Item Unit Price</th>
                        <th scope="col">Food Item Quantity</th>
                    </thead>
                    <tbody id="foodOrderTable"></tbody>
                </table>
            </div>
        </div>
    </div>
</div>
<?php require_once "scriptInclude.php" ?>
<script>
    $(window).load(onlineOrderTableBody(), newOrderTableBody(), viewOnlineOrderDetails());
</script>
<?php require_once "footer.php" ?>