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



?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/css/bootstrap.min.css" rel="stylesheet"
          integrity="sha384-eOJMYsd53ii+scO/bJGFsiCZc+5NDVN2yr8+0RDqr0Ql0h+rP48ckxlpbzKgwra6" crossorigin="anonymous">

    <link rel="stylesheet" href="css/welcome.css">

    <title>Welcome</title>
</head>
<body>
<header>
    <nav class="navbar navbar-expand-lg navbar-light" style="background-color:#dd95b1 ;">
        <div class="container-fluid">
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="welcome.php"
                           style="color: whitesmoke; font-weight: bold">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="profile.php?uid=<?php echo $_SESSION['uid']; ?>">Profile</a>
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
        <?php echo "<p id='welcome-me'>Welcome " . $_SESSION['username'] . "</p>"; ?>
        <p id="meet-me">-> Here is the list of people you can interact with...</p>
        <form method="get" action="">
            <div class="form-group">
                <label for="sort">->Find new people by...</label>
                <select class="form-control" name="sort" id="sort">
                    <option value="city">Location</option>
                    <option value="winks">Popularity</option>
                    <option value="age">Age</option>
                </select>
            </div>
            <button type="submit" class="btn btn-primary">Search</button>
        </form>
    </div>

    <div class="right-info">

        <?php

        if (isset($_GET['search'])) {
            $username = $_GET['search'];
            $database = new Database();

            $users = $database->checkUsername("$username");             //find user from the database using username

            foreach ($users as $user) {
                $user->printInfo();

            }
            unset($_GET['search']);

        } else {

            if (isset($_GET['sort'])){

                $sort = $_GET['sort'];

                $gender = $_SESSION['gender'];

                if ($gender == 'male'){
                    $search = 'female';
                }elseif($gender == 'female'){
                    $search = 'male';
                }else{
                    $search = 'other';
                }


                switch ($sort){
                    case 'city':

                        $city = strtolower($_SESSION['city']);

                        $database = new database();

                        $result = $database->sortLocation("$city", "$search");          //to sort the list and display people in your city

                        foreach ($result as $user) {
                            $user->printInfo();
                        }
                        break;

                    case 'age':

                        $age = $_SESSION['age'];
                        $database = new database();

                        $result = $database->sortAge("$age", "$search");         //to sort the list and display users near your age

                        foreach ($result as $user) {
                            $user->printInfo();
                        }
                        break;

                    case 'winks':

                        $database =  new database();

                        $result = $database->sortWinks("$search");            //to sort the list and display people with more winks above


                        foreach ($result as $user) {
                            $user->printInfo();
                        }
                        break;
                }

            }else {
                $gender = $_SESSION['gender'];

                switch ($gender) {

                    case 'male':
                        $gen = 'female';
                        $database = new Database();

                        $users = $database->genderSort("$gen");              //to sort gender and show opposite gender in the list

                        foreach ($users as $user) {
                            $user->printInfo();
                        }
                        break;

                    case 'female':
                        $gen = 'male';
                        $database = new Database();

                        $users = $database->genderSort("$gen");             //to sort gender and show opposite gender in the list

                        foreach ($users as $user) {
                            $user->printInfo();
                        }
                        break;

                    case 'other':
                        $gen = 'other';
                        $database = new Database();

                        $users = $database->genderSort("$gen");                  //to sort gender and show opposite gender in the list

                        foreach ($users as $user) {
                            $user->printInfo();
                        }
                        break;

                }
            }
        }

        ?>

    </div>
</div>

</body>
</html>