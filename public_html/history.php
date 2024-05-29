<?php
session_start();

$user_id = $_SESSION["user_id"] ?? -1;

if ($user_id === -1) {
    header("Location: /login.php");
    die;
}

require_once "../config/constants.php";
require_once "../config/fuction.php";

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
        <a href="#"><img src="images/Logo%20Huborto.png" alt="Logo"></a>
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
            $medias = vedivisual($user_id);
            while ($media = array_shift($medias)) {
                $titolo = $media['titolo'];
                $pathfile = 'media/'.$titolo.'-'.$media['pathfile'];
                $image_pathfile = $media['image_pathfile'];
                if ($image_pathfile === null)
                    $image_pathfile = DEFAULT_IMAGE_THUMBNAIL;
                $username_creator = $media['username'];
                $creation_date = $media['creation_date'];
                $date = $media['date'];
                $views = quantevisual($media['id']);
                $gen = $media["genere"]
            ?>
            <!-- Single Video starts -->
            <a href="<?=$pathfile?>">
                <div class="video">
                    <div class="video__thumbnail">
                        <img src="<?=$image_pathfile?>" alt="" />
                    </div>
                    <div class="video__details">
                        <div class="title">
                            <h3><?=$titolo?></h3>
                            <span>Visto in data: <?=$date?></span>
                            <span><?=$username_creator?></span>
                            <span><?=$gen?></span>
                            <span><?=$views?> Views • <?=$creation_date?></span>
                        </div>
                    </div>
                </div>
            </a>
            <!-- Single Video Ends -->
            <?php
            }
            ?>

            <!-- Single Video starts -->
            <div class="video">
                <div class="video__thumbnail">
                    <img src="https://img.youtube.com/vi/YpTmcCBBdTE/maxresdefault.jpg" alt="" />
                </div>
                <div class="video__details">
                    <div class="title">
                        <h3>Build A Password Generator with React JS - Beginners Tutorial</h3>
                        <a href="">FutureCoders</a>
                        <span>10M Views • 3 Months Ago</span>
                    </div>
                </div>
            </div>
            <!-- Single Video Ends -->

            <div class="video">
                <div class="video__thumbnail">
                    <img src="https://img.youtube.com/vi/46cXFUzR9XM/maxresdefault.jpg" alt="" />
                </div>
                <div class="video__details">
                </div>
                <div class="title">
                    <h3>Bella Ciao Full Song | La Casa De Papel | Money Heist | Netflix India</h3>
                    <a href="">Netflix</a>
                    <span>10M Views • 11 Months Ago</span>
                </div>
            </div>
        </div>
    </div>



</body>

</html>