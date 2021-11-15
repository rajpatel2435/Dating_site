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

    <title>Register</title>
</head>
<body>
<div class="container">

    <h1 class="login-text">Create Account</h1>

    <form action="../Controller/reg-valid.php" method="POST">
        <div class="form-group row">
            <label for="username" class="col-sm-4 col-form-label">Username</label>
            <div class="col-sm-8">
                <input type="text" class="form-control" name="username" id="username" placeholder="<?php if (isset($_SESSION['username'])){ echo $_SESSION['username'];} ?>">
            </div>
        </div>
        <div class="form-group row">
            <label for="email" class="col-sm-4 col-form-label">Email</label>
            <div class="col-sm-8">
                <input type="email" class="form-control" name="email" id="email" placeholder="<?php if (isset($_SESSION['email'])){ echo $_SESSION['email'];} ?>">
            </div>
        </div>
        <div class="form-group row">
            <label for="password" class="col-sm-4 col-form-label">Password</label>
            <div class="col-sm-8">
                <input type="password" class="form-control" name="password" id="password">
            </div>
        </div>
        <div class="form-group row">
            <label for="cpassword" class="col-sm-4 col-form-label">Confirm Password</label>
            <div class="col-sm-8">
                <input type="password" class="form-control" name="cpassword" id="cpassword">
            </div>
        </div>
        <div class="form-group row">
            <label for="gender" class="col-sm-4 col-form-label">Gender</label>
            <div class="col-sm-8">
                <select class="form-control" name="gender" id="gender">
                    <option value="male">Male</option>
                    <option value="female">Female</option>
                    <option value="other">Other</option>
                </select>
            </div>
        </div>
        <div class="form-group row">
            <label for="age" class="col-sm-4 col-form-label">Age</label>
            <div class="col-sm-8">
                <input type="number" class="form-control" name="age" id="age">
            </div>
        </div>
        <div class="form-group row">
            <label for="city" class="col-sm-4 col-form-label">City</label>
            <div class="col-sm-8">
                <input type="text" class="form-control" name="city" id="city">
            </div>
        </div>
        <fieldset class="form-group">
            <div class="row">
                <legend class="col-form-label col-sm-4 pt-0">Membership</legend>
                <div class="col-sm-8">
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="membership" id="guest" value="guest" checked>
                        <label class="form-check-label" for="guest">
                            Guest
                        </label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="membership" id="regular" value="regular">
                        <label class="form-check-label" for="regular">
                            Regular
                        </label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="membership" id="premium" value="premium">
                        <label class="form-check-label" for="premium">
                            Premium
                        </label>
                    </div>
                </div>
            </div>
        </fieldset>
        <div class="form-group row">
                <button type="submit" name="submit" class="btn btn-primary">Register</button>
        </div><br />
    </form>
    <p class="login-register-text">Already have an account? <a href="login.php"><u>Login Here</u></a></p>
</div>
</body>
</html>