<?php
session_start();

if (isset($_SESSION["user_id"])) {
    header("Location: /catalog.php");
    die;
}

require_once "../config/fuction.php";
$error_msg = false;

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $email = $_POST["email"];
    $password = $_POST["password"];

    $user = array("email" => $email,
        "password" => $password
    );

    if (!presente($user)) {
        $error_msg = true;
        $msg = "Utente non esistente";
    } else if ($user_id = credenzialiValide($user)) {
        $_SESSION["user_id"] = $user_id;
        header("Location: catalog.php");
        die;
    } else {
        $error_msg = true;
        $msg = "Email o password incorretta";
    }
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Huborto</title>
    <link rel="stylesheet" href="login.css">
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

    <!-- <div class="header__search">
        <form action=""> TODO add action
            <input placeholder="Cosa vuoi guardare?" class="search" name="text" type="text">
        </form>
    </div> -->

</div>
<!-- Header Ends -->

<!-- Main Body Starts -->
<div class="mainBody">

    <div class="glass-container">
        <div class="login-box">
            <h2>Accedi</h2>
            <form action="#" method="POST">

                <input type="email" id="email" name="email" required placeholder="Inserisci email">

                <input type="password" id="password" name="password" required placeholder="Inserisci password">


                <button type="submit">Accedi</button>
                <p>Non hai un account?<a href="register.php" id="register"> Registrati</a></p>
            </form>
            <p><?php
                if ($error_msg)
                    echo $msg;
                ?></p>
        </div>
    </div>
    <!-- Sidebar Starts -->

    <!-- <div class="sidebar">
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
        <hr/>
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
        <hr/>
    </div> -->


    <!-- <div class="video">
        <div class="video__thumbnail">
          <img public_html="https://img.youtube.com/vi/YpTmcCBBdTE/maxresdefault.jpg" alt="" />
        </div>
        <div class="video__details">
          <div class="author">
            <img public_html="profile.png" alt="" />
          </div>
          <div class="title">
            <h3>Build A Password Generator with React JS - Beginners Tutorial</h3>
            <a href="">FutureCoders</a>
            <span>10M Views • 3 Months Ago</span>
          </div>
        </div>
      </div> -->
</body>

</html>