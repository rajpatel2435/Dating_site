<?php

session_start();




if (isset($_SESSION['uid'])) {
    header("Location: welcome.php");
}

if (isset($_SESSION['alert'])){
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

    <link rel="stylesheet" type="text/css" href="css/log-reg.css">

    <title>Login</title>
</head>
<body>
<div class="container">
    <h1 class="login-text">LOGIN</h1>
    <form action="../Controller/log-valid.php" method="POST">
        <div class="form-group row">
            <label for="username" class="col-sm-4 col-form-label">Username</label>
            <div class="col-sm-8">
                <input type="text" class="form-control" name="username" id="username" placeholder="<?php if (isset($_SESSION['username'])){ echo $_SESSION['username'];} ?>">
            </div>
        </div><br />
        <div class="form-group row">
            <label for="password" class="col-sm-4 col-form-label">Password</label>
            <div class="col-sm-8">
                <input type="password" class="form-control" name="password" id="password">
            </div>
        </div><br />
        <div class="form-group row">
            <button type="submit" name="submit" class="btn btn-primary">Login</button>
        </div><br />
        <p class="login-register-text">Don't have an account? <a href="register.php"><u>Register Here</u></a></p>
    </form>
</div>
</body>
</html>