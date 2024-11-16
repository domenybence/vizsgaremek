<?php

include_once "../php_functions/db_functions.php";

if (!isset($_SESSION["username"])) {
    header("Location: login.php");
    exit();
}

if($_SERVER["REQUEST_METHOD"] === "POST"){
    session_destroy();
    header("Location: dashboard.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="hu">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kijelentkezés</title>
</head>
<body>
    <form method="post">
        <button type="submit">Kijelentkezés</button>
    </form>
</body>
</html>