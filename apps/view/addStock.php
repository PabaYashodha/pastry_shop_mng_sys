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
                <li class="breadcrumb-item"><a href="../view/addStock.php"  style="text-decoration: none; color:#2f2e41 !important">STOCK MANAGEMENT</a></li>
                <li class="breadcrumb-item active" aria-current="page">ADD STOCK</li>

            </ol>
        </nav>
    </div>
    <div class="card shadow-lg mt-3" style="border-radius: 20px;">
        <div class="card-body">
            <form action="" method="post" role="form" id="addStockForm">
                <div class="row">
                    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-6">
                        <div class="row mb-3">
                            <label for="stockSupplierName" class="col-sm-3 col-form-label">Supplier Name</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" id="stockSupplierName" name="stockSupplierName">
                                <input type="hidden" class="form-control" id="stockSupplierId" name="stockSupplierId">
                            </div>
                        </div>
                    </div>
                    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-6">
                        <div class="row mb-3">
                            <label for="stockCreteDate" class="col-sm-3 col-form-label">Date</label>
                            <div class="col-sm-9">
                                <input type="date" class="form-control" id="stockCreteDate" name="stockCreteDate">
                            </div>
                        </div>
                    </div>
                    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-6">
                        <div class="row mb-3">
                            <label for="stockReferenceNumber" class="col-sm-3 col-form-label">Reference No</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" id="stockReferenceNumber" name="stockReferenceNumber">
                            </div>
                        </div>
                    </div>
                    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-6">
                        <div class="row mb-3">
                            <label for="stockGrnNumber" class="col-sm-3 col-form-label">Grn No</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" id="stockGrnNumber" name="stockGrnNumber" readonly>
                            </div>
                        </div>
                    </div>
                </div>
                <hr>
                <div class="row">
                    <div class="col-xs-12 col-sm-12 col-md-4 col-lg-4">
                        <div class="row mb-3">
                            <label for="stockRoItemNames" class="col-sm-3 col-form-label">Row Item Name</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" id="stockRowItemName">
                                <input type="hidden"  class="form-control" id="stockRowItemId">
                                
                            </div>
                        </div>
                    </div>
                    <div class="col-xs-12 col-sm-12 col-md-4 col-lg-4">
                        <div class="row mb-3">
                            <label for="stockMnfDate" class="col-sm-3 col-form-label">Mnf Date</label>
                            <div class="col-sm-9">
                                <input type="date" class="form-control" id="stockMnfDate">
                            </div>
                        </div>
                    </div>
                    <div class="col-xs-12 col-sm-12 col-md-4 col-lg-4">
                        <div class="row mb-3">
                            <label for="stockExpDate" class="col-sm-3 col-form-label">Exp Date</label>
                            <div class="col-sm-9">
                                <input type="date" class="form-control" id="stockExpDate">
                            </div>
                        </div>
                    </div>
                    <div class="col-xs-12 col-sm-12 col-md-4 col-lg-4">
                        <div class="row mb-3">
                            <label for="stockReceivedQuantity" class="col-sm-3 col-form-label">Received Quantity</label>
                            <div class="col-sm-9">
                                <input type="number" class="form-control" id="stockReceivedQuantity">
                            </div>
                        </div>
                    </div>
                    <div class="col-xs-12 col-sm-12 col-md-4 col-lg-4">
                        <div class="row mb-3">
                            <label for="stockCostPerUnit" class="col-sm-3 col-form-label">Cost Per Unit</label>
                            <div class="col-sm-9">
                                <input type="number" class="form-control" id="stockCostPerUnit">
                            </div>
                        </div>
                    </div>
                    <div class="col-xs-12 col-sm-12 col-md-4 col-lg-4">
                        <div class="row mb-3">
                            <label for="stockDiscount" class="col-sm-3 col-form-label">Discount (%)</label>
                            <div class="col-sm-9">
                                <input type="number" class="form-control" value="0" id="stockDiscount">
                            </div>
                        </div>
                    </div>
                    <div class="col-xs-12 col-sm-12 col-md-4 col-lg-4">
                        <div class="row mb-3">
                            <label for="stockNetCost" class="col-sm-3 col-form-label">Net Cost</label>
                            <div class="col-sm-9">
                                <input type="number" class="form-control" id="stockNetCost">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row mb-3">
                    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                        <button id="addRow" type="button" class="btn btn-dark float-end" style="background-color: #2f2e41;"><i class="far fa-plus"></i> ADD</button>
                    </div>
                </div>
                <hr>
                <table class="table" id="table-stock">
                    <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Row Item Name</th>
                            <th scope="col">Mnf Date</th>
                            <th scope="col">Exp Date</th>
                            <th scope="col">Received Quantity(kg/l)</th>
                            <th scope="col">Cost Per Unit(Rs)</th>
                            <th scope="col">Discount(%)</th>
                            <th scope="col">Net Cost(Rs)</th>
                        </tr>
                    </thead>
                    <tbody id="stockTbody">
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
                    <tfoot>
                        <tr>
                            <th scope="col" colspan="7" class="text-end">Total (Rs)</th>
                            <th scope="col"><input type="text" class="form-control-plaintext text-end" value="0.00" name="stockTotalCost" readonly id="stockTotalCost"></th>
                        </tr>
                        <tr>
                            <th scope="col" colspan="7" class="text-end">Discount (%)</th>
                            <th scope="col"><input type="text" class="form-control-plaintext text-end" value="0"  name="stockTotalDiscount" id="stockTotalDiscount"></th>
                        </tr>
                        <tr>
                            <th scope="col" colspan="7" class="text-end">Net Total (Rs)</th>
                            <th scope="col"><input type="text" class="form-control-plaintext text-end" value="0.00" readonly name="stockNetTotal" id="stockNetTotal"></th>
                        </tr>
                    </tfoot>
                </table>
                <div class="col-xs-12 col-sm-12 col-md-12">
                    <div class="float-end d-inline-flex">
                        <button type="reset" class="btn btn-danger">Reset</button>
                        &nbsp;&nbsp;&nbsp;&nbsp;
                        <button type="button" id="stockFormSubmit" class="btn btn-primary">Submit</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
<?php require_once "scriptInclude.php" ?>
<script>
    $(window).load(getRowItemData(), getGrnNumber());
</script>
<?php require_once "footer.php" ?>