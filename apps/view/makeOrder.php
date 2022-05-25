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
                <li class="breadcrumb-item"><a href="../view/order.php" style="text-decoration: none; color:#2f2e41 !important">ORDER MANAGEMENT</a></li>
                <li class="breadcrumb-item active" aria-current="page">MAKE AN ORDER</li>
            </ol>
        </nav>
    </div>
    <div class="card shadow-lg mt-3" style="border-radius: 20px;" id="makeOrder">
        <div class="card-body">
            <form action="" method="post" role="form" id="makeOrderForm">
                <div class="row">
                    
                    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-6">
                        <div class="row mb-3">
                            <label for="invoiceFoodItemName" class="col-sm-3 col-form-label">Food Item Name</label>
                            <div class="col-sm-9">
                            <input type="hidden" class="form-control" id="invoiceFoodItemId" name="invoiceFoodItemId" >
                                <input type="text" class="form-control" id="invoiceFoodItemName" name="invoiceFoodItemName">
                            </div>
                        </div>
                    </div>
                    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-6">
                        <div class="row mb-3">
                            <label for="invoiceFoodItemUnitPrice" class="col-sm-3 col-form-label">Unit Price</label>
                            <div class="col-sm-9">
                                <input type="number" class="form-control" id="invoiceFoodItemUnitPrice" name="invoiceFoodItemUnitPrice"  readonly>
                            </div>
                        </div>
                    </div>
                    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-6">
                        <div class="row mb-3">
                            <label for="invoiceFoodItemQuantity" class="col-sm-3 col-form-label">Quantity</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" id="invoiceFoodItemQuantity" name="invoiceFoodItemQuantity">
                            </div>
                        </div>
                    </div>
                    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-6">
                        <div class="row mb-3">
                            <label for="invoiceDiscount" class="col-sm-3 col-form-label">Discount (%)</label>
                            <div class="col-sm-9">
                                <input type="number" class="form-control" id="invoiceDiscount" name="invoiceDiscount" value="0">
                            </div>
                        </div>
                    </div>
                    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-6">
                        <div class="row mb-3">
                            <label for="invoiceTotal" class="col-sm-3 col-form-label">Total</label>
                            <div class="col-sm-9">
                                <input type="number" class="form-control" id="invoiceTotal" name="invoiceTotal">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row mb-3">
                    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                        <button id="addItem" type="button" class="btn btn-dark float-end" style="background-color: #2f2e41;"><i class="far fa-plus"></i> ADD</button>
                    </div>
                </div>
                <hr>
                <table class="table" id="table-invoice">
                <thead>
                        <tr>
                            <th scope="col"></th>
                            <th scope="col">#</th>
                            <th scope="col">Food Item Name</th>
                            <th scope="col">Unit Price</th>
                            <th scope="col">Quantity</th>
                            <th scope="col">Discount</th>
                            <th scope="col">Total</th>
                        </tr>
                    </thead>
                    <tbody id="manualOrderTbody"></tbody>
                    <tfoot>
                    <tr>
                            <th scope="col" colspan="6" class="text-end">Sub Amount (Rs)</th>
                            <th scope="col"><input type="text" class="form-control-plaintext text-end" value="0.00" name="invoiceSubAmount" readonly id="invoiceSubAmount"></th>
                        </tr>
                        <tr>
                            <th scope="col" colspan="6" class="text-end">Discount (%)</th>
                            <th scope="col"><input type="text" class="form-control-plaintext text-end" value="0" name="invoiceTotalDiscount" id="invoiceTotalDiscount"></th>
                        </tr>
                        <tr>
                            <th scope="col" colspan="6" class="text-end">Net Total (Rs)</th>
                            <th scope="col"><input type="text" class="form-control-plaintext text-end" value="0.00" readonly name="invoiceNetTotal" id="invoiceNetTotal"></th>
                        </tr>
                        <tr>
                            <th scope="col" colspan="6" class="text-end">Received Amount (Rs)</th>
                            <th scope="col"><input type="text" class="form-control-plaintext text-end" value="0.00"  name="invoiceReceivedAmount" id="invoiceReceivedAmount"></th>
                        </tr>
                        <tr>
                            <th scope="col" colspan="6" class="text-end">Balance Amount (Rs)</th>
                            <th scope="col"><input type="text" class="form-control-plaintext text-end" value="0.00" readonly name="invoiceBalanceAmount" id="invoiceBalanceAmount"></th>
                        </tr>
                    </tfoot>
                </table>
                <div class="col-xs-12 col-sm-12 col-md-12">
                    <div class="float-end d-inline-flex">
                        <button type="reset" class="btn btn-danger">Reset</button>
                        &nbsp;&nbsp;&nbsp;&nbsp;
                        <button type="button" id="invoiceSubmit" class="btn btn-primary">Submit</button>
                    </div>
                </div>
            </form>
        </div>
    </div>

</div>


<?php require_once "scriptInclude.php" ?>
<script>
$(window).load();
</script>
<?php require_once "footer.php" ?>