<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" type="text/css" href="../../resources/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="../../css/login.css">
    <link rel="stylesheet" type="text/css" href="../../resources/toastr/build/toastr.min.css">
    <link rel="stylesheet" type="text/css" href="../../resources/DataTables/datatables.min.css" />
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Fruktur&display=swap" rel="stylesheet">
    <style>
        input {
            outline: none;
        }
    </style>
</head>

<body>
    <div class="container">
        <div class="card shadow-lg">
            <div class="card-body">
                <form action="" method="post" role="form" id="loginForm">
                    <img src="../../images/undraw_male_avatar_323b.svg" height="100px" width="100px" class="loginAvatar">
                    <h2 class="text-center mt-3 mb-5" style="font-family: 'Fruktur', cursive;">...WELCOME...</h2>
                    <label for="username" class="form-label" style="color: #2f2e41;">Username :</label>
                    <input type="text" class="loginContent mb-3" id="username" name="username">
                    <label for="password" class="form-label" style="color: #2f2e41;">Password :</label>
                    <input type="password" class="loginContent mb-3" id="password" name="password">
                    <button type="button" class="btn w-100 mb-3 mt-3 text-light" id="userLogin" style="background-color: #2f2e41;">LOGIN</button>
                </form>
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
    <script type="text/javascript" src="../../js/chart.js"></script>
    <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/apexcharts"></script>

    <link rel="stylesheet" href="//code.jquery.com/ui/1.13.1/themes/base/jquery-ui.css">
    <script src="https://code.jquery.com/ui/1.13.1/jquery-ui.js"></script>
</body>

</html>