<?php

require_once 'config.php';
require_once '../Model/database.php';
require_once '../Model/users.php';

error_reporting(0);

session_start();

$uid = $_SESSION['uid'];
$username = $_POST['username'];

if (isset($_POST['submit'])) {
    if ($_FILES['image']['error'] != 4) {
        $bio = trim($_POST['bio']);
        $image = $_FILES['image'];
        $imageName = "{$uid}profile.png";

        $allowedImg = array(IMAGETYPE_PNG);
        $givenImg = exif_imagetype($image['tmp_name']);
        $foundInAllowedTypes = in_array($givenImg, $allowedImg);

        if ($foundInAllowedTypes) {
            $dir = scandir("../View/images/profile-pic/");

            foreach ($dir as $item) {
                if ($item == $imageName) {
                    unlink("$imageName");
                }
            }

            move_uploaded_file($image['tmp_name'], './../View/images/profile-pic/' . $uid . 'profile.png');

            $database = new database();

            $database->updateRegular("$bio", "$imageName", "$uid");               //to update photo and bio in the users

            $_SESSION['bio'] = $bio;

            $_SESSION['alert'] = "<script>alert('Profile Updated Successfully!')</script>";
            header("Location: ../View/profile.php?uid=$uid");
        } else {
            $_SESSION['alert'] = "<script>alert('Image Type Not Allowed!')</script>";
            header("Location: ../View/profile.php?uid=$uid");
        }
    } else {
        $_SESSION['alert'] = "<script>alert('Please select a file to upload')</script>";
        header("Location: ../View/profile.php?uid=$uid");
    }
}

