<?php
require_once "connect.php";

function credenzialiValide($user): bool {
    global $conn;
    $email = $user["email"];
    $password = $user["password"];
    $password = md5($password);
    $result = $conn->query("SELECT id FROM utente WHERE email='$email' AND pass='$password'");
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
    $sql="INSERT INTO utente(username,email,pass) VALUES('$username','$email','$password')";
    return $conn->query($sql);
}

function mediaRecenti($nMedia, $tipo){
    $mediaList = array();
    global $conn;
    if($tipo===0){
        $result = $conn->query("SELECT media.titolo, utente.username, media.pathfile 
                                    FROM media JOIN utente on media.id_utente=utente.id 
                                    ORDER BY id DESC LIMIT $nMedia");
        if ($result->num_rows > 0) {
            while($row = $result->fetch_assoc()) {
                $mediaList[] = $row;
            }
        }
    }else{
        $result = $conn->query("SELECT media.titolo, utente.username, media.pathfile 
                                    FROM media JOIN utente on media.id_utente=utente.id 
                                    WHERE media.id_tipo=$tipo ORDER BY id DESC LIMIT $nMedia");
        if ($result->num_rows > 0) {
            while($row = $result->fetch_assoc()) {
                $mediaList[] = $row;
            }
        }
    }
    return $mediaList;
}
function mediaTotali(){
    $mediaList = array();
    global $conn;
    $result = $conn->query("SELECT media.titolo, utente.username, media.pathfile 
                                    FROM media JOIN utente on media.id_utente=utente.id  ");
    if ($result->num_rows > 0) {
        while($row = $result->fetch_assoc()) {
            $mediaList[] = $row;
        }
    }

    return $mediaList;
}

function addMedia( $file_path, $id_tipo, $titolo, $id_ut, $id_gen, $data) {
    global $conn;
    $sql = "INSERT INTO media (id_utente, id_genere,pathfile, id_tipo, titolo, creation_date) 
            VALUES ('$id_ut','$id_gen', '$file_path', $id_tipo, '$titolo','$data')";
    if ($conn->query($sql) === TRUE) {
        return true;
    } else {
        return false;
    }
}
function delete( $id) {
    global $conn;
    $sql = "DELETE FROM media WHERE id = $id";
    if ($conn->query($sql) === TRUE) {
        return true;
    }
    return false;
}


function cercaNome($titolo){
    $mediaList = array();
    global $conn;
    $result = $conn->query("SELECT media.titolo, media.pathfile FROM media WHERE media.titolo='$titolo'");
    if ($result->num_rows > 0) {
        while($row = $result->fetch_assoc()) {
            $mediaList[] = $row;
        }
    }

    return $mediaList;
}
function crono($user_id, $file_id) {
    global $conn;
    $user_id;
    $file_id;
    $sql = "INSERT INTO cronologia (id_utente,id_media, data) VALUES ($user_id, $file_id, NOW())";
    return $conn->query($sql);
}
function cercagenere($genere){
    $mediaList = array();
    global $conn;
    $result = $conn->query("SELECT media.titolo, media.pathfile FROM media JOIN genere on media.id_genere=genere.id WHERE genere.nome='$genere'");
    if ($result->num_rows > 0) {
        while($row = $result->fetch_assoc()) {
            $mediaList[] = $row;
        }
    }

    return $mediaList;
}

function vedivisual($mediaId) {
    global $conn;
    $sql = "SELECT COUNT(*) as view_count FROM cronologia WHERE id_media = $mediaId";
    $result = $conn->query($sql);
    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        return $row['view_count'];
    } else {
        return 0;
    }
}

?>
