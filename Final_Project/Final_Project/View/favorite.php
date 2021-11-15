<?php

require_once '../Controller/config.php';
require_once '../Model/database.php';
require_once '../Model/users.php';

session_start();


$uid = $_SESSION['uid'];
$database = new Database();

$foundUser = $database->profileUid("$uid");            //to return users info using the uid
$membership = $foundUser->getMembership();


if (!isset($_SESSION['uid'])) {
    header("Location: welcome.php");
}

if (isset($_SESSION['alert'])) {
    echo $_SESSION['alert'];
    unset($_SESSION['alert']);
}

if ($membership != 'premium'){
    $_SESSION['alert'] = "<script>alert('You need to be a Premium User to access the Favorite List!')</script>";
    header("Location: welcome.php");
}


?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/css/bootstrap.min.css" rel="stylesheet"
          integrity="sha384-eOJMYsd53ii+scO/bJGFsiCZc+5NDVN2yr8+0RDqr0Ql0h+rP48ckxlpbzKgwra6"
          crossorigin="anonymous">

    <link rel="stylesheet" href="css/welcome.css">

    <title>Favorite List</title>
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
                        <a class="nav-link" href="profile.php?uid=<?php echo $_SESSION['uid'];?>">Profile</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" style="color: whitesmoke; font-weight: bold" href="favorite.php">Favorites</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="message.php">Messages</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="famous.php">Are you Famous?</a>
                    </li>
                </ul>
                <form class="d-flex" method="GET" action="welcome.php">
                    <input class="form-control" name="search" type="search" placeholder="Search Username..."
                           aria-label="Search" id="d-flex-input"required>
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
        <?php echo "<p id='welcome-me'>Hello " . $_SESSION['username'] . "</p>"; ?>
        <p id="meet-me">-> Here is your favorite list...</p>
    </div>

    <div class="right-info">
        <?php

        if (isset($_GET['search'])) {
            $username = $_GET['search'];
            $database = new Database();

            $users = $database->checkUsername("$username");      //find user from the database using username

            foreach ($users as $user) {
                $user->printInfo();

            }
            unset($_GET['search']);
        } else {

            $database = new Database();

            $result = $database->profileUid("$uid");                   //to return users info using the uid

            $fav = $result->getFav();

            $explodeFav = explode(" ", $fav);

            foreach ($explodeFav as $value) {
                if (empty($value)|| $value == "") {
                    $toShow = false;
                } else {
                    $toShow = true;
                }
            }

            if ($toShow){
                foreach ($explodeFav as $item) {
                    $arr = $database->checkUsername("$item");            //find user from the database using username
                    if (!empty($arr)) {
                        foreach ($arr as $users) {
                            $users->favInfo();
                        }
                    }
                }
            }else {
                echo '<div style="text-align: center"><h2>No Favorites</h2></div>';
            }
        }

        ?>

    </div>

</div>


</body>
</html>