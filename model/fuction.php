<?php
require_once "connect.php";

function credenzialiValide($user): bool {
    global $conn;
    $email = $user["email"];
    $password = $user["password"];
    $password = md5($password);
    $result = $conn->query("SELECT id FROM utente WHERE email='$email' AND password='$password'");
    return $result->num_rows > 0;
}
function presente($user): bool{
    global $conn;
    $email = $user["email"];
    $result = $conn->query("SELECT id FROM utente WHERE email='$email'");
    return $result->num_rows > 0;
}

function aggiungiUtente($user): bool{
    global $conn;
    $username = $user["username"];
    $email = $user["email"];
    $password = $user["password"];
    $sql="INSERT INTO utente(username,email,password) VALUES('$username','$email','$password')";
    return $conn->query($sql);
}

function mediaRecenti($nMedia, $tipo){
    $mediaList = array();
    global $conn;
    if($tipo===0){
        $result = $conn->query("SELECT media.pathfile FROM media ORDER BY id DESC LIMIT $nMedia");
        if ($result->num_rows > 0) {
            while($row = $result->fetch_assoc()) {
                $mediaList[] = $row;
            }
        }
    }else{
        $result = $conn->query("SELECT media.pathfile FROM media WHERE media.id_tipo=$tipo ORDER BY id DESC LIMIT $nMedia");
        if ($result->num_rows > 0) {
            while($row = $result->fetch_assoc()) {
                $mediaList[] = $row;
            }
        }
    }
    return $mediaList;



}
?>
