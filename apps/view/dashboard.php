<?php
require_once "header.php";
require_once "sidebar.php";
?>
<div id="content" class="content-expanded">
    <div class="row row-cols-2 m-auto p-auto">
        <div class="col">
            <div class="row row-cols-2 m-auto p-auto">
                <div class="col ps-0">                    
                        <a <?php if ($_SESSION['user']['role_role_id'] !=5 ) {?> href="../view/order.php" 
                    <?php } ?> class="text-decoration-none text-dark">
                            <div id="colorCard" class="cardBlue mb-4">
                                <div class="card-body">             
                                    <h5 class="card-title" id="newOrderCount">0</h5>
                                    <i class="far fa-utensils fa-lg"></i>
                                    <h6 class="card-text text-end">Orders</h6>
                                </div>
                            </div>
                        </a>

                    <a href="../view/delivery.php" class="text-decoration-none text-dark">
                        <div id="colorCard" class="cardYellow">
                            <div class="card-body">
                                <h5 class="card-title" id="pendingDeliveryCount">0</h5>
                                <i class="fad fa-motorcycle fa-lg"></i>
                                <h6 class="card-text text-end">Pending Delivery</h6>
                            </div>
                        </div>
                    </a>
                </div>
                <div class="col">
                    <a <?php if ($_SESSION['user']['role_role_id'] != 3 && $_SESSION['user']['role_role_id'] != 4 && $_SESSION['user']['role_role_id'] != 5){?> href="../view/invoice.php"
                        <?php } ?> class="text-decoration-none text-dark">
                        <div id="colorCard" class="cardPurple mb-4 ">
                            <div class="card-body">
                                <h5 class="card-title" id="todaySales">Rs.00.00</h5>
                                <i class="far fa-file-invoice-dollar fa-lg"></i>
                                <h6 class="card-text text-end">Today Revenue</h6>
                            </div>
                        </div>
                    </a>
                    <a <?php if ($_SESSION['user']['role_role_id'] != 4 && $_SESSION['user']['role_role_id'] != 5){?> href="../view/stock.php"
                        <?php } ?> class="text-decoration-none text-dark">
                        <div id="colorCard" class="cardGreen">
                            <div class="card-body">
                                <h5 class="card-title" id="lowLevelStockCount">0</h5>
                                <i class="fal fa-container-storage fa-lg"></i>
                                <h6 class="card-text text-end">Low Row Item Stock</h6>
                            </div>
                        </div>
                    </a>
                </div>
            </div>
        </div>
        <div class="col" style="padding-top: 3px;">
            <div class="card" style="width:auto; height:auto;  border-radius: 0.75rem">
                <div class="card-body" style="margin: auto;">
                    <div id="pieChart"></div>
                </div>
            </div>
        </div>
    </div>
    <!-- <div class="card p-3 mt-3" style="height: 100vh; border-radius: 0.75rem;">
        <div class="card-body">
            <div id="content-container">
            <div id="chart-container"></div>
        </div>
    </div> -->
    <div class="row row-cols-1 m-auto p-auto">
        <div class="col">
            <div class="card mt-4" style="border-radius:0.75rem;">
                <div class="card-body">
                    <div id="barChart"></div>
                </div>
            </div>
        </div>
    </div>
</div>
<?php
require_once "scriptInclude.php";
?>
<script>
    // $(window).load(lowStockCount());
    $( ".nav-link" ).addClass( "active" );
</script>
<?php
require_once "footer.php";
?>