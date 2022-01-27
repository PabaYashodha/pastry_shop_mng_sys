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
                    </ul>
                    <!-- stock -->
                    <div class="tab-content" id="pills-tabContent">
                        <div class="tab-pane fade show active" id="pills-home" role="tabpanel" aria-labelledby="pills-home-tab">
                            <div class="row">
                                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 mb-3">
                                    <button class="btn btn-dark float-end" data-bs-toggle="modal" data-bs-target="#addStock"><i class="far fa-plus"></i> ADD STOCK</button>
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
                                                <th scope="col"></th>
                                                <th scope="col"></th>
                                                <th scope="col"></th>
                                            </tr>
                                        </thead>
                                        <tbody id="rowItemTable"></tbody>
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

<!-- add row items -->
<div class="modal fade" tabindex="-1" aria-labelledby="addRowItems" id="addRowItems" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-md">
        <div class="modal-content">
            <div class="modal-header text-light" style="background-color:#2f2e41;">
                <h5 class="modal-title"><i class="fad fa-burger-soda fa-2x" style="margin-right: 10px;"></i>Add Row Items</h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
            <form action="" method="post" role="form" id="foodItemForm">
                
            </form>
            </div>
        </div>
    </div>
</div>

<?php
require_once '../view/scriptInclude.php';
require_once '../view/footer.php';
?>