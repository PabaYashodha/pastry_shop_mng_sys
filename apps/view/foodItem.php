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
                    <button class="btn btn-dark float-end" data-bs-toggle="modal" data-bs-target="#addFoodItem"><i class="far fa-plus"></i> ADD FOOD ITEM</button>
                    <a href="../view/category.php" class="btn text-light" style="background-color:#2f2e41;" role="button" aria-pressed="true">Category</a>
                    <a href="../view/subCategory.php" class="btn text-light" style="margin-left: 5px; background-color:#2f2e41;" role="button" aria-pressed="true">Sub Category</a>
                </div>
            </div>
            <div class="row">
                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                    <table class="table  table-hover table-responsive-*" id="dataTable">
                        <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Image</th>
                                <th scope="col">Product</th>
                                <th scope="col">Unit Price (Rs)</th>
                                <th scope="col">Status</th>
                                <th scope="col">Option</th>
                            </tr>
                        </thead>
                        <tbody id="foodItemTable"></tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- modal start  -->
<!-- add food item -->
<div class="modal fade" tabindex="-1" aria-labelledby="addFoodItem" id="addFoodItem" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-md">
        <div class="modal-content">
            <div class="modal-header text-light" style="background-color:#2f2e41;">
                <h5 class="modal-title"><i class="fad fa-burger-soda fa-2x" style="margin-right: 10px;"></i>Add Food Item</h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="" method="post" role="form" id="foodItemForm">
                    <div class="row">
                        <div class="col-xs-12 col-sm-12 col-md-12">
                            <div class="row mb-3">
                                <label for="foodItemName" class="col-sm-3 col-form-label">Item Name</label>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control" id="foodItemName" name="foodItemName">
                                </div>
                            </div>
                        </div>
                        <div class="col-xs-12 col-sm-12 col-md-12">
                            <div class="row mb-3">
                                <label for="unitPrice" class="col-sm-3 col-form-label">Unit Price</label>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control" id="unitPrice" name="unitPrice">
                                </div>
                            </div>
                        </div>
                        <div class="col-xs-12 col-sm-12 col-md-12">
                            <div class="row mb-3">
                                <label for="category" class="col-sm-3 col-form-label">Category</label>
                                <div class="col-sm-9">
                                    <select class="form-select" aria-label="Default select example" id="category" name="category">
                                        <option selected value="">-- Select Category --</option>
                                        <option value="1">Savories & Buns</option>
                                        <option value="2">Breads</option>
                                        <option value="3">Sweet Foods</option>
                                        <option value="4">Vegetarian Foods</option>
                                        <option value="5">Drinks</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="col-xs-12 col-sm-12 col-md-12">
                            <div class="row mb-3">
                                <label for="subCategory" class="col-sm-3 col-form-label">Sub Category</label>
                                <div class="col-sm-9">
                                    <select class="form-select" aria-label="Default select example" id="subCategory" name="subCategory">
                                        <option selected value="">-- Select Sub Category --</option>
                                        <option value="1">Cool Drinks</option>
                                        <option value="2">Hot Drinks</option>
                                        <option value="3">Typical Sri Lankan Breads</option>
                                        <option value="4">Healthy Breads</option>
                                        <option value="5">Sandwiches</option>
                                        <option value="5">Cutlets</option>
                                        <option value="5">Rolls</option>
                                        <option value="5">Pastries</option>
                                        <option value="5">Samosa</option>
                                        <option value="5">Rotties</option>
                                        <option value="5">Croissants</option>
                                        <option value="5">Buns</option>
                                        <option value="5">Burgers</option>
                                        <option value="5">Donuts</option>
                                        <option value="5">Muffins</option>
                                        <option value="5">Cakes</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-xs-12 col-sm-12 col-md-12">
                                <div class="row mb-3">
                                    <label for="foodItemImage" class="col-sm-3 col-form-label">Image</label>
                                    <div class="col-sm-9">
                                        <input class="form-control" type="file" id="foodItemImage" name="foodItemImage" onchange="preview(this)">
                                    </div>
                                </div>
                            </div>
                            <div class="col-xs-12 col-sm-12 col-md-12">
                                <div class="row mb-3">
                                    <img id="food_pre_image">
                                </div>
                            </div>
                            <div class="col-xs-12 col-sm-12 col-md-12">
                                <div class="float-end d-inline-flex">
                                    <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Reset</button>
                                    &nbsp;&nbsp;&nbsp;&nbsp;
                                    <button type="button" id="foodItemFormSubmit" class="btn btn-primary">Submit</button>
                                </div>
                            </div>
                        </div>
                    </div>
            </div>
        </div>
    </div>
</div>
    <!-- modal end -->

    <!-- modal start  -->
    <!-- view food item -->
<div class="modal fade" tabindex="-1" aria-labelledby="viewFoodItem" id="viewFoodItem" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">VIEW DINING TABLE</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div id="viewFoodItemContent"></div>
            </div>
            <div class="modal-footer"></div>
        </div>
    </div>
</div>
    <!-- modal end -->

    <!-- modal start  -->
    <!-- edit food item -->
    <div class="modal fade" tabindex="-1" aria-labelledby="editFoodItem" id="editFoodItem" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-md">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Edit Food Item</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="" method="post" role="form" id="editFoodItemForm">
                    <div class="row">
                        <div class="col-xs-12 col-sm-12 col-md-12">
                            <div class="row mb-3">
                                <label for="editFoodItemName" class="col-sm-3 col-form-label">Item Name</label>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control" id="editFoodItemName" name="editFoodItemName">
                                </div>
                            </div>
                        </div>
                        <div class="col-xs-12 col-sm-12 col-md-12">
                            <div class="row mb-3">
                                <label for="editUnitPrice" class="col-sm-3 col-form-label">Unit Price</label>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control" id="editUnitPrice" name="editUnitPrice">
                                </div>
                            </div>
                        </div>
                        <div class="col-xs-12 col-sm-12 col-md-12">
                            <div class="row mb-3">
                                <label for="editCategory" class="col-sm-3 col-form-label">Category</label>
                                <div class="col-sm-9">
                                    <select class="form-select" aria-label="Default select example" id="editCategory" name="editCategory">
                                        <option selected value="">-- Select Category --</option>
                                        <option value="1">Savories & Buns</option>
                                        <option value="2">Breads</option>
                                        <option value="3">Sweet Foods</option>
                                        <option value="4">Vegetarian Foods</option>
                                        <option value="5">Drinks</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="col-xs-12 col-sm-12 col-md-12">
                            <div class="row mb-3">
                                <label for="editSubCategory" class="col-sm-3 col-form-label">Sub Category</label>
                                <div class="col-sm-9">
                                    <select class="form-select" aria-label="Default select example" id="editSubCategory" name="editSubCategory">
                                        <option selected value="">-- Select Sub Category --</option>
                                        <option value="1">Cool Drinks</option>
                                        <option value="2">Hot Drinks</option>
                                        <option value="3">Typical Sri Lankan Breads</option>
                                        <option value="4">Healthy Breads</option>
                                        <option value="5">Sandwiches</option>
                                        <option value="5">Cutlets</option>
                                        <option value="5">Rolls</option>
                                        <option value="5">Pastries</option>
                                        <option value="5">Samosa</option>
                                        <option value="5">Rotties</option>
                                        <option value="5">Croissants</option>
                                        <option value="5">Buns</option>
                                        <option value="5">Burgers</option>
                                        <option value="5">Donuts</option>
                                        <option value="5">Muffins</option>
                                        <option value="5">Cakes</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-xs-12 col-sm-12 col-md-12">
                                <div class="row mb-3">
                                    <label for="editFoodItemImage" class="col-sm-3 col-form-label">Image</label>
                                    <div class="col-sm-9">
                                        <input class="form-control" type="file" id="editFoodItemImage" name="editFoodItemImage" onchange="preview(this)">
                                    </div>
                                </div>
                            </div>
                            <div class="col-xs-12 col-sm-12 col-md-12">
                                <div class="row mb-3">
                                    <img id="food_pre_image">
                                </div>
                            </div>
                            <div class="col-xs-12 col-sm-12 col-md-12">
                                <div class="float-end d-inline-flex">
                                    <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Reset</button>
                                    &nbsp;&nbsp;&nbsp;&nbsp;
                                    <button type="button" id="editFoodItemFormSubmit" class="btn btn-primary">Submit</button>
                                </div>
                            </div>
                        </div>
                    </div>
            </div>
        </div>
    </div>
    <!-- modal end -->


    <?php require_once "scriptInclude.php" ?>
    <script>
        $(window).load(getFoodItemData());
    </script>
    <?php require_once "footer.php" ?>