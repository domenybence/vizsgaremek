<?php

include_once "../php_functions/db_functions.php";

if (!isset($_SESSION['username'])) {
    header("Location: login.php");
    exit();
}

?>
<!DOCTYPE html>
<html lang="hu">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>főoldal</title>
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
    <a href="./registration.php">Regisztráció</a>
    <a href="./login.php">Bejelentkezés</a>
    <form method="POST">
        <button type="submit" name="logout">Kijelentkezés</button>
    </form>
</body>
</html>

<?php

if(isset($_POST["logout"])){
    session_destroy();
    header("Location: dashboard.php");
    exit();
}

?>