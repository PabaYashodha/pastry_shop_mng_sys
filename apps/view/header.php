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
    /* avoid sidebar scroll bar */
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
                <img src="../../images/download.png" alt="" width="40px" height="40px" class="d-inline-block align-text-top rounded-circle">
                <span style="font-size: 1.2rem;" id="brandName">MR.PAAN</span>
            </a>
            <span style="font-size:1.35rem; cursor: pointer;" class="text-light" id="navBTN">
                <i class="far fa-bars"></i>
            </span>
            <span><i class="fal fa-bell fa-lg text-white" style="margin-left: 66rem;"></i>
                <span class="position-absolute top-5 start-90 translate-middle badge rounded-pill bg-danger">0</span>
            </span>

            <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
                <li class="nav-item dropdown">
                    <a class="nav-link" data-bs-toggle="dropdown" href="#" role="button" aria-expanded="false" data-hover="dropdown">
                        <img src="../../images/user-images/1626898611.jpg" width="35px" height="35px" alt="profile-pic" class="rounded">
                    </a>
                    <ul class="dropdown-content dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                        <div class="card">
                            <div class="card-body">
                                <li><a class="dropdown-item" href="#">Action</a></li>
                                <li><a class="dropdown-item" href="">Logout</a></li>
                                <li><a class="dropdown-item" href="../view/passwordReset.php">Password Reset</a></li>
                            </div>
                        </div>
                    </ul>
                </li>
            </ul>
        </div>
    </nav>
    <div class="container-fluid" style="margin-top: 3.1rem; padding:0">