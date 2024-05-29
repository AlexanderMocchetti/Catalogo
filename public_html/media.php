<?php
session_start();
$user_id = $_SESSION["user_id"] ?? -1;

if ($user_id === -1) {
    header("Location: /login.php");
    die;
}

require_once "../config/constants.php";
require_once "../config/fuction.php";


$titolo = $_GET['titolo'];

$tipo = get_media_type($_GET["pathfile"]);

$pathfile = '/assets/'.$_GET['pathfile'];

switch ($tipo) {
    case VIDEO:
        $pathfile .= ".mp4";
        break;
    case AUDIO:
        $pathfile .= ".mp3";
        break;
}

crono($user_id, get_media_id($_GET["pathfile"]));
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Huborto</title>
    <link rel="stylesheet" href="/media.css">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet" />

</head>

<body>
<div class="header">
    <div class="header__left">
        <!-- <i id="menu" class="material-icons">menu</i> -->
        <a href="#"><img src="/images/Logo%20Huborto.png" alt="Logo"></a>
        <a href="#">
            <h1>Hub<span>orto</span></h1>
        </a>
    </div>

    <div class="header__search">
        <form action="/catalog.php"> <!--TODO add action-->
            <input placeholder="Cosa vuoi guardare?" class="search" name="text" type="text">
        </form>
    </div>

    <div class="header__icons">
        <a href="/catalog.php"><i class="material-icons">home</i></a>
        <a href="/history.php"><i class="material-icons">history</i></a>
        <a href="/profilo.php"><i class="material-icons display-this">account_circle</i></a>
    </div>
</div>
<!-- Header Ends -->

<!-- Main Body Starts -->
<div class="mainBody">
    <!-- Sidebar Starts -->
    <div class="sidebar">
        <div class="sidebar__categories">
            <a href="/catalog.php?tipo=<?=VIDEO?>">
                <div class="sidebar__category">
                    <i class="material-icons">movie</i>
                    <span>Film</span>
                </div>
            </a>
            <a href="/catalog.php?tipo=<?=AUDIO?>">
                <div class="sidebar__category">
                    <i class="material-icons">music_note</i>
                    <span>Musica</span>
                </div>
            </a>
            <div class="sidebar__category">
                <i class="material-icons">upcoming</i>
                <span>In arrivo...</span>
            </div>
        </div>
        <hr />
        <div class="sidebar__categories">
            <?php
            if ($generi = vediGeneri())  {
                foreach ($generi as $genere) {
                    $genere_id = $genere["id"];
                    $genere_nome = $genere["nome"];
                    ?>
                    <a href="/catalog.php?genere=<?=$genere_id?>">
                        <div class="sidebar__category">
                            <span><?=$genere_nome?></span>
                        </div>
                    </a>
                    <?php
                }
            }
            ?>
        </div>
        <hr />
    </div>
    <div class="video">
        <video src="<?=$pathfile?>" controls autoplay></video>
        <h2><?=$titolo?></h2>
    </div>

</body>

</html>