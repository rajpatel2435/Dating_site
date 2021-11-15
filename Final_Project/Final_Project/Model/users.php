<?php


class users
{
    private $uid;
    private $username = "";
    private $email = "";
    private $password = "";
    private $gender = "";
    private $age;
    private $city = "";
    private $membership = "";
    private $fav = "";
    private $bio = "";
    private $image = "";
    private $winks;


    public function __construct($uid, $username, $email, $password, $gender, $age, $city, $membership, $fav, $bio, $image, $winks)
    {
        $this->uid = $uid;
        $this->username = $username;
        $this->email = $email;
        $this->password = $password;
        $this->gender = $gender;
        $this->age = $age;
        $this->city = $city;
        $this->membership = $membership;
        $this->fav = $fav;
        $this->bio = $bio;
        $this->image = $image;
        $this->winks = $winks;
    }

    public function getUid()
    {
        return $this->uid;
    }

    public function getEmail()
    {
        return $this->email;
    }

    public function getUsername()
    {
        return $this->username;
    }

    public function getPassword()
    {
        return $this->password;
    }

    public function getGender()
    {
        return $this->gender;
    }

    public function getAge()
    {
        return $this->age;
    }

    public function getCity()
    {
        return $this->city;
    }

    public function getMembership()
    {
        return $this->membership;
    }

    public function getFav()
    {
        return $this->fav;
    }

    public function getBio()
    {
        return $this->bio;
    }

    public function getImage()
    {
        return $this->image;
    }

    public function getWinks()
    {
        return $this->winks;
    }


    public function favInfo()
    {
        echo '<div class="card-deck">';
        echo '<div class="card">';
        echo '<div class="row">';
        if ($this->getImage() == "default.png"){
            echo '<img class="card-img-top col-sm-3" src="../View/images/profile-pic/'.trim($this->getImage()).'" alt="'.$this->getUsername().'">';
        }else {
            echo '<img class="card-img-top col-sm-3" src="../View/images/profile-pic/'.trim($this->getImage()).'" alt="'.$this->getUsername().'">';
        }
        echo '<div class="card-body col-sm-5">';
        echo '<p class="card-title" style="font-family: \'Charm\', cursive; font-size: 32px;">' . trim($this->getUsername()) . '</p>';
        echo '<p class="card-text" style="font-family: \'Oswald\', sans-serif; font-size: 18px;">'. trim($this->getBio()) .'</p>';
        echo '<div class="row">';
        echo '<a href="../View/profile.php?uid=' . $this->getUid() . '" class="btn btn-primary col-sm-2">Profile</a><br />';
        echo '<a href="../View/chat.php?username='. $this->getUsername() .'" class="btn btn-success col-sm-2">Chat</a>';
        echo '<a href="../Controller/remove-fav.php?username=' . $this->getUsername() . '" class="btn btn-warning col-sm-4">Remove Favorite!</a>';
        echo '<a href="../Controller/winked.php?uid=' . $this->getUid() . '" class="btn btn-outline-danger col-sm-2">WINK!</a>';
        echo '</div>';
        echo '</div>';
        echo '</div>';
        echo '</div>';
        echo '<br />';

    }


    public function printInfo()
    {
        echo '<div class="card-deck">';
        echo '<div class="card">';
        echo '<div class="row">';
        if (trim($this->getImage()) == "default.png"){
            echo '<img class="card-img-top col-sm-3" src="../View/images/profile-pic/'.trim($this->getImage()).'" alt="'.$this->getUsername().'">';
        }else {
            echo '<img class="card-img-top col-sm-3" src="../View/images/profile-pic/'.trim($this->getImage()).'" alt="'.$this->getUsername().'">';
        }
        echo '<div class="card-body col-sm-5">';
        echo '<p class="card-title" style="font-family: \'Charm\', cursive; font-size: 32px; ">' . trim($this->getUsername()) . '</p>';
        echo '<p class="card-text" style="font-family: \'Oswald\', sans-serif; font-size: 18px;">'. trim($this->getBio()) .'</p>';
        echo '<div class="row">';
        echo '<a href="../View/profile.php?uid=' . $this->getUid() . '" class="btn btn-primary col-sm-2">Profile</a><br />';
        echo '<a href="../View/chat.php?username='. $this->getUsername() .'" class="btn btn-success col-sm-2">Chat</a>';
        echo '<a href="../Controller/add-fav.php?username=' . $this->getUsername() . '" class="btn btn-warning col-sm-4">Add to Favorites!</a>';
        echo '<a href="../Controller/winked.php?uid=' . $this->getUid() . '" class="btn btn-outline-danger col-sm-2">WINK!</a>';
        echo '</div>';
        echo '</div>';
        echo '</div>';
        echo '</div>';
        echo '<br />';

    }


    public function favUser()
    {
        echo '<div class="card-deck">';
        echo '<div class="card">';
        echo '<div class="row">';
        if (trim($this->getImage()) == "default.png"){
            echo '<img class="card-img-top col-sm-3" src="../View/images/profile-pic/'.trim($this->getImage()).'" alt="'.$this->getUsername().'">';
        }else {
            echo '<img class="card-img-top col-sm-3" src="../View/images/profile-pic/'.trim($this->getImage()).'" alt="'.$this->getUsername().'">';
        }
        echo '<div class="card-body col-sm-5">';
        echo '<p class="card-title" style="font-family: \'Charm\', cursive; font-size: 32px; ">' . trim($this->getUsername()) . '</p>';
        echo '<p class="card-text" style="font-family: \'Oswald\', sans-serif; font-size: 18px;">'. trim($this->getBio()) .'</p>';
        echo '<div class="row">';
        echo '<a href="../View/profile.php?uid=' . $this->getUid() . '" class="btn btn-primary col-sm-3">Profile</a><br />';
        echo '<a href="../View/chat.php?username='. $this->getUsername() .'" class="btn btn-success col-sm-3">Chat</a>';
        echo '<a href="../Controller/winked.php?uid=' . $this->getUid() . '" class="btn btn-outline-danger col-sm-2">WINK!</a>';
        echo '</div>';
        echo '</div>';
        echo '</div>';
        echo '</div>';
        echo '<br />';

    }




}