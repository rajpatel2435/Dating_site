<?php
require_once 'config.php';
require_once '../Model/database.php';
require_once '../Model/users.php';

error_reporting(0);

session_start();


if (isset($_POST['submit'])) {
    $username = htmlspecialchars($_POST['username']);
    $email = htmlspecialchars($_POST['email']);
    $password = htmlspecialchars($_POST['password']);
    $cpassword = htmlspecialchars($_POST['cpassword']);
    $gender = htmlspecialchars($_POST['gender']);
    $age = htmlspecialchars($_POST['age']);
    $city = htmlspecialchars($_POST['city']);
    $membership = htmlspecialchars($_POST['membership']);


    $database = new database();

    $checkUser = $database->checkUsername("$username");       //to check if username from the database if it already exists
    if (empty($checkUser)) {
        if ($password == $cpassword) {
            if ($age > 18 && $age < 100) {
                $result = $database->findUser("$email");         //find user using email
                if (empty($result)) {
                    $newUser = new users(null, "$username", "$email", "$password", "$gender", "$age", "$city", "$membership", "","","default.png", "0");
                    $database->insertUser($newUser);           // Add new user
                    if ($database) {
                        $_SESSION['alert'] = "<script>alert('Registration Successful! Please Login to continue!')</script>";
                        header("Location: ../View/index.php");

                        unset($_SESSION['password']);
                        unset($_SESSION['cpassword']);

                    } else {
                        $_SESSION['alert'] = "<script>alert('Whoops! Something Went Wrong!')</script>";
                        header("Location: ../View/register.php");
                    }
                } else {
                    $_SESSION['alert'] = "<script>alert('Whoops! Email Already Exists.')</script>";
                    header("Location: ../View/register.php");
                }

            } else {
                $_SESSION['alert'] = "<script>alert('Please enter a valid age!')</script>";
                header("Location: ../View/register.php");
            }
        } else {
            $_SESSION['alert'] = "<script>alert('Password Not Matched.')</script>";
            header("Location: ../View/register.php");
        }
    } else {
        $_SESSION['alert'] = "<script>alert('Username already taken!')</script>";
        header("Location: ../View/register.php");

    }

}
