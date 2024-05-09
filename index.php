<?php

global $conn;
require_once "connect.php";

$sql = "SELECT username FROM utente";
$res = $conn->query($sql);

while ($row = $res->fetch_assoc()) {
    echo "Username: ".$row["username"]."<br>";
}