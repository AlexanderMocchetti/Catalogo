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
$pathfile = '/assets/'.$_GET['pathfile'].'.mp4';
crono($user_id, get_media_id($pathfile));
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
        <form action=""> <!--TODO add action-->
            <input placeholder="Cosa vuoi guardare?" class="search" name="text" type="text">
        </form>
    </div>

    <div class="header__icons">
        <a href="#"><i class="material-icons">home</i></a>
        <a href="catalog.php"><i class="material-icons">apps</i></a>
        <a href="login.php"><i class="material-icons display-this">account_circle</i></a>
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
                <i class="material-icons">local_fire_department</i>
                <span>I più popolari</span>
            </div>
            <div class="sidebar__category">
                <i class="material-icons">recommend</i>
                <span>I più acclamati dalla critica</span>
            </div>
            <div class="sidebar__category">
                <i class="material-icons">priority_high</i>
                <span>Da non perdere</span>
            </div>
        </div>
        <hr />
    </div>
    <div class="video">
        <video src="<?=$pathfile?>" controls autoplay></video>
        <h2><?=$titolo?></h2>
    </div>

</body>

</html>