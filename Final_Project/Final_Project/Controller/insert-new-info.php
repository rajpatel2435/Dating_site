<?php
require_once 'config.php';
require_once '../Model/database.php';
require_once '../Model/users.php';

error_reporting(0);

session_start();

$uid = $_SESSION['uid'];


if (isset($_POST['submit'])) {
    $username = htmlspecialchars(trim($_POST['username']));
    $email = htmlspecialchars(trim($_POST['email']));
    $password = htmlspecialchars(trim($_POST['password']));
    $cpassword = htmlspecialchars(trim($_POST['cpassword']));
    $gender = htmlspecialchars(trim($_POST['gender']));
    $age = htmlspecialchars(trim($_POST['age']));
    $city = htmlspecialchars(trim($_POST['city']));
    $membership = htmlspecialchars(trim($_POST['membership']));

    $database = new database();

    if ($username != $_SESSION['username']) {
        $checkUser = $database->checkUsername("$username");           //to check username from the database if it already exists
        if (empty($checkUser)) {
            if ($age > 18 && $age < 100) {
                $database->updateInfo("$uid", "$username","$email", "$gender", "$age", "$city", "$membership");          //to update new info in users

                $_SESSION['username'] = $username;
                $_SESSION['email'] = $email;
                $_SESSION['gender'] = $gender;
                $_SESSION['membership'] = $membership;


                $_SESSION['alert'] = "<script>alert('Profile Updated Successfully!')</script>";
                header("Location: ../View/profile.php?uid=$uid");


            } else {
                $_SESSION['alert'] = "<script>alert('Please enter a valid age!')</script>";
                header("Location: ../View/profile.php?uid=$uid");
            }

        } else {
            $_SESSION['alert'] = "<script>alert('Username already taken!')</script>";
            header("Location: ../View/profile.php?uid=$uid");
        }

    } else {
        if ($age > 18 && $age < 100) {
            $database->updateInfo("$uid", "$username","$email", "$gender", "$age", "$city", "$membership");         //to update new info in users

            print_r($database);
            $_SESSION['alert'] = "<script>alert('Profile Updated Successfully!')</script>";
            header("Location: ../View/profile.php?uid=$uid");

        }

    }
}

?>

