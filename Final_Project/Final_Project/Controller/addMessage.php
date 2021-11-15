<?php
require_once 'config.php';
require_once '../Model/database.php';
require_once '../Model/users.php';


session_start();

$uid = $_SESSION['uid'];
$toUser = $_GET['username'];
$message = trim($_POST['message']);


if (isset($_POST['submit'])) {
    if (!empty($message)) {
        $database = new Database();

        $arr = $database->usernameMessage("$toUser");          //to return the users info using username

        $senderID = $uid;
        $receiverID = $arr->getUid();

        $newChat = new chat(null, "$message", "$senderID", "$receiverID", "", "false", "message");

        $database->insertChat($newChat);         //insert new in table chat

        header("Location: ../View/chat.php?username={$toUser}");

    }else{
        $_SESSION['alert'] = "<script>alert('Enter a message to send!')</script>";
        header("Location: ../View/chat.php?username={$toUser}");
    }
}
