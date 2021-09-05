<?php
require_once "header.php";
require_once "sidebar.php";
?>
<div id="content" class="content-expanded">
    <div class="row row-cols-2 m-auto p-auto">
        <div class="col">
            <div class="row row-cols-2 m-auto p-auto">
                <div class="col ps-0">
                    <div id="colorCard" class="cardBlue mb-4">
                        <div class="card-body">
                            <h5 class="card-title">Card title</h5>
                            <p class="card-text">With supporting text below as a natural lead-in to additional content.</p>
                        </div>
                    </div>
                    <div id="colorCard" class="cardYellow">
                        <div class="card-body">
                            <h5 class="card-title">Card title</h5>
                            <p class="card-text">With supporting text below as a natural lead-in to additional content.</p>
                        </div>
                    </div>
                </div>
                <div class="col">
                    <div id="colorCard" class="cardPurple mb-4 ">
                        <div class="card-body">
                            <h5 class="card-title">Card title</h5>
                            <p class="card-text">With supporting text below as a natural lead-in to additional content.</p>
                        </div>
                    </div>
                    <div id="colorCard" class="cardGreen">
                        <div class="card-body">
                            <h5 class="card-title">Card title</h5>
                            <p class="card-text">With supporting text below as a natural lead-in to additional content.</p>
                        </div>
                    </div>
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
    <!-- <div>Available food</div>
    <div class="row mt-4">
        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
            <table class="table table-hover table-responsive-*">
                <thead class="table-primary">
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Name</th>
                        <th scope="col">Contact</th>
                        <th scope="col">Email</th>
                        <th scope="col">Address</th>
                        <th scope="col">Option</th>
                    </tr>
                </thead>
            </table>
        </div>
    </div> -->
</div>
<?php
require_once "scriptInclude.php";
require_once "footer.php";
?>