<?php

include_once "../php_functions/php_functions.php";

startSession();

?>
<!DOCTYPE html>
<html lang="hu">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Főoldal</title>
</head>
<body>
    
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

<?php

if(isset($_POST["logout"])){
    unsetCookie();
    session_unset();
    session_destroy();
    exit();
}

?>