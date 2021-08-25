<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <link rel="stylesheet" type="text/css" href="../../resources/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="../../resources/toastr/build/toastr.min.css">
    <link rel="stylesheet" type="text/css" href="../../resources/fontawesome/css/all.min.css" />
    <link rel="stylesheet" type="text/css" href="../../resources/DataTables/datatables.min.css" />
    <link rel="stylesheet" type="text/css" href="../../css/style.css" />
</head>
<!-- <style>
    .dropdown:hover .dropdown-menu {
        display: block;
        margin-left: -145px;
        margin-top: 10px;
    }

    .dropdown-menu {
        display: none;
        position: absolute;
    }
    .dropdown{
        position: relative;
        display: inline-block;
    }
</style> -->
<style>
    .sidebar-expanded::-webkit-scrollbar {
        display: none;
    }
    .sidebar-collapsed::-webkit-scrollbar {
        display: none;
    }
</style>

<body>
    <nav class="navbar navbar-inverse navbar-expand-md navbar-dark fixed-top py-0">
        <div class="container-fluid">
            <a class="navbar-brand" href="#">
                <img src="../../images/bootstrap-logo.svg" alt="" width="35px" height="30px" class="d-inline-block align-text-top">
                <span style="font-size: 0.9rem;" id="brandName">YASHODHA RESTAURANT</span>
            </a>

            <span style="font-size:1.35rem; cursor: pointer;" class="text-light" id="navBTN">
                <i class="far fa-bars"></i>
            </span>
            <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
                <li class="nav-item dropdown">
                    <a class="nav-link" data-bs-toggle="dropdown" href="#" role="button" aria-expanded="false" data-hover="dropdown">
                        <img src="../../images/user-images/1626898611.jpg" width="35px" height="35px" alt="profile-pic" class="rounded">
                    </a>
                    <ul class="dropdown-content dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">

                        <div class="card" style="width: 20rem;">
                            <img src="../../images/modern.jpg" class="card-img-top" alt="...">
                            <div class="card-body">
                                <li><a class="dropdown-item" href="#">Action</a></li>
                                <li><a class="dropdown-item" href="#">Another action</a></li>
                                <li>
                                    <hr class="dropdown-divider">
                                </li>
                                <li><a class="dropdown-item" href="#">Something else here</a></li>
                            </div>
                        </div>
                        <!-- <li><a class="dropdown-item" href="#">Action</a></li>
                        <li><a class="dropdown-item" href="#">Another action</a></li>
                        <li>
                            <hr class="dropdown-divider">
                        </li>
                        <li><a class="dropdown-item" href="#">Something else here</a></li> -->
                    </ul>
                </li>
            </ul>
        </div>
    </nav>
    <div class="container-fluid" style="margin-top: 3.1rem; padding:0">
        <div class="sidebar-expanded" id="sidebar">
            <nav class="navbar nav nav-pills navbar-dark flex-column align-items-stretch">
                <ul class="list-group" id="getModule">

                </ul>
            </nav>
        </div>

        <div id="content" class="content-expanded">
            <div class="card p-3 " style="height: 100vh; border-radius: 0.75rem;">
                <div class="card-body">
                    <div id="chart-container"></div>
                </div>
            </div>
        </div>
    </div>
    <script type="text/javascript" src="../../js/jquery-3.6.0.min.js"></script>
    <script type="text/javascript" src="../../resources/bootstrap/js/bootstrap.min.js"></script>
    <script type="text/javascript" src="../../js/validation.js"></script>
    <script type="text/javascript" src="../../resources/sweetalert.js"></script>
    <script type="text/javascript" src="../../resources/toastr/build/toastr.min.js"></script>
    <script type="text/javascript" src="../../resources/fontawesome/js/all.min.js"></script>
    <script type="text/javascript" src="../../resources/DataTables/datatables.min.js"></script>
    <script type="text/javascript" src="../../js/script.js"></script>
    <script type="text/javascript" src="../../resources/fusioncharts/js/fusioncharts.js"></script>
    <script type="text/javascript" src="../../resources/fusioncharts/js/themes/fusioncharts.theme.fusion.js"></script>
    <script type="text/javascript" src="../../js/chart.js"></script>

</body>

</html>