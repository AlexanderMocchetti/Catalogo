<?php
session_start();

if (!isset($_SESSION["user_id"])) {
    header("Location: /login.php");
    die;
}

require_once "../config/constants.php";
require_once "../config/fuction.php";

$text = $_GET["text"] ?? "";
$tipo = $_GET["tipo"] ?? 0;
$current_genere = $_GET["genere"] ?? 0;
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Huborto</title>
    <link rel="stylesheet" href="catalog.css">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet" />

</head>

<body>
<div class="header">
    <div class="header__left">
        <!-- <i id="menu" class="material-icons">menu</i> -->
        <a href="/catalog.php"><img src="images/Logo%20Huborto.png" alt="Logo"></a>
        <a href="/catalog.php">
            <h1>Hub<span>orto</span></h1>
        </a>
    </div>

    <div class="header__search">
        <form action=""> <!--TODO add action-->
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


    <div class="videos">
        <div class="videos__container">
            <?php
            if ($current_genere !== 0)
                $medias = cercagenere($current_genere);
            else if ($text === "")
                $medias = mediaRecenti(NUMBER_OF_VIDEOS_PER_PAGE, $tipo);
            else
                $medias = cercaNome($text);

            while ($media = array_shift($medias)) {
                $titolo = $media['titolo'];
                $pathfile = 'media/'.$titolo.'-'.$media['pathfile'];

                $image_pathfile = $media['image_pathfile'];
                if ($image_pathfile === null)
                    $image_pathfile = DEFAULT_IMAGE_THUMBNAIL;
                else
                    $image_pathfile = "/assets/" . $image_pathfile;
                $username_creator = $media['username'];
                $creation_date = $media['creation_date'];
                $views = quantevisual($media['id']);
                $gen = $media["genere"];
            ?>
            <a href="<?=$pathfile?>">
                <div class="video">
                    <div class="video__thumbnail">
                        <img src="<?=$image_pathfile?>" alt="" />
                    </div>
                    <div class="video__details">
                        <div class="title">
                            <h3><?=$titolo?></h3>
                            <span><?=$username_creator?></span>
                            <span><?=$gen?></span>
                            <span><?=$views?> Views • <?=$creation_date?></span>
                        </div>
                    </div>
                </div>
            </a>
            <?php
            }
            ?>
    </div>



</body>

</html>