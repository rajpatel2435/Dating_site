<?php

session_start();

if (isset($_SESSION['uid'])) {
    header("Location: welcome.php");
}

if (isset($_SESSION['alert'])) {
    echo $_SESSION['alert'];
    unset($_SESSION['alert']);
}

?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/css/bootstrap.min.css" rel="stylesheet"
          integrity="sha384-eOJMYsd53ii+scO/bJGFsiCZc+5NDVN2yr8+0RDqr0Ql0h+rP48ckxlpbzKgwra6" crossorigin="anonymous">


    <link rel="stylesheet" href="css/main.css">

    <title>Welcome</title>
</head>
<body>


<div class="welcome">
    <div class="info">
        <p id="info-p" style="">Welcome to Winks!</p>
        <p>Join now to meet new and amazing people online!</p>
    </div>
</div>


<div class="container">
    <div class="all">
        <div class="login-left">
            <div class="diff">
                <p>Login into Your Account!</p><br/>
                <a class="btn btn-primary" href="login.php" role="button">Login</a><br />
            </div>
        </div>
        <hr/>
        <div class="register-right">
            <div class="diff">
                <p>Register and start interacting with new people!</p><br/>
                <a class="btn btn-primary" href="register.php" role="button">Register</a><br />
            </div>
        </div>
    </div>
</div>

</body>
</html>