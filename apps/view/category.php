<?php
require_once "header.php";
require_once "sidebar.php"
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
                    <button class="btn btn-dark float-end" data-bs-toggle="modal" data-bs-target="#addCategory"><i class="far fa-plus"></i> ADD CATEGORY</button>
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
    </div>
</div>

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
<?php require_once "scriptInclude.php" ?>

<?php require_once "footer.php" ?>