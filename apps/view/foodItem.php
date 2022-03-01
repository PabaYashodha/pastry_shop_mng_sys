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
                    <ul class="nav nav-pills mb-3" id="pills-tab" role="tablist">
                        <li class="nav-item" role="presentation">
                            <button class="nav-link active nav-link2" id="pills-home-tab" data-bs-toggle="pill" data-bs-target="#pills-home" type="button" role="tab" aria-controls="pills-home" aria-selected="true">Food Item</button>
                        </li>
                        <li class="nav-item" role="presentation">
                            <button class="nav-link nav-link2" id="pills-profile-tab" data-bs-toggle="pill" data-bs-target="#pills-profile" type="button" role="tab" aria-controls="pills-profile" aria-selected="false">Category</button>
                        </li>
                        <li class="nav-item" role="presentation">
                            <button class="nav-link nav-link2" id="pills-contact-tab" data-bs-toggle="pill" data-bs-target="#pills-contact" type="button" role="tab" aria-controls="pills-contact" aria-selected="false">Sub Category</button>
                        </li>
                    </ul>
                    <!-- food item -->
                    <div class="tab-content" id="pills-tabContent">
                        <div class="tab-pane fade show active" id="pills-home" role="tabpanel" aria-labelledby="pills-home-tab">
                            <div class="row">
                                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 mb-3">
                                    <button class="btn btn-dark float-end" data-bs-toggle="modal" data-bs-target="#addFoodItem"><i class="far fa-plus"></i> ADD FOOD ITEM</button>
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
                        <!-- Category -->
                        <div class="tab-pane fade" id="pills-profile" role="tabpanel" aria-labelledby="pills-profile-tab">
                            <div class="row">
                                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 mb-3">
                                    <button class="btn btn-dark float-end" data-bs-toggle="modal" data-bs-target="#addCategory"><i class="far fa-plus"></i> ADD CATEGORY</button>
                                </div>
                                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                                    <table class="table  table-hover table-responsive-*" id="dataTable">
                                        <thead>
                                            <tr>
                                                <th scope="col">#</th>
                                                <th scope="col">Category Name</th>
                                                <th scope="col">Status</th>
                                                <th scope="col">Option</th>
                                            </tr>
                                        </thead>
                                        <tbody id="categoryTable"></tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                        <!-- sub category -->
                        <div class="tab-pane fade" id="pills-contact" role="tabpanel" aria-labelledby="pills-contact-tab">
                            <div class="row">
                                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 mb-3">
                                    <button class="btn btn-dark float-end" data-bs-toggle="modal" data-bs-target="#addSubCategory"><i class="far fa-plus"></i> ADD SUB CATEGORY</button>
                                </div>
                                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                                    <table class="table  table-hover table-responsive-*" id="dataTable">
                                        <thead>
                                            <tr>
                                                <th scope="col">#</th>
                                                <th scope="col">Sub Category Name</th>
                                                <th scope="col">Category Name</th>
                                                <th scope="col">Status</th>
                                                <th scope="col">Option</th>
                                            </tr>
                                        </thead>
                                        <tbody id="subCategoryTable"></tbody>
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

<!-- food item -->
<!-- modal start  -->
<!-- add food item -->
<div class="modal fade" tabindex="-1" aria-labelledby="addFoodItem" id="addFoodItem" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-md">
        <div class="modal-content">
            <div class="modal-header text-light" style="background-color:#2f2e41;">
                <h5 class="modal-title"><i class="fad fa-burger-soda fa-lg" style="margin-right: 10px;"></i>Add Food Item</h5>
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
                                <label for="foodItemCategory" class="col-sm-3 col-form-label">Category</label>
                                <div class="col-sm-9">
                                    <select class="form-select" aria-label="Default select example" id="foodItemCategory" name="foodItemCategory">
                                        <!-- <option selected value="">-- Select Category --</option>
                                        <option value="1">Savories & Buns</option>
                                        <option value="2">Breads</option>
                                        <option value="3">Sweet Foods</option>
                                        <option value="4">Vegetarian Foods</option>
                                        <option value="5">Drinks</option> -->
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="col-xs-12 col-sm-12 col-md-12">
                            <div class="row mb-3">
                                <label for="foodItemSubCategory" class="col-sm-3 col-form-label">Sub Category</label>
                                <div class="col-sm-9">
                                    <select class="form-select" aria-label="Default select example" id="foodItemSubCategory" name="foodItemSubCategory">
                                        <!-- <option selected value="">-- Select Sub Category --</option>
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
                                        <option value="5">Cakes</option> -->
                                    </select>
                                </div>
                            </div>
                            <div class="col-xs-12 col-sm-12 col-md-12">
                                <div class="row mb-3">
                                    <label for="foodItemImage" class="col-sm-3 col-form-label">Image</label>
                                    <div class="col-sm-9">
                                        <input class="form-control" type="file"  id="foodItemImage" name="foodItemImage" accept="image/png, image/jpg, image/jpeg" onchange="preview(this)">
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
                </form>
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
            <div class="modal-header text-light" style="background-color:#2f2e41;">
                <h5 class="modal-title">VIEW FOOD ITEM</h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div id="viewFoodItemContent"></div>
            </div>
            <!-- <div class="modal-footer"></div> -->
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
                                <label for="editFoodItemCategoryName" class="col-sm-3 col-form-label">Category</label>
                                <div class="col-sm-9">
                                    <select class="form-select" aria-label="Default select example" id="editFoodItemCategoryName" name="editFoodItemCategoryName">
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="col-xs-12 col-sm-12 col-md-12">
                            <div class="row mb-3">
                                <label for="editFoodItemSubCategory" class="col-sm-3 col-form-label">Sub Category</label>
                                <div class="col-sm-9">
                                    <select class="form-select" aria-label="Default select example" id="editFoodItemSubCategory" name="editFoodItemSubCategory">
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
                                <div class="col-3 float-end">&nbsp;
                                    </div>
                                    <div class="col-9 float-end">
                                        <img id="edit_food_pre_image">
                                    </div>
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
                </form>
            </div>
        </div>
    </div>
</div>
<!-- modal end -->


<!-- category -->
<!-- modal start -->
<!-- add category -->
<div class="modal fade" tabindex="-1" aria-labelledby="addCategory" id="addCategory" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-md">
        <div class="modal-content">
            <div class="modal-header text-light" style="background-color:#2f2e41;">
                <h5 class="modal-title"><i class="fad fa-list" style="margin-right: 10px;"></i>Add Category</h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="" method="post" role="form" id="categoryForm">
                    <div class="row">
                        <div class="col-xs-12 col-sm-12 col-md-12">
                            <div class="row mb-3">
                                <label for="categoryName" class="col-sm-3 col-form-label">Category Name</label>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control" id="categoryName" name="categoryName">
                                </div>
                            </div>
                        </div>

                        <div class="col-xs-12 col-sm-12 col-md-12">
                            <div class="float-end d-inline-flex">
                                <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Reset</button>
                                &nbsp;&nbsp;&nbsp;&nbsp;
                                <button type="button" id="categoryFormSubmit" class="btn btn-primary">Submit</button>
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
<!-- edit category -->
<div class="modal fade" tabindex="-1" aria-labelledby="editCategory" id="editCategory" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-md">
        <div class="modal-content">
            <div class="modal-header text-light" style="background-color:#2f2e41;">
                <h5 class="modal-title"><i class="fad fa-list" style="margin-right: 10px;"></i>Edit Category</h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
            <form action="" method="post" role="form" id="editCategoryForm">
                    <div class="row">
                        <div class="col-xs-12 col-sm-12 col-md-12">
                            <div class="row mb-3">
                                <label for="editCategoryName" class="col-sm-3 col-form-label">Category Name</label>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control" id="editCategoryName" name="editCategoryName">
                                </div>
                            </div>
                        </div>

                        <div class="col-xs-12 col-sm-12 col-md-12">
                            <div class="float-end d-inline-flex">
                                <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Reset</button>
                                &nbsp;&nbsp;&nbsp;&nbsp;
                                <input type="hidden" id="editCategoryId" name="editCategoryId">
                                <button type="button" id="editCategoryFormSubmit" class="btn btn-primary">Submit</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<!-- modal end -->


<!-- sub Category -->
<!-- add sub category -->
<!-- modal start  -->
<div class="modal fade" tabindex="-1" aria-labelledby="addSubCategory" id="addSubCategory" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-md">
        <div class="modal-content">
            <div class="modal-header text-light" style="background-color:#2f2e41;">
                <h5 class="modal-title"><i class="fad fa-list-ul fa-lg" style="margin-right: 10px;"></i>Add Sub Category</h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="" method="post" role="form" id="subCategoryForm">
                    <div class="row">
                        <div class="col-xs-12 col-sm-12 col-md-12">
                            <div class="row mb-3">
                                <label for="subCategoryName" class="col-sm-3 col-form-label">Sub Category Name</label>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control" id="subCategoryName" name="subCategoryName">
                                </div>
                            </div>
                        </div>
                        <div class="col-xs-12 col-sm-12 col-md-12">
                            <div class="row mb-3">
                                <label for="subCategoryCategoryItem" class="col-sm-3 col-form-label">Category Name</label>
                                <div class="col-sm-9">
                                    <select class="form-select" aria-label="Default select example" id="subCategoryCategoryItem" name="subCategoryCategoryItem">                                  
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="col-xs-12 col-sm-12 col-md-12">
                            <div class="float-end d-inline-flex">
                                <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Reset</button>
                                &nbsp;&nbsp;&nbsp;&nbsp;
                                <!-- <input type="hidden" id="subCategoryId" name="subCategoryId"> -->
                                <button type="button" id="subCategoryFormSubmit" class="btn btn-primary">Submit</button>
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
<!-- edit sub category -->
<div class="modal fade" tabindex="-1" aria-labelledby="editSubCategory" id="editSubCategory" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-md">
        <div class="modal-content">
            <div class="modal-header text-light" style="background-color:#2f2e41;">
                <h5 class="modal-title"><i class="fad fa-list-ul fa-lg" style="margin-right: 10px;"></i>Edit Sub Category</h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="" method="post" role="form" id="editSubCategoryForm">
                    <div class="row">
                        <div class="col-xs-12 col-sm-12 col-md-12">
                            <div class="row mb-3">
                                <label for="editSubCategoryName" class="col-sm-3 col-form-label">Sub Category Name</label>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control" id="editSubCategoryName" name="editSubCategoryName">
                                </div>
                            </div>
                        </div>
                        <div class="col-xs-12 col-sm-12 col-md-12">
                            <div class="row mb-3">
                                <label for="editSubCategoryCategoryItem" class="col-sm-3 col-form-label">Category Name</label>
                                <div class="col-sm-9">
                                    <select class="form-select" aria-label="Default select example" id="editSubCategoryCategoryItem" name="editSubCategoryCategoryItem">                                  
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="col-xs-12 col-sm-12 col-md-12">
                            <div class="float-end d-inline-flex">
                                <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Reset</button>
                                &nbsp;&nbsp;&nbsp;&nbsp;
                                <input type="hidden" id="editSubCategoryId" name="editSubCategoryId">
                                <button type="button" id="editSubCategoryFormSubmit" class="btn btn-primary">Submit</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<!-- modal end -->

<?php require_once "scriptInclude.php" ?>
<script>
    $(window).load(getFoodItemData(), getCategoryData() ,getSubCategoryData());
    // $(window).load();
</script>
<?php require_once "footer.php" ?>