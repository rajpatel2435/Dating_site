<?php
require_once 'config.php';
require_once '../Model/database.php';
require_once '../Model/users.php';


session_start();

$uid = $_SESSION['uid'];
$database = new Database();


$favUser = $_GET['username'];

$database = new Database();

$result = $database->profileUid("$uid");          //to return users info using the uid

$fav = $result->getFav();

$explodeFav = explode(" ", $fav);

if (!empty($explodeFav)) {
    $delArr = ["$favUser"];

    $receiver = $database->profileUsername("$favUser");                 //to return users info using the username

    $receiverID = $receiver->getUid();

    $newArr = array_diff($explodeFav, $delArr);

    $updatedFav = implode(" ", $newArr);

    $database->updateFav("$updatedFav", "$uid");                      //to update favorite list

    $newChat = new chat(null, "", "$uid", "$receiverID", "", "false", "removeFav");

    $database->insertChat($newChat);          //insert new in table chat


    $_SESSION['alert'] = "<script>alert('Successfully updated Favorite List!')</script>";
    header("Location: ../View/favorite.php");
}


