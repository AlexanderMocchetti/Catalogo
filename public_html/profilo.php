<?php

session_start();

$user_id = $_SESSION["user_id"] ?? -1;

if ($user_id === -1) {
    header("Location: /login.php");
    die;
}

require_once "../config/fuction.php";
require_once "../config/constants.php";

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $upload_name = md5_file($_FILES["media"]["tmp_name"]).".mp4";
    $upload_file = UPLOAD_DIR . "/" . $upload_name;

    addMedia($upload_file, $_POST["tipo"], $_FILES["media"]["name"], $user_id, $_POST["genere"]);
    move_uploaded_file($_FILES["media"]["tmp_name"], $upload_file);

    if (isset($_FILES["thumbnail"])) {
        $upload_name = md5_file($_FILES["thumbnail"]["tmp_name"]) . ".jpeg";
        $upload_file = UPLOAD_DIR . "/" . $upload_name;
        move_uploaded_file($_FILES["thumbnail"]["tmp_name"], $upload_file);
        addThumbnail($upload_name);
    }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Huborto</title>
    <link rel="stylesheet" href="profilo.css">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet" />

</head>

<body>
<div class="header">
    <div class="header__left">
        <!-- <i id="menu" class="material-icons">menu</i> -->
        <a href="#"><img src="images/Logo%20Huborto.png" alt="Logo"></a>
        <a href="#">
            <h1>Hub<span>orto</span></h1>
        </a>
    </div>

    <div class="header__search">
        <form action=""> <!--TODO add action-->
            <input placeholder="Cosa vuoi guardare?" class="search" name="text" type="text">
        </form>
    </div>

    <div class="header__icons">
        <a href="#"><i class="material-icons">home</i></a>
        <a href="catalog.php"><i class="material-icons">apps</i></a>
        <a href="login.php"><i class="material-icons">login</i></a>
        <a href="profilo.php"><i class="material-icons display-this">account_circle</i></a>
    </div>
</div>
<!-- Header Ends -->

<!-- Main Body Starts -->
<div class="mainBody">
    <!-- Sidebar Starts -->

    <div class="sidebar">
        <div class="sidebar__categories">
            <div class="sidebar__category">
                <i class="material-icons">movie</i>
                <span>Film</span>
            </div>
            <div class="sidebar__category">
                <i class="material-icons">music_note</i>
                <span>Musica</span>
            </div>
            <div class="sidebar__category">
                <i class="material-icons">upcoming</i>
                <span>In arrivo...</span>
            </div>
        </div>
        <hr />
        <div class="sidebar__categories">
            <div class="sidebar__category">
                <i class="material-icons">history</i>
                <a href="cronologia.html"><span>Cronologia</span></a>
            </div>
            <div class="sidebar__category">
                <i class="material-icons">recommend</i>
                <span>I più acclamati dalla critica</span>
            </div>
            <div class="sidebar__category">
                <i class="material-icons">local_fire_department</i>
                <span>Da non perdere</span>
            </div>
        </div>
        <hr />
    </div>

    <h2>Vuoi pubblicare qualcosa?</h2>

    <form method="POST" enctype="multipart/form-data" class="uploads">
        <input type="hidden" name="MAX_FILE_SIZE" value="2000000000"
        <label for="uploadBtn">Carica media</label>
        <input type="file" id="uploadBtn" name="media">
        <label for="thumbnailBtn">Carica thumbnail</label>
        <input type="file" id="thumbnailBtn" name="thumbnail">
        <?php

        if ($generi = vediGeneri()) {
            echo "<select name='genere' required>";
            foreach ($generi as $row) {
                $genere_id = $row["id"];
                $genere_nome = $row["nome"];
                ?>
                <option value="<?=$genere_id?>"><?=$genere_nome?></option>
        <?php
            }
            echo "</select>";
        }
        ?>
        <?php
        if ($tipi = vediTipi()) {
            echo "<fieldset>";
            foreach ($tipi as $row) {
                $tipo_id = $row["id"];
                $tipo_nome = $row["nome"];
                ?>
                <input type="radio" id="<?=$tipo_nome?>" name="tipo" value="<?=$tipo_id?>" required>
                <label for="<?=$tipo_nome?>"><?=$tipo_nome?></label>
        <?php
            }
            echo "</fieldset>";
        }
        ?>
        <button type="submit">Carica</button>
    </form>

</body>

</html>