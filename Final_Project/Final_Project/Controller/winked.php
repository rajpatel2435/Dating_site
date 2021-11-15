<?php
require_once 'config.php';
require_once '../Model/database.php';
require_once '../Model/users.php';
require_once '../Model/chat.php';

error_reporting(0);

session_start();

$uid = $_SESSION['uid'];

$winkUid = $_GET['uid'];
$database = new Database();

$foundUser = $database->profileUid("$uid");        //to return users info using the uid
$membership = $foundUser->getMembership();

if ($membership == 'premium'){

    $database = new database();
    $result = $database->profileUid("$winkUid");            //to return users info using the uid
    $winks = $result->getWinks();
    $winkUser = $result->getUsername();

    $newChat = new chat(null, "", "$uid", "$winkUid", "", "false", "wink");


    $database->insertChat($newChat);       //insert new in table chat

    $winks += 1;

    $database->winkMe("$winks","$winkUid");           //add new wink to the user


    $_SESSION['alert'] = "<script>alert('You winked at $winkUser!')</script>";
    header("Location: ../View/welcome.php");


}else{
    $_SESSION['alert'] = "<script>alert('Only Premium user can Wink!')</script>";
    header("Location: ../View/welcome.php");
}
