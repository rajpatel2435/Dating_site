<?php

require_once "users.php";
require_once "chat.php";


class database
{

    private const serverName = "localhost";
    private const database = "datingsite";
    private const username = "root";
    private const password = "";
    private const connectionString = "mysql:host=" . Database::serverName . ";dbname=" . Database::database;

    private PDO $connection;

    public function __construct()
    {
        try {
            $this->connection = new PDO(Database::connectionString, Database::username, Database::password);
            $this->connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $exception) {
            die("Connection failed: {$exception->getMessage()}");
        }
    }

    public function insertUser(users $users)     //Add new User
    {
        try {
            $query = "INSERT INTO `users` (`uid`, `username`, `email`, `password`, `gender`, `age` , `city`, `membership` , `fav`, `bio`, `image`, `winks`) VALUES (NULL, '{$users->getUsername()}', '{$users->getEmail()}', '{$users->getPassword()}', '{$users->getGender()}', '{$users->getAge()}', '{$users->getCity()}', '{$users->getMembership()}', ' {$users->getFav()}', ' {$users->getBio()}', ' {$users->getImage()}', '{$users->getWinks()}');";
            $statement = $this->connection->prepare($query);
            $statement->execute();
        } catch (PDOException $exception) {
            echo "ERROR : {$exception->getMessage()}";
        }
    }


    public function insertChat(chat $chat)     //insert new in table chat
    {
        try {
            $query = "INSERT INTO `chat` (`id`, `message`,`senderID`,`receiverID`,  `time`, `seen`, `type`) VALUES (NULL, '{$chat->getMessage()}', '{$chat->getSenderID()}', '{$chat->getReceiverID()}', CURRENT_TIMESTAMP, '{$chat->getSeen()}', '{$chat->getType()}')";
            $statement = $this->connection->prepare($query);
            $statement->execute();
        } catch (PDOException $exception) {
            echo "ERROR : {$exception->getMessage()}";
        }


    }


    public function checkUsername(string $username)        //take in username and return the details of the users
    {
        try {
            $query = "SELECT * FROM users WHERE username='{$username}'";
            $result = $this->connection->prepare($query);
            $result->execute();
            $result->setFetchMode(PDO::FETCH_ASSOC);

            $user = array();

            foreach ($result->fetchAll() as $row) {
                $users = new users($row['uid'], $row['username'], $row['email'], $row['password'], $row['gender'], $row['age'], $row['city'], $row['membership'], $row['fav'], $row['bio'], $row['image'], $row['winks']);
                array_push($user, $users);
            }

            return $user;

        } catch (PDOException $exception) {
            echo "ERROR : {$exception->getMessage()}";
        }

    }

    public function findUser(string $email)       //find user using email
    {
        try {
            $query = "SELECT * FROM users WHERE email='{$email}'";
            $result = $this->connection->prepare($query);
            $result->execute();
            $result->setFetchMode(PDO::FETCH_ASSOC);

            $user = array();

            foreach ($result->fetchAll() as $row) {
                $users = new users($row['uid'], $row['username'], $row['email'], $row['password'], $row['gender'], $row['age'], $row['city'], $row['membership'], $row['fav'], $row['bio'], $row['image'], $row['winks']);
                array_push($user, $users);
            }

            return $user;

        } catch (PDOException $exception) {
            echo "ERROR : {$exception->getMessage()}";
        }

    }


    public function findNotis(int $myID)       //to find notifications for the given uid
    {
        try {
            $query = "SELECT * FROM chat WHERE receiverID = '{$myID}' ORDER BY time DESC";
            $result = $this->connection->prepare($query);
            $result->execute();
            $result->setFetchMode(PDO::FETCH_ASSOC);

            $chat = array();

            foreach ($result->fetchAll() as $row) {
                $chats = new chat($row['id'], $row['message'], $row['senderID'], $row['receiverID'], $row['time'], $row['seen'], $row['type']);
                array_push($chat, $chats);
            }

            return $chat;

        } catch (PDOException $exception) {
            echo "ERROR : {$exception->getMessage()}";
        }

    }


    public function displayMessages(int $senderID, int $receiverID)           //to display messages for the given id
    {
        try {
            $query = "SELECT * FROM chat WHERE (receiverID = '{$senderID}' AND senderID = '{$receiverID}') OR (receiverID = '$receiverID' AND senderID = '$senderID') AND type='message' ORDER BY time DESC";
            $result = $this->connection->prepare($query);
            $result->execute();
            $result->setFetchMode(PDO::FETCH_ASSOC);

            $chat = array();

            foreach ($result->fetchAll() as $row) {
                $chats = new chat($row['id'], $row['message'], $row['senderID'], $row['receiverID'], $row['time'], $row['seen'], $row['type']);
                array_push($chat, $chats);
            }

            return $chat;

        } catch (PDOException $exception) {
            echo "ERROR : {$exception->getMessage()}";
        }
    }


    public function updateInfo(int $uid, string $username, string $email, string $gender, int $age, string $city, string $membership)               //to update new info in the users
    {
        try {
            $query = "UPDATE users SET username = '{$username}', email= '{$email}', gender='{$gender}', age = '{$age}' , city = '{$city}', membership = '{$membership}' WHERE uid='{$uid}'";
            $result = $this->connection->prepare($query);
            $result->execute();
        } catch (PDOException $exception) {
            echo "ERROR : {$exception->getMessage()}";
        }

    }



    public function isSeen( bool $seen,int $receiverID)             //to set the messages to seen
    {
        try{
            $query = "UPDATE chat SET seen = '{$seen}' WHERE senderID = '{$receiverID}'";
            $query = $this->connection->prepare($query);
            $query->execute();

        }catch (PDOException $exception) {
            echo "ERROR : {$exception->getMessage()}";
        }
    }



    public function updateRegular(string $bio, string $image, int $uid)             //to update photo and bio in the users
    {
        try {
            $query = "UPDATE users SET bio = '{$bio}', image = '{$image}' WHERE uid='{$uid}'";
            $result = $this->connection->prepare($query);
            $result->execute();

        } catch (PDOException $exception) {
            echo "ERROR : {$exception->getMessage()}";
        }
    }


    public function genderSort(string $gender)                       //to sort gender and show opposite gender in the list
    {
        try {
            $query = "SELECT * FROM users WHERE gender='{$gender}'";
            $result = $this->connection->prepare($query);
            $result->execute();
            $result->setFetchMode(PDO::FETCH_ASSOC);

            $user = array();

            foreach ($result->fetchAll() as $row) {
                $users = new users($row['uid'], $row['username'], $row['email'], $row['password'], $row['gender'], $row['age'], $row['city'], $row['membership'], $row['fav'], $row['bio'], $row['image'], $row['winks']);
                array_push($user, $users);
            }

            return $user;

        } catch (PDOException $exception) {
            echo "ERROR : {$exception->getMessage()}";
        }

    }


    public function checkLogin(string $username, string $password)                     //to check the username and password is right
    {
        try {
            $sql = "SELECT * FROM users WHERE username='$username' AND password='$password'";
            $result = $this->connection->prepare($sql);
            $result->execute();
            $result->setFetchMode(PDO::FETCH_ASSOC);

            foreach ($result->fetchAll() as $row) {
                $users = new users($row['uid'], $row['username'], $row['email'], $row['password'], $row['gender'], $row['age'], $row['city'], $row['membership'], $row['fav'], $row['bio'], $row['image'], $row['winks']);
                return $users;
            }

        } catch (PDOException $exception) {
            echo "ERROR : {$exception->getMessage()}";
        }

    }


    public function usernameMessage(string $username)           //to return users info using username
    {
        try {
            $query = "SELECT * FROM users WHERE username='{$username}'";
            $result = $this->connection->prepare($query);
            $result->execute();
            $result->setFetchMode(PDO::FETCH_ASSOC);

            foreach ($result->fetchAll() as $row) {
                $users = new users($row['uid'], $row['username'], $row['email'], $row['password'], $row['gender'], $row['age'], $row['city'], $row['membership'], $row['fav'], $row['bio'], $row['image'], $row['winks']);
                return $users;
            }


        } catch (PDOException $exception) {
            echo "ERROR : {$exception->getMessage()}";
        }
    }


    public function getUsers()           //to get all the info of the users
    {
        try {
            $query = "select * from users";
            $statement = $this->connection->prepare($query);
            $statement->execute();
            $statement->setFetchMode(PDO::FETCH_ASSOC);

            $user = array();

            foreach ($statement->fetchAll() as $row) {
                $users = new users($row['uid'], $row['username'], $row['email'], $row['password'], $row['gender'], $row['age'], $row['city'], $row['membership'], $row['fav'], $row['bio'], $row['image'], $row['winks']);
                array_push($user, $users);
            }

            return $user;

        } catch (PDOException $exception) {
            echo "ERROR : {$exception->getMessage()}";
        }
    }


    public function profileUid(int $uid)                 //to return users info using the uid
    {
        try {
            $query = "select * from users where uid = '{$uid}'";
            $statement = $this->connection->prepare($query);
            $statement->execute();
            $statement->setFetchMode(PDO::FETCH_ASSOC);

            foreach ($statement->fetchAll() as $row) {
                $users = new users($row['uid'], $row['username'], $row['email'], $row['password'], $row['gender'], $row['age'], $row['city'], $row['membership'], $row['fav'], $row['bio'], $row['image'], $row['winks']);
                return $users;
            }

        } catch (PDOException $exception) {
            echo "ERROR : {$exception->getMessage()}";
        }
    }


    public function profileUsername(string $username)                     //to return users info using the username
    {
        try {
            $query = "select * from users where username = '{$username}'";
            $statement = $this->connection->prepare($query);
            $statement->execute();
            $statement->setFetchMode(PDO::FETCH_ASSOC);

            foreach ($statement->fetchAll() as $row) {
                $users = new users($row['uid'], $row['username'], $row['email'], $row['password'], $row['gender'], $row['age'], $row['city'], $row['membership'], $row['fav'], $row['bio'], $row['image'], $row['winks']);
                return $users;
            }

        } catch (PDOException $exception) {
            echo "ERROR : {$exception->getMessage()}";
        }
    }


    public function updateFav(string $updatedFav, int $uid)               //to update favorite list
    {
        try {
            $query = "UPDATE users SET fav = '{$updatedFav}' WHERE uid='{$uid}'";
            $statement = $this->connection->prepare($query);
            $statement->execute();

        } catch (PDOException $exception) {
            echo "ERROR : {$exception->getMessage()}";
        }
    }


    public function winkMe(int $winks, int $uid)                   //add new wink to the user
    {
        try {
            $query = "UPDATE users SET winks = '{$winks}' WHERE uid='{$uid}'";
            $statement = $this->connection->prepare($query);
            $statement->execute();

        } catch (PDOException $exception) {
            echo "ERROR : {$exception->getMessage()}";
        }
    }

    public function sortLocation(string $city, string $gender)              //to sort the list and display people in your city
    {
        try {

            $query = "select * from users where LOWER(city) = '{$city}' AND gender = '{$gender}'";
            $statement = $this->connection->prepare($query);
            $statement->execute();
            $statement->setFetchMode(PDO::FETCH_ASSOC);

            $user = array();

            foreach ($statement->fetchAll() as $row) {
                $users = new users($row['uid'], $row['username'], $row['email'], $row['password'], $row['gender'], $row['age'], strtolower($row['city']), $row['membership'], $row['fav'], $row['bio'], $row['image'], $row['winks']);
                array_push($user, $users);
            }

            return $user;

        } catch (PDOException $exception) {
            echo "ERROR : {$exception->getMessage()}";
        }
    }


    public function sortAge(int $age, string $gender)                //to sort the list and display users near your age
    {
        try {

            $age1 = $age + 10;
            $age2 = $age - 10;
            $query = "select * from users where age BETWEEN '{$age2}'AND '{$age1}' AND gender = '{$gender}'";
            $statement = $this->connection->prepare($query);
            $statement->execute();
            $statement->setFetchMode(PDO::FETCH_ASSOC);

            $user = array();

            foreach ($statement->fetchAll() as $row) {
                $users = new users($row['uid'], $row['username'], $row['email'], $row['password'], $row['gender'], $row['age'], $row['city'], $row['membership'], $row['fav'], $row['bio'], $row['image'], $row['winks']);
                array_push($user, $users);
            }

            return $user;

        } catch (PDOException $exception) {
            echo "ERROR : {$exception->getMessage()}";
        }
    }


    public function sortWinks(string $gender)                  //to sort the list and display people with more winks above
    {
        try {
            $query = "select * from users where gender = '{$gender}' ORDER BY winks DESC";
            $statement = $this->connection->prepare($query);
            $statement->execute();
            $statement->setFetchMode(PDO::FETCH_ASSOC);

            $user = array();

            foreach ($statement->fetchAll() as $row) {
                $users = new users($row['uid'], $row['username'], $row['email'], $row['password'], $row['gender'], $row['age'], $row['city'], $row['membership'], $row['fav'], $row['bio'], $row['image'], $row['winks']);
                array_push($user, $users);
            }

            return $user;

        } catch (PDOException $exception) {
            echo "ERROR : {$exception->getMessage()}";
        }
    }


    public function checkFav(string $username)           //to select uid and fav list from the users
    {
        try {
            $query = "SELECT uid, fav from users";
            $statement = $this->connection->prepare($query);
            $statement->execute();

            $fav = [];

            $statement->setFetchMode(PDO::FETCH_ASSOC);

            foreach ($statement->fetchAll() as $result) {
                $favArr = explode(" ", $result['fav']);
                if (in_array("$username", $favArr)) {
                    $newArr = $result['uid'];
                    array_push($fav, "$newArr");
                }
            }
            return $fav;

        } catch (PDOException $exception) {
            echo "ERROR : {$exception->getMessage()}";
        }
    }


}