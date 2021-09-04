<?php 
require_once "header.php";
require_once "sidebar.php";
?>
<div id="content" class="content-expanded">
    <div class="row row-cols-1 row-cols-md-2 g-2">
        <div class="col">
            <div class="row">
                <div class="card  me-4 ms-4 mt-3 mb-3 " style="width: 15rem; height: 9rem; background: linear-gradient(to bottom left, #0099ff 0%, #ffffff 100%); border:none">
                    <div class="card-body">
                        <h5 class="card-title">Card title</h5>
                        <p class="card-text">With supporting text below as a natural lead-in to additional content.</p>
                    </div>
                </div>
                <div class="card mt-3 mb-3" style="width: 15rem;height: 9rem; background: linear-gradient(to top right, #ffcd6b 0%, #ffffff 100%); border:none">
                    <div class="card-body">
                        <h5 class="card-title">Card title</h5>
                        <p class="card-text">With supporting text below as a natural lead-in to additional content.</p>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="card me-4 ms-4 mt-3 mb-3" style="width: 15rem;height: 9rem;  background: linear-gradient(to bottom right, #a897e1 0%, #ffffff 100%); border:none">
                    <div class="card-body">
                        <h5 class="card-title">Card title</h5>
                        <p class="card-text">With supporting text below as a natural lead-in to additional content.</p>
                    </div>
                </div>
                <div class="card  mt-3 mb-3 " style="width: 15rem;height: 9rem;  background: linear-gradient(to top right, #4cecb6 0%, #ffffff 100%); border:none">
                    <div class="card-body">
                        <h5 class="card-title">Card title</h5>
                        <p class="card-text">With supporting text below as a natural lead-in to additional content.</p>
                    </div>
                </div>
            </div>
        </div>
        <div class="col">
            <div class="card m-3" style="width:30rem; height:18rem">
                <div class="card-body">
                    <div id="chart"></div>
                </div>
            </div>
        </div>
    </div>
    <div class="card p-3 mt-3" style="height: 100vh; border-radius: 0.75rem;">
        <div class="card-body">
            <!-- <div id="content-container"> -->
            <div id="chart-container"></div>
        </div>
    </div>
    <div style="font-size: 1.75rem;">Available Foods</div>
    <div class="row mt-4">
        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
            <table class="table  table-hover table-responsive-*" id="dataTable">
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
    </div>
</div>
<?php 
require_once "scriptInclude.php";
require_once "footer.php";
?>