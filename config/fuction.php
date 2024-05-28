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

function get_media_id($pathfile) {
    global $conn;
    $sql = "SELECT id FROM media WHERE pathfile LIKE '$pathfile'";
    $result = $conn -> query($sql);
    return $result->fetch_assoc()["id"];
}

// TODO: add right returns
function mediaRecenti($nMedia, $tipo){
    $mediaList = array();
    global $conn;
    if($tipo===0){
        $result = $conn->query("SELECT media.titolo as titolo, utente.username as username, media.pathfile as pathfile,
                                    media.image_pathfile as image_pathfile, creation_date
                                    FROM media JOIN utente on media.id_utente=utente.id 
                                    ORDER BY media.id DESC LIMIT $nMedia");
        if ($result->num_rows > 0) {
            while($row = $result->fetch_assoc()) {
                $mediaList[] = $row;
            }
        }
    }else{
        $result = $conn->query("SELECT media.titolo as titolo, utente.username as username, media.pathfile as pathfile,
                                    media.image_pathfile as image_pathfile, creation_date
                                    FROM media JOIN utente on media.id_utente=utente.id 
                                    WHERE media.id_tipo=$tipo ORDER BY media.id DESC LIMIT $nMedia");
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

function addMedia( $file_path, $id_tipo, $titolo, $id_ut, $id_gen) {
    global $conn;
    $sql = "INSERT INTO media (id_utente, id_genere,pathfile, id_tipo, titolo, creation_date) 
            VALUES ('$id_ut','$id_gen', '$file_path', $id_tipo, '$titolo', NOW())";
    if ($conn->query($sql) === TRUE) {
        return true;
    } else {
        return false;
    }
}
function addThumbnail($file_path) {
    global $conn;
    $last_id = $conn->insert_id;
    $sql = "UPDATE media SET image_pathfile = $file_path WHERE id = $last_id";
    return $conn->query($sql);
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
    $result = $conn->query("SELECT media.titolo as titolo, utente.username as username, media.pathfile as pathfile,
                                    media.image_pathfile as image_pathfile, creation_date
                                    FROM media JOIN utente on media.id_utente=utente.id 
                                WHERE media.titolo LIKE '%$titolo%'");
    if ($result->num_rows > 0) {
        while($row = $result->fetch_assoc()) {
            $mediaList[] = $row;
        }
    }

    return $mediaList;
}
function crono($user_id, $file_id) {
    global $conn;
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

function quantevisual($mediaId) {
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



function vedivisual($idutente){
    global $conn;
    $query = "SELECT media.titolo, media.pathfile
              FROM media JOIN cronologia ON media.id = cronologia.id_media
              WHERE cronologia.id_utente = $idutente";
    $result = $conn->query($query);
    if ($result->num_rows > 0) {
        $videovisti = array();
        while ($row = $result->fetch_assoc()) {
            $videovisti[] = $row;
        }
        return $videovisti;
    }
    return false;
}

function vediTipi()
{
    global $conn;
    $query = "SELECT id, nome 
              FROM tipo;
    ";
    $result = $conn->query($query);
    if ($result->num_rows > 0) {
        $tipi = array();
        while ($row = $result->fetch_assoc()) {
            $tipi[] = $row;
        }
        return $tipi;
    }
    return false;
}

function vediGeneri()
{
    global $conn;
    $query = "SELECT id, nome
              FROM genere";
    $result = $conn->query($query);
    if ($result->num_rows > 0) {
        $generi = array();
        while ($row = $result->fetch_assoc()) {
            $generi[] = $row;
        }
        return $generi;
    }
    return false;
}

?>
