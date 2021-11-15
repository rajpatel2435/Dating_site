<?php


class chat
{

    private $id;
    private $message = "";
    private $senderID;
    private $receiverID;
    private $time;
    private $seen;
    private $type;


    public function __construct($id, $message, $senderID, $receiverID, $time, $seen, $type)
    {
        $this->id = $id;
        $this->message = $message;
        $this->senderID = $senderID;
        $this->receiverID = $receiverID;
        $this->time = $time;
        $this->seen = $seen;
        $this->type = $type;
    }

    public function getId()
    {
        return $this->id;
    }

    public function getMessage()
    {
        return $this->message;
    }

    public function getSenderID()
    {
        return $this->senderID;
    }

    public function getReceiverID()
    {
        return $this->receiverID;
    }

    public function getTime()
    {
        return $this->time;
    }

    public function getSeen()
    {
        return $this->seen;
    }

    public function getType()
    {
        return $this->type;
    }


    public function printNotis()
    {


        $whoSend = $this->getSenderID();

        $database = new database();
        $result = $database->profileUid("$whoSend");         //to return users info using the uid
        $whoUser = $result->getUsername();


        switch (trim($this->getType())) {

            case 'wink':
                echo '<div class="card" style="background-color: #deb8cd;">';
                echo '<div class="card-header">WINK!<span class="float-end">' . $this->getTime() . '</span></div>';
                echo '<div class="card-body">';
                echo '<h5 class="card-title">' . $whoUser . ' winked at You!</h5>';
                echo '<div class="row">';
                echo '<a href="../View/profile.php?uid=' . $whoSend . '" class="btn btn-primary col-sm-3">Profile</a><br />';
                echo '<a href="../View/chat.php?username=' . $whoUser . '" class="btn btn-success col-sm-3">Chat</a>';
                echo '<a href="../Controller/winked.php?uid=' . $whoSend . '" class="btn btn-outline-danger col-sm-3">WINK BACK!</a>';
                echo '</div>';
                echo '</div>';
                echo '</div>';
                echo '<br />';

                break;

            case 'message':
                echo '<div class="card" style="background-color: #deb8cd;">';
                echo '<div class="card-header">New Message!<span class="float-end">' . $this->getTime() . '</span></div>';
                echo '<div class="card-body">';
                echo '<h5 class="card-title">' . $whoUser . ' sent you a Message!</h5>';
                echo '<p class="card-text">' . $this->getMessage() . '</p>';
                echo '<div class="row">';
                echo '<a href="../View/profile.php?uid=' . $whoSend . '" class="btn btn-primary col-sm-3">Profile</a><br />';
                echo '<a href="../View/chat.php?username=' . $whoUser . '" class="btn btn-outline-success col-sm-3">Reply</a>';
                echo '<a href="../Controller/winked.php?uid=' . $whoSend . '" class="btn btn-danger col-sm-3">WINK!</a>';
                echo '</div>';
                echo '</div>';
                echo '</div>';
                echo '<br />';

                break;

            case 'addFav':
                echo '<div class="card" style="background-color: #deb8cd;">';
                echo '<div class="card-header">Favorites!<span class="float-end">' . $this->getTime() . '</span></div>';
                echo '<div class="card-body">';
                echo '<h5 class="card-title">' . $whoUser . ' added you to their Favorite List!</h5>';
                echo '<div class="row">';
                echo '<a href="../View/profile.php?uid=' . $whoSend . '" class="btn btn-primary col-sm-3">Profile</a><br />';
                echo '<a href="../View/chat.php?username=' . $whoUser . '" class="btn btn-success col-sm-3">Chat</a>';
                echo '<a href="../Controller/winked.php?uid=' . $whoSend . '" class="btn btn-danger col-sm-3">WINK</a>';
                echo '</div>';
                echo '</div>';
                echo '</div>';
                echo '<br />';

                break;

            case 'removeFav':
                echo '<div class="card" style="background-color: #deb8cd;">';
                echo '<div class="card-header">Favorites!<span class="float-end">' . $this->getTime() . '</span></div>';
                echo '<div class="card-body">';
                echo '<h5 class="card-title">' . $whoUser . ' removed you from their Favorite List!</h5>';
                echo '<div class="row">';
                echo '<a href="../View/profile.php?uid=' . $whoSend . '" class="btn btn-primary col-sm-3">Profile</a><br />';
                echo '<a href="../View/chat.php?username=' . $whoUser . '" class="btn btn-success col-sm-3">Chat</a>';
                echo '<a href="../Controller/winked.php?uid=' . $whoSend . '" class="btn btn-danger col-sm-3">WINK</a>';
                echo '</div>';
                echo '</div>';
                echo '</div>';
                echo '<br />';

        }

    }


    public function showMessages()
    {
        if ($this->getType() == 'message') {
            $database = new database();

            $result = $database->profileUid("$this->senderID");            //to return users info using the uid

            $sender = $result->getUsername();


            if ($sender == $_SESSION['username']) {
                if ($this->getSeen()) {
                    $style = 'style="background-color: skyblue;"';
                } else {
                    $style = 'style="border: 2px solid skyblue"';
                }
            } else {
                if ($this->getSeen()) {
                    $style = 'style="background-color: pink;"';
                } else {
                    $style = 'style="border: 2px solid pink"';
                }
            }


            if ($sender == $_SESSION['username']) {
                echo '<div class="card"' . $style . '>';
                echo '<div class="card-header">Me<span class="float-end">' . $this->getTime() . '</span></div>';
                echo '<div class="card-body"><p class="card-text">' . $this->getMessage() . '</p></div>';
                echo '</div>';
                echo '<br />';
            } else {
                echo '<div class="card"' . $style . '>';
                echo '<div class="card-header">' . $sender . '<span class="float-end">' . $this->getTime() . '</span></div>';
                echo '<div class="card-body"><p class="card-text">' . $this->getMessage() . '</p></div>';
                echo '</div>';
                echo '<br />';

            }

        }
    }

}