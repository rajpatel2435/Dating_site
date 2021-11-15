<?php

const serverName = "localhost";
const database = "datingsite";
const username = "datingUser";
const password = "datingUser";

const connectionString = "mysql:host=" . serverName . ";dbname=" . database;


try {
    $connection = new PDO(connectionString, username, password);
    $connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $exception) {
    die("Connection failed: {$exception->getMessage()}");
}
