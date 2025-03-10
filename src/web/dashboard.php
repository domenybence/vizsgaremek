<?php
include_once "loader.html";
include_once "../php_functions/php_functions.php";
if(session_status() === PHP_SESSION_NONE) {
    startSession();
}

?>
<!DOCTYPE html>
<html lang="hu">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Főoldal</title>
    <script src="./js/navbar.js" defer></script>
    <link rel="stylesheet" href="./css/navbar.css">
    <link rel="stylesheet" href="./css/loader.css">
</head>
<body>
    <?php include "navbar.php"; ?>
    <h1>Üdvözlet,
        <?php
        echo $_SESSION["username"];
        ?>
    (
        <?php
        echo $_SESSION["role"];
        ?>
    )!</h1>
    <hr>
    <?php
        if(isset($_COOKIE["rememberme"])) { echo $_COOKIE["rememberme"]; }
        ?>
    <br>
    <a href="./registration.php">Regisztráció</a>
    <a href="./login.php">Bejelentkezés</a>
    <a href="./code.php">Kód</a>
    <form method="POST">
        <button type="submit" name="logout">Kijelentkezés</button>
    </form>
</body>
</html>