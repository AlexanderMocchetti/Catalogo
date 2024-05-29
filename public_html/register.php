<?php
require_once "../config/fuction.php";

$error_msg = false;

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $username = $_POST["username"];
    $email = $_POST["email"];
    $password = $_POST["password"];

    $user = array(
            "username" => $username,
            "email" => $email,
            "password" => $password
    );

    if (presente($user)) {
        $error_msg = true;
        $msg = "Utente esistente";
    } else {
        aggiungiUtente($user);
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

    <div class="header__icons">
        <a href="/catalog.php"><i class="material-icons">home</i></a>
        <a href="/history.php"><i class="material-icons">history</i></a>
        <a href="/profilo.php"><i class="material-icons display-this">account_circle</i></a>
    </div>
</div>
<!-- Header Ends -->

<!-- Main Body Starts -->
<div class="mainBody">

    <div class="glass-container">
        <div class="login-box">
            <h2>Registrati</h2>
            <form action="#" method="POST">

                <input type="email" id="email" name="email" required placeholder="Inserisci email">

                <input type="text" id="username" name="username" required placeholder="Inserisci username">

                <input type="password" id="password" name="password" required placeholder="Inserisci password">


                <button type="submit">Registrati</button>

                <p>Hai già un account?<a href="login.php" id="login"> Login</a></p>
            </form>
            <p><?php
            if ($error_msg)
                echo $msg;
                ?></p>
        </div>
    </div>
</body>

</html>