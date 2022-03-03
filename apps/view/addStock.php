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
            <form action="" method="post" role="form" id="addStockForm">
                <div class="row">
                    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-6">
                        <div class="row mb-3">
                            <label for="stockSupplierName" class="col-sm-3 col-form-label">Supplier Name</label>
                            <div class="col-sm-9">
                                <input list="stockSupplierNames" class="form-control" id="stockSupplierName" name="stockSupplierName">
                                <datalist id="stockSupplierNames" class="datalist"></datalist>
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
                </div>
                <div class="row mb-3">
                    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                        <button id="addRow" type="button" class="btn btn-dark float-end" style="background-color: #2f2e41;"><i class="far fa-plus"></i> NEW ROW</button>
                    </div>
                </div>
                <table id="table-stock">
                    <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Row Item Name</th>
                            <th scope="col">Mnf Date</th>
                            <th scope="col">Exp Date</th>
                            <th scope="col">Received Quantity(kg/l)</th>
                            <th scope="col">Cost Per Unit(Rs)</th>
                            <th scope="col">Net Cost(Rs)</th>
                        </tr>
                    </thead>
                    <tbody id="stockTbody">
                        <tr>
                            <th scope="row"></th>
                            <td>
                                <input list="stockRowItemNames" class="form-control" id="stockRowItemName" name="stockRowItemName">
                                <datalist class="datalist" id="stockRowItemNames"></datalist>
                            </td>
                            <td><input type="date" class="form-control"></td>
                            <td><input type="date" class="form-control"></td>
                            <td><input type="number" class="form-control"></td>
                            <td><input type="number" class="form-control"></td>
                            <td><input type="number" class="form-control"></td>
                        </tr>
                    </tbody>
                    <tfoot>
                        <tr>
                            <th scope="col" colspan="6" class="text-end">Total</th>
                            <th scope="col">Net Cost</th>
                        </tr>
                        <tr>
                            <th scope="col" colspan="6" class="text-end">Discount</th>
                            <th scope="col">Net Cost</th>
                        </tr>
                        <tr>
                            <th scope="col" colspan="6" class="text-end">Net Total</th>
                            <th scope="col">Net Cost</th>
                        </tr>
                    </tfoot>
                </table>
            </form>
        </div>
    </div>
</div>
<?php require_once "scriptInclude.php" ?>
<script>
    $(window).load(getSupplierData(), getRowItemData());
</script>
<?php require_once "footer.php" ?>