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
                <li class="breadcrumb-item active" aria-current="page">REPORTS</li>
            </ol>
        </nav>
    </div>
    <div class="card shadow-lg mt-3" style="border-radius: 20px;">
    
    <div class="card-body">
        <!--        content  -->
        <div class="row">
            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                <div class="card">
                    <div class="card-body">
                        <ul class="list-unstyled">
                            <!-- sales report -->
                            <a class="btn d-inline report" style="font-size: 20px" data-toggle="tooltip" title="Sales Report" data-placement="bottom"><i class="fad fa-folder text-primary icon" style="font-size: 40px"></i> &nbsp; &nbsp; Sales Reports</a>
                            <ul class="list-unstyled d-none">
                                <br>
                                <li class="d-inline">
                                    <a href="../../reports/salesDayReport.php" target="_blank" class="btn border-0 text-info" data-toggle="tooltip" title="Today full details report " data-placement="bottom">
                                        <i class="fad fa-file-chart-line" style="font-size: 40px"></i> <br><br> Today
                                    </a> &nbsp; &nbsp;
                                </li>
                                <li class="d-inline">
                                    <a href="../../reports/salesWeekReport.php" target="_blank" class="btn border-0 text-info" data-toggle="tooltip" title="Yesterday to seven days back report" data-placement="bottom">
                                        <i class="fad fa-file-chart-line" style="font-size: 40px"></i> <br><br> Last 7 Days
                                    </a> &nbsp; &nbsp;
                                </li>
                                <li class="d-inline">
                                    <a href="../../reports/salesMonthReport.php" target="_blank" class="btn border-0 text-info" data-toggle="tooltip" title="last Month report" data-placement="bottom">
                                        <i class="fad fa-file-chart-line" style="font-size: 40px"></i> <br><br> Last Month
                                    </a> &nbsp; &nbsp;
                                </li>
                                <!-- <li class="d-inline">
                                    <a href="../../reports/salesMostProductOnline.php" target="_blank" class="btn border-0 text-info" data-toggle="tooltip" title="last Month report" data-placement="bottom">
                                        <i class="fad fa-file-chart-line" style="font-size: 40px"></i> <br><br> Most selling Product <br>(Online)
                                    </a> &nbsp; &nbsp;
                                </li>
                                <li class="d-inline">
                                    <a href="../../reports/salesMostProductPOS.php" target="_blank" class="btn border-0 text-info" data-toggle="tooltip" title="last Month report" data-placement="bottom">
                                        <i class="fad fa-file-chart-line" style="font-size: 40px"></i> <br><br> Most selling Product <br>(POS)
                                    </a> &nbsp; &nbsp;
                                </li> -->
                                <li class="d-inline">
                                    <span data-toggle="modal" data-target="#CustomeEvModal">
                                        <a class="btn border-0 text-info" data-toggle="tooltip" title="Customized report" data-placement="bottom">
                                            <i class="fad fa-file-chart-line" style="font-size: 40px"></i> <br><br> Customized
                                        </a>
                                    </span> &nbsp; &nbsp;
                                </li>
                            </ul>
                        </ul>
<!-- online order reports -->
                        <ul class="list-unstyled">
                            <a class="btn d-inline report" style="font-size: 20px" ><i class="fad fa-folder text-primary icon" style="font-size: 40px"></i> &nbsp; &nbsp; Order Reports (Online)</a>
                            <ul class="list-unstyled d-none">
                                <br>
                                <li class="d-inline">
                                    <a href="../../reports/orderDayReport.php" target="_blank" class="btn border-0 text-info" data-toggle="tooltip" title="Today full details report " data-placement="bottom">
                                        <i class="fad fa-file-chart-line" style="font-size: 40px"></i> <br><br> Today
                                    </a> &nbsp; &nbsp;
                                </li>
                                <li class="d-inline">
                                    <a href="../../reports/orderWeekReport.php" target="_blank" class="btn border-0 text-info" data-toggle="tooltip" title="Yesterday to seven days back report" data-placement="bottom">
                                        <i class="fad fa-file-chart-line" style="font-size: 40px"></i> <br><br> Last 7 Days
                                    </a> &nbsp; &nbsp;
                                </li>
                                <li class="d-inline">
                                    <a href="../../reports/orderMonthReport.php" target="_blank" class="btn border-0 text-info" data-toggle="tooltip" title="last Month report" data-placement="bottom">
                                        <i class="fad fa-file-chart-line" style="font-size: 40px"></i> <br><br> Last Month
                                    </a> &nbsp; &nbsp;
                                </li>
                                <li class="d-inline">
                                    <span data-toggle="modal" data-target="#CustomeOrderModal">
                                        <a class="btn border-0 text-info" data-toggle="tooltip" title="Customized report" data-placement="bottom">
                                            <i class="fad fa-file-chart-line" style="font-size: 40px"></i> <br><br> Customized
                                        </a>
                                    </span> &nbsp; &nbsp;
                                </li>
                            </ul>
                        </ul>
                        <!-- stock report -->
                        <ul class="list-unstyled">
                            <a class="btn d-inline report" style="font-size: 20px" ><i class="fad fa-folder text-primary icon" style="font-size: 40px"></i> &nbsp; &nbsp; Stock Reports</a>
                            <ul class="list-unstyled d-none">
                                <br>
                                <li class="d-inline">
                                    <a href="../../reports/stockAvailReport.php" target="_blank" class="btn border-0 text-info" data-toggle="tooltip" title="Today full details report " data-placement="bottom">
                                        <i class="fad fa-file-chart-line" style="font-size: 40px"></i> <br><br> Available Stock
                                    </a> &nbsp; &nbsp;
                                </li>
                                <li class="d-inline">
                                    <a href="../../reports/stockOutOfReport.php" target="_blank" class="btn border-0 text-info" data-toggle="tooltip" title="Yesterday to seven days back report" data-placement="bottom">
                                        <i class="fad fa-file-chart-line" style="font-size: 40px"></i> <br><br> Out Of Stock
                                    </a> &nbsp; &nbsp;
                                </li>
                                <li class="d-inline">
                                    <span data-toggle="modal" data-target="#CustomeStockModal">
                                        <a class="btn border-0 text-info" data-toggle="tooltip" title="Customized report" data-placement="bottom">
                                            <i class="fad fa-file-chart-line" style="font-size: 40px"></i> <br><br> Customized
                                        </a>
                                    </span> &nbsp; &nbsp;
                                </li>
                            </ul>
                        </ul>
                        <!-- grn report -->
                        <ul class="list-unstyled">
                            <a class="btn d-inline report" style="font-size: 20px" ><i class="fad fa-folder text-primary icon" style="font-size: 40px"></i> &nbsp; &nbsp; GRN Reports</a>
                            <ul class="list-unstyled d-none">
                                <br>
                                <li class="d-inline">
                                    <a href="../../reports/grnDailyReport.php" target="_blank" class="btn border-0 text-info" data-toggle="tooltip" title="Today full details report " data-placement="bottom">
                                        <i class="fad fa-file-chart-line" style="font-size: 40px"></i> <br><br> Today
                                    </a> &nbsp; &nbsp;
                                </li>
                                <li class="d-inline">
                                    <a href="../../reports/grnLastWeekReport.php" target="_blank" class="btn border-0 text-info" data-toggle="tooltip" title="Yesterday to seven days back report" data-placement="bottom">
                                        <i class="fad fa-file-chart-line" style="font-size: 40px"></i> <br><br> Last 7 Days
                                    </a> &nbsp; &nbsp;
                                </li>
                                <li class="d-inline">
                                    <a href="../../reports/grnLastMonthReport.php" target="_blank" class="btn border-0 text-info" data-toggle="tooltip" title="last Month report" data-placement="bottom">
                                        <i class="fad fa-file-chart-line" style="font-size: 40px"></i> <br><br> Last Month
                                    </a> &nbsp; &nbsp;
                                </li>
                                <li class="d-inline">
                                    <span data-toggle="modal" data-target="#CustomeGRNModal">
                                        <a class="btn border-0 text-info" data-toggle="tooltip" title="Customized report" data-placement="bottom">
                                            <i class="fad fa-file-chart-line" style="font-size: 40px"></i> <br><br> Customized
                                        </a>
                                    </span> &nbsp; &nbsp;
                                </li>
                            </ul>
                        </ul>
                        <ul class="list-unstyled">
                            <a class="btn d-inline report" style="font-size: 20px" ><i class="fad fa-folder text-primary icon" style="font-size: 40px"></i> &nbsp; &nbsp; Delivery Reports</a>
                            <ul class="list-unstyled d-none">
                                <br>
                                <li class="d-inline">
                                    <a href="../../reports/deliveryReadyReport.php" target="_blank" class="btn border-0 text-info" data-toggle="tooltip" title="Today full details report " data-placement="bottom">
                                        <i class="fad fa-file-chart-line" style="font-size: 40px"></i> <br><br> Ready to Delivery
                                    </a> &nbsp; &nbsp;
                                </li>
                                <li class="d-inline">
                                    <a href="../../reports/deliveryShippedReport.php" target="_blank" class="btn border-0 text-info" data-toggle="tooltip" title="Yesterday to seven days back report" data-placement="bottom">
                                        <i class="fad fa-file-chart-line" style="font-size: 40px"></i> <br><br> Shipped
                                    </a> &nbsp; &nbsp;
                                </li>
                                <li class="d-inline">
                                    <a href="../../reports/deliveryDeliveredReport.php" target="_blank" class="btn border-0 text-info" data-toggle="tooltip" title="last Month report" data-placement="bottom">
                                        <i class="fad fa-file-chart-line" style="font-size: 40px"></i> <br><br> Delivered (Today)
                                    </a> &nbsp; &nbsp;
                                </li>
                                <li class="d-inline">
                                    <span data-toggle="modal" data-target="#CustomeDeliveryModal">
                                        <a class="btn border-0 text-info" data-toggle="tooltip" title="Customized report" data-placement="bottom">
                                            <i class="fad fa-file-chart-line" style="font-size: 40px"></i> <br><br> Customized
                                        </a>
                                    </span> &nbsp; &nbsp;
                                </li>
                            </ul>
                        </ul>
                        <ul class="list-unstyled">
                            <a class="btn d-inline report" style="font-size: 20px" ><i class="fad fa-folder text-primary icon" style="font-size: 40px"></i> &nbsp; &nbsp; Other Reports</a>
                            <ul class="list-unstyled d-none">
                                <br>
                                <li class="d-inline">
                                    <a href="../../reports/employeeReport.php" target="_blank" class="btn border-0 text-info" data-toggle="tooltip" title="Today full details report " data-placement="bottom">
                                        <i class="fad fa-file-chart-line" style="font-size: 40px"></i> <br><br> Employee
                                    </a> &nbsp; &nbsp;
                                </li>
                                <li class="d-inline">
                                    <a href="../../reports/supplierReport.php" target="_blank" class="btn border-0 text-info" data-toggle="tooltip" title="Yesterday to seven days back report" data-placement="bottom">
                                        <i class="fad fa-file-chart-line" style="font-size: 40px"></i> <br><br> Supplier
                                    </a> &nbsp; &nbsp;
                                </li>
                            </ul>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
</div>
    </div>

</div>
<?php require_once "scriptInclude.php" ?>
<?php require_once "footer.php" ?>