<?php
include_once "../php_functions/php_functions.php";
if(isset($_SESSION)){
    session_destroy();
}
?>

<!DOCTYPE html>
<html lang="hu">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="A CodeOverflow felkéréseinek felülete.">
    <title>Felkérés</title>
    <link rel="stylesheet" href="./css/requests.css">
    <link rel="icon" type="image/x-icon" href="./icon.png">
    <script type="module" src="./js/requests.js" defer></script>
</head>
<body>
    <?php include "navbar.php"; ?> 
    <?php include "loader.html"; ?>
</body>