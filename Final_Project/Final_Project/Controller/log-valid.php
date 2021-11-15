<?php

require_once 'config.php';
require_once '../Model/database.php';
require_once '../Model/users.php';

session_start();

error_reporting(0);


if (isset($_POST['submit'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];

    $database = new database();

    $result = $database->checkLogin($username,$password);                    //to check the username and password is right

    if (!empty($result)) {

        $_SESSION['uid'] = $result->getUid();
        $_SESSION['username'] = $result->getUsername();
        $_SESSION['email'] = $result->getEmail();
        $_SESSION['gender'] = $result->getGender();
        $_SESSION['age'] = $result->getAge();
        $_SESSION['city'] = $result->getCity();
        $_SESSION['membership'] = $result->getMembership();
        $_SESSION['bio'] = $result->getBio();
        $_SESSION['image'] = $result->getImage();
        $_SESSION['winks'] = $result->getWinks();
        header("Location: ../View/welcome.php");
    } else {
        $_SESSION['alert'] = "<script>alert('Whoops! Username or Password is Incorrect!')</script>";
        header("Location: ../View/login.php");
    }
}

?>
