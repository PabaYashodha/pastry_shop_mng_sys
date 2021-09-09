<?php
require_once "header.php";
require_once "sidebar.php";
?>
<!-- view food item  in a table -->
<div id="content" class="content-expanded">
    <div class="card" style="border-radius: 20px;">
        <div class="card-body">
            <div class="row mb-3">
                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                    <button class="btn btn-dark float-end" data-bs-toggle="modal" data-bs-target="#addFoodItem"><i class="far fa-plus"></i> ADD FOOD ITEM</button>
                </div>
            </div>
            <div class="row">
                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                    <table class="table  table-hover table-responsive-*" id="dataTable">
                        <thead class="table-primary">
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Image</th>
                                <th scope="col">Name</th>
                                <th scope="col">Category</th>
                                <th scope="col">Sub Category</th>
                                <th scope="col">Unit Price</th>
                                <th scope="col">Status</th>
                                <th scope="col">Option</th>
                            </tr>
                        </thead>
                        <!-- <tbody id="customerTable"></tbody> -->
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- add food item -->
<div class="modal" tabindex="-1" id="addFoodItem">
    <div class="modal-dialog modal-md modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Add Food Item</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="" method="post" role="form" id="addFoodItem">
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
                                <label for="categoryName" class="col-sm-3 col-form-label">Category</label>
                                <div class="col-sm-9">
                                    <select class="form-select" aria-label="Default select example" id="categoryName" name="categoryName">
                                        <option selected value="">-- Select role --</option>
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
                                <label for="subCategoryName" class="col-sm-3 col-form-label">Sub Category</label>
                                <div class="col-sm-9">
                                    <select class="form-select" aria-label="Default select example" id="subCategoryName" name="subCategoryName">
                                        <option selected value="">-- Select role --</option>
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
                            <!-- <div class="col-xs-12 col-sm-12 col-md-12">
                            <div class="row mb-3">
                                <img id="pre_image">
                            </div>
                        </div> -->
                            <div class="col-xs-12 col-sm-12 col-md-12">
                                <div class="float-end d-inline-flex">
                                    <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Reset</button>
                                    &nbsp;&nbsp;&nbsp;&nbsp;
                                    <button type="button" id="addItemSubmit" class="btn btn-primary">Submit</button>
                                </div>
                            </div>
                        </div>
                </form>
            </div>
            <!-- <div class="modal-footer"></div> -->
        </div>
    </div>
</div>


<?php require_once "scriptInclude.php" ?>
<!-- <script>
    $(window).load(getCustomerData());
</script> -->
<?php require_once "footer.php"; ?>