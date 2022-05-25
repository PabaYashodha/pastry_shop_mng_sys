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

    .form-control-plaintext:focus {
        /* border: 0px solid #ffffff !important; */
        outline: none;
    }
</style>
<div id="content" class="content-expanded">
    <div class="card shadow-lg " style="border-radius: 10px; padding:0.4rem">
        <nav aria-label="breadcrumb" class="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="../view/dashboard.php" style="text-decoration: none; color:#2f2e41 !important"> HOME</a></li>
                <li class="breadcrumb-item"><a href="../view/stock.php" style="text-decoration: none; color:#2f2e41 !important">STOCK MANAGEMENT</a></li>
                <li class="breadcrumb-item active" aria-current="page">ADD STOCK RELEASE</li>

            </ol>
        </nav>
    </div>
    <div class="card shadow-lg mt-3" style="border-radius: 20px;" id="addStockRelease">
        <div class="card-body">
            <form action="" method="post" role="form" id="addStockReleaseForm">
                <div class="row">
                    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-6">
                        <div class="row mb-3">
                            <label for="stockReleaseDate" class="col-sm-3 col-form-label">Release Date</label>
                            <div class="col-sm-9">
                                <input type="date" class="form-control" id="stockReleaseDate" name="stockReleaseDate">
                            </div>
                        </div>
                    </div>
                    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-6">
                        <div class="row mb-3">
                            <label for="stockReleaseNo" class="col-sm-3 col-form-label">Stock Release No</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" id="stockReleaseNo" name="stockReleaseNo" readonly>
                            </div>
                        </div>
                    </div>
                    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-6">
                        <div class="row mb-3">
                            <label for="stockReleaseTo" class="col-sm-3 col-form-label">Release To</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" id="stockReleaseTo" name="stockReleaseTo">
                            </div>
                        </div>
                    </div>
                    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-6">
                        <div class="row mb-3">
                            <label for="stockReleaseMadeBy" class="col-sm-3 col-form-label">Release Made By</label>
                            <div class="col-sm-9">
                                <!-- <input type="text" class="form-control" id="stockReleaseMadeBy" name="stockReleaseMadeBy"> -->
                                <select class="form-select" aria-label="Default select example" id="stockReleaseMadeBy" name="stockReleaseMadeBy">
                                </select>
                            </div>
                        </div>
                    </div>
                </div>
                <hr>
                <div class="row">
                    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-6">
                        <div class="row mb-3">
                            <label for="stockReleaseRowItemNames" class="col-sm-3 col-form-label">Row Item Name</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" id="stockReleaseRowItemNames">
                                <input type="hidden" class="form-control" id="stockReleaseRowItemId">
                            </div>
                        </div>
                    </div>
                    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-6">
                        <div class="row mb-3">
                            <label for="stockReleaseQuantity" class="col-sm-3 col-form-label">Release Quantity</label>
                            <div class="col-sm-9">
                                <input type="number" class="form-control" id="stockReleaseQuantity">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row mb-3">
                    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                        <button id="addReleaseStockRow" type="button" class="btn btn-dark float-end" style="background-color: #2f2e41;"><i class="far fa-plus"></i> ADD</button>
                    </div>
                </div>
                <hr>
                <table class="table" id="table-stock">
                    <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Row Item Name</th>
                            <th scope="col">Quantity</th>
                        </tr>
                    </thead>
                    <tbody id="stockReleaseTbody">
                        <!-- <tr>
                            <th scope="row"></th>
                            <td>
                                <input list="stockRowItemNames" class="form-control" id="stockRowItemName0" name="stockRowItemName">
                                <datalist class="datalist" id="stockRowItemNames"></datalist>
                            </td>
                            <td><input id="stockMnfDate0" type="date" class="form-control"></td>
                            <td><input id="stockExpDate0" type="date" class="form-control"></td>
                            <td><input id="stockReceivedQuantity0" onkeyup=getStockNetCost(0) type="number" class="form-control"></td>
                            <td><input id="stockCostPerUnit0" onkeyup=getStockNetCost(0) type="number" class="form-control"></td>
                            <td><input id="stockNetCost0" readonly type="number" class="form-control"></td>
                        </tr> -->
                    </tbody>
                </table>
                <div class="col-xs-12 col-sm-12 col-md-12">
                    <div class="float-end d-inline-flex">
                        <button type="reset" class="btn btn-danger">Reset</button>
                        &nbsp;&nbsp;&nbsp;&nbsp;
                        <button type="button" id="stockReleaseFormSubmit" class="btn btn-primary">Submit</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
<?php require_once "scriptInclude.php" ?>
<script>
    $(window).load(getStockReleaseNumber(),getRoleData());
</script>
<?php require_once "footer.php" ?>