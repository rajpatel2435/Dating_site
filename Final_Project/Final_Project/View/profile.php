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

$database = new Database();

$uid = $_GET['uid'];
$foundUser = $database->profileUid("$uid");               //to return users info using the uid

$username = $foundUser->getUsername();
$email = $foundUser->getEmail();
$age = $foundUser->getAge();
$gender = $foundUser->getGender();
$city = $foundUser->getCity();
$membership = $foundUser->getMembership();
$bio = $foundUser->getBio();


$image = $foundUser->getImage();


?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/css/bootstrap.min.css" rel="stylesheet"
          integrity="sha384-eOJMYsd53ii+scO/bJGFsiCZc+5NDVN2yr8+0RDqr0Ql0h+rP48ckxlpbzKgwra6" crossorigin="anonymous">

    <link rel="stylesheet" href="css/profile.css">

    <style>
        .image-info {
            max-width: 75%;
            max-height: 75%;
        }
    </style>

    <title>Profile</title>
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
                        <a class="nav-link active" aria-current="page" style="color: whitesmoke; font-weight: bold" href="profile.php?uid=<?php echo $_SESSION['uid'];?>">Profile</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="favorite.php">Favorites</a>
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
        </div>
    </nav>
</header>
<?php

if (trim($image) == "default.png") {
    $showImg = false;
} else {
    $showImg = true;
}

?>
<div class="container">
    <div class="left-info">
        <div class="img-inf" style="height: 300px; width: 300px">
            <?php
            if ($showImg) {
                echo "<img src='images/profile-pic/{$uid}profile.png' alt=\"profile-pic\" class=\"image-info\">";
            } else {
                echo "<img src='images/profile-pic/default.png' alt='profile-pic' class='image-info'>";
            }


            ?>
        </div>
    </div>

    <div class="right-info">

        <?php
        if ($_SESSION['uid'] != $uid) {

            $read = 'readonly';
            $dis = 'disabled';

        } else {
            $read = '';
            $dis = '';
        }

        ?>
        <div class="container">
            <form method="post" action="../Controller/insert-new-info.php">
                <div class="form-group row">
                    <label for="username" class="col-sm-2 col-form-label">Username</label>
                    <div class="col-sm-10">
                        <input type="text" <?= $read ?> class="form-control" name="username" id="username"
                               value="<?= $username ?>"
                               required>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="email" class="col-sm-2 col-form-label">Email</label>
                    <div class="col-sm-10">
                        <input type="email" <?= $read ?> class="form-control" name="email" id="email"
                               value="<?= $email ?>" required>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="age" class="col-sm-2 col-form-label">Age</label>
                    <div class="col-sm-10">
                        <input type="number" <?= $read ?> class="form-control" name="age" id="age" value="<?= $age ?>"
                               required>
                    </div>
                </div>

                <?php
                if ($gender == 'male') {
                    $maleInput = '<option value="male" selected>Male</option>';
                } else {
                    $maleInput = '<option value="male">Male</option>';
                }

                if ($gender == 'female') {
                    $femaleInput = '<option value="female" selected>Female</option>';
                } else {
                    $femaleInput = '<option value="female">Female</option>';
                }

                if ($gender == 'other') {
                    $otherInput = '<option value="other" selected>Other</option>';
                } else {
                    $otherInput = '<option value="other">Other</option>';
                }
                ?>
                <div class="form-group row">
                    <label for="gender" class="col-sm-2 col-form-label">Gender</label>
                    <div class="col-sm-10">
                        <select class="form-control" <?= $dis ?> name="gender" id="gender" required>
                            <?= $maleInput ?>
                            <?= $femaleInput ?>
                            <?= $otherInput ?>
                        </select>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="city" class="col-sm-2 col-form-label">City</label>
                    <div class="col-sm-10">
                        <input type="text" <?= $read ?> class="form-control" name="city" id="city" value="<?= $city ?>"
                               required>
                    </div>
                </div>
                <?php
                if ($membership == 'guest') {
                    $guestInput = '<option value="guest" selected>Guest</option>';
                } else {
                    $guestInput = '<option value="guest">Guest</option>';
                }

                if ($membership == 'regular') {
                    $regularInput = '<option value="regular" selected>Regular</option>';
                } else {
                    $regularInput = '<option value="regular">Regular</option>';
                }
                if ($membership == 'premium') {
                    $premiumInput = '<option value="premium" selected>Premium</option>';
                } else {
                    $premiumInput = '<option value="premium">Premium</option>';
                }
                ?>
                <div class="form-group row">
                    <label for="gender" class="col-sm-2 col-form-label">Membership</label>
                    <div class="col-sm-10">
                        <select class="form-control" <?= $dis ?> name="membership" id="membership" required>
                            <?= $guestInput ?>
                            <?= $regularInput ?>
                            <?= $premiumInput ?>
                        </select>
                    </div>
                </div>
                <div class="form-group row m-auto col-sm-3">
                    <button type="submit" <?= $dis ?> name="submit" class="btn btn-primary">Update Details</button>
                </div>
                <br/>
            </form>


            <form action="../Controller/update-regular.php" method="post" enctype="multipart/form-data">
                <div class="form-group row">
                    <label for="bio" class="col-sm-2 col-form-label">About</label>
                    <div class="col-sm-10">
                        <?php if ($uid == $_SESSION['uid']) {
                            echo '<textarea class="form-control" name="bio" id="bio" rows="3">'.$bio.'</textarea>';
                        } else {
                            echo '<textarea class="form-control" name="bio" id="bio" rows="3" disabled></textarea>';
                        }
                        ?>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="image" class="col-sm-2 col-form-label">Upload Photo!</label>
                    <div class="col-sm-10">
                        <?php if ($uid == $_SESSION['uid']) {
                            echo '<input type="file" class="form-control" name="image" id="image">';
                        } else {
                            echo '<input type="file" class="form-control" name="image" id="image" disabled>';
                        }
                        ?>
                        <small id="image" class="form-text text-muted">Only PNG files allowed!</small>
                    </div>
                </div>
                <?php
                if ($membership == 'guest') {
                    echo '<div class="form-group row m-auto col-sm-9"><button type="submit" name="submit" class="btn btn-danger" disabled>You need to be Premium or Regular User to update Profile!</button></div>';
                } else {
                    if ($uid == $_SESSION['uid']) {
                        echo '<div class="form-group row m-auto col-sm-3"><button type="submit" name="submit" class="btn btn-primary">Update Profile!</button></div>';
                    } else {
                        echo '<div class="form-group row m-auto col-sm-3"><button type="submit" name="submit" class="btn btn-primary" disabled>Update Profile!</button></div>';
                    }
                }
                ?>
            </form>
        </div>
    </div>
</div>

</div>

</body>
</html>