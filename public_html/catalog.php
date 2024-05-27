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
        <form action=""> <!--TODO add action-->
            <input placeholder="Cosa vuoi guardare?" class="search" name="text" type="text">
        </form>
    </div>

    <div class="header__icons">
        <a href="#"><i class="material-icons">home</i></a>
        <a href="catalog.html"><i class="material-icons">apps</i></a>
        <a href="login.html"><i class="material-icons display-this">account_circle</i></a>
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


    <div class="videos">
        <div class="videos__container">
            <?php
            ?>
            <!-- Single Video starts -->
            <div class="video">
                <div class="video__thumbnail">
                    <img src="https://img.youtube.com/vi/PpXUTUXU7Qc/maxresdefault.jpg" alt="" />
                </div>
                <div class="video__details">
                    <div class="title">
                        <h3>
                            Top 5 Programming Languages to Learn in 2021 | Best Programming Languages to Learn
                        </h3>
                        <a href="">FutureCoders</a>
                        <span>10M Views • 3 Months Ago</span>
                    </div>
                </div>
            </div>
            <!-- Single Video Ends -->
            <?php

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