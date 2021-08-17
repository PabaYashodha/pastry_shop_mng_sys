<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" type="text/css" href="../../resources/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="../../css/login.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Fruktur&display=swap" rel="stylesheet">
<style>
    input
{
    outline:none;
}
</style>
</head>

<body>
    <div class="container">
        <div class="card shadow-lg">
            <div class="card-body">
                <img src="../../images/undraw_male_avatar_323b.svg" height="100px" width="100px" class="loginAvatar">
                <h2 class="text-center mt-3 mb-5" style="font-family: 'Fruktur', cursive;">...WELCOME...</h2>
                <label for="username" class="form-label" style="color: #2f2e41;">Username :</label>
                <input type="text" class="loginContent mb-3" id="username">
                <label for="password" class="form-label" style="color: #2f2e41;">Password :</label>
                <input type="password" class="loginContent mb-3" id="password">
                <!-- <div class="input-div one">
                        <div class="i"><i class="fas fa-user"></i></div>
                        <div class="div"><h5> Username </h5><input type="text" class="input" id="username" name="username"></div>
                    </div>
                    <div class="input-div pass">
                        <div class="i"><i class="fas fa-lock"></i></div>
                        <div class="div"><h5> Password </h5><input type="password" class="input" id="password" name="password"></div>
                    </div> -->
                <button type="submit" class="btn w-100 mb-3 mt-3 text-light" id="userLogin" style="background-color: #2f2e41;" onclick="login">LOGIN</button>
            </div>
        </div>

    </div>
    <script type="text/javascript" src="../../js/jquery-3.6.0.min.js"></script>
    <script type="text/javascript" src="../../resources/bootstrap/js/bootstrap.min.js"></script>
    <script type="text/javascript" src="../../js/validation.js"></script>
</body>

</html>