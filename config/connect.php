<?php

$hostname = "10.8.0.1";
$user = "root";
$password = "password";
$database = "huborto";
$port = 1883;

$conn = new mysqli($hostname, $user, $password, $database, $port);

if ($conn->connect_error) {
    die("DB Connection error".$conn->connect_error);
}