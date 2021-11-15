<?php

require_once '../Controller/config.php';
require_once '../Model/database.php';
require_once '../Model/users.php';

session_start();

if (!isset($_SESSION['uid'])) {
    header("Location: index.php");
}

if (isset($_SESSION['alert'])) {
    echo $_SESSION['alert'];
    unset($_SESSION['alert']);
}

$uid = $_SESSION['uid'];
$database = new Database();

$foundUser = $database->profileUid("$uid");         //to return users info using the uid
$membership = $foundUser->getMembership();
$username = $foundUser->getUsername();

$seen = true;


if ($membership != 'premium') {
    $_SESSION['alert'] = "<script>alert('You must be Premium User to chat with people!')</script>";
    header("Location: ../View/welcome.php");
}


?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/css/bootstrap.min.css" rel="stylesheet"
          integrity="sha384-eOJMYsd53ii+scO/bJGFsiCZc+5NDVN2yr8+0RDqr0Ql0h+rP48ckxlpbzKgwra6" crossorigin="anonymous">

    <link rel="stylesheet" href="css/chat.css">

    <title>Chat</title>
</head>
<body>
<header>
    <nav class="navbar navbar-expand-lg navbar-light" style="background-color:#dd95b1 ;">
        <div class="container-fluid">
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                        <a class="nav-link" href="welcome.php">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="profile.php?uid=<?php echo $_SESSION['uid']; ?>">Profile</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="favorite.php">Favorites</a>
                    </li>
                    <li class="nav-item ">
                        <a class="nav-link" href="message.php">Messages</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="famous.php">Are you Famous?</a>
                    </li>
                </ul>
                <form class="d-flex" method="GET" action="welcome.php">
                    <input class="form-control" name="search" type="search" placeholder="Search Username..."
                           aria-label="Search" id="d-flex-input" required>
                    <button class="btn btn-outline-success" id="d-flex-btn" type="submit">Search</button>
                </form>

                <a href="../Controller/logout.php" style="text-decoration: none">
                    <button class="btn btn-danger collapse navbar-collapse">Logout</button>
                </a>
            </div>
        </div>
    </nav>
</header>

<div class="container">
    <div class="left-info">
        <?php echo "<p id='welcome-me' style='font-size: 32px'>Your conversation with " . $_GET['username'] . "...</p>"; ?>
    </div>

    <div class="right-info">
        <div style="background-color: red">
            <div class="send-messages">
                <form class="form-group" method="post"
                      action="../Controller/addMessage.php?username=<?= $_GET['username'] ?>">
                    <div class="row">
                        <div class="col">
                            <div class="input-group">
                                <textarea class="form-control" name="message" id="message" rows="3"
                                          placeholder="Type your Message here..."></textarea>
                                <div class="input-group-append">
                                    <button type="submit" name="submit" class="btn btn-success">SEND!</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
        <div class="chat-messages">
            <?php
            $fromUser = $_GET['username'];

            $receiver = $database->profileUsername("$fromUser");              //to return users info using the username
            $receiverID = $receiver->getUid();

            $toShow = false;

            $message = $database->displayMessages("$uid", "$receiverID");       //to display messages for the given id

            foreach ($message as $item) {
                $seen = $item->getSeen();
                $seen = true;
                $database->isSeen("$seen", "$receiverID");                //to set the messages to seen
            }

            foreach ($message as $value) {
                if (empty($value)) {
                    $toShow = false;
                } else {
                    $toShow = true;
                }
            }

            if ($toShow) {
                foreach ($message as $value) {
                    $value->showMessages("$username", "$fromUser");
                }
            } else {
                echo '<div style="text-align: center"><h2>No Messages</h2></div>';
            }

            ?>

        </div>
    </div>
</div>
</body>
</html>