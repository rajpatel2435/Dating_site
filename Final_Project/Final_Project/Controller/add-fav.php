<?php
require_once 'config.php';
require_once '../Model/database.php';
require_once '../Model/users.php';


session_start();

$uid = $_SESSION['uid'];
$database = new Database();

$foundUser = $database->profileUid("$uid");       //to return users info using the uid
$membership = $foundUser->getMembership();

if ($membership == 'premium') {

    $favUser = $_GET['username'];

    $database = new Database();

    $result = $database->profileUid("$uid");             //to return users info using the uid

    $fav = $result->getFav();

    $explodeFav = explode(" ", $fav);

    foreach ($explodeFav as $value) {
        if ($value == $favUser) {
            $toAdd = false;
        } else {
            $toAdd = true;
        }
    }

    if ($toAdd) {
        array_push($explodeFav, "$favUser");

        $receiver = $database->profileUsername("$favUser");                //to return users info using the username

        $receiverID = $receiver->getUid();

        $updatedFav = implode(" ", $explodeFav);

        $database->updateFav("$updatedFav", "$uid");        //to update favorite list

        $newChat = new chat(null, "", "$uid", "$receiverID", "", "false", "addFav");

        $database->insertChat($newChat);     //insert new in table chat

        $_SESSION['alert'] = "<script>alert('Successfully Added to Favorite List!')</script>";
        header("Location: ../View/welcome.php");
    }else{
        $_SESSION['alert'] = "<script>alert('User already in your Favorite List!')</script>";
        header("Location: ../View/welcome.php");

    }

} else {
    $_SESSION['alert'] = "<script>alert('You must be Premium User to use Favorite List!')</script>";
    header("Location: ../View/welcome.php");
}


