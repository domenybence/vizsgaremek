<?php
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
    <meta name="description" content="A CodeOverflow felkéréseinek felülete.">
    <title>Felkérés</title>
    <link rel="stylesheet" href="./css/requests.css">
    <link rel="icon" type="image/x-icon" href="./icon.png">
    <script type="module" src="./js/requests.js" defer></script>
    <script src="./js/navbar.js" defer></script>
    <link rel="stylesheet" href="./css/navbar.css">
    <link rel="stylesheet" href="./css/loader.css">
</head>
<body>
    <?php include "navbar.php"; ?>
    <script src="/vizsgaremek/src/web//js/gsap-public/minified/gsap.min.js"></script>
    <div class="page-cover">
        <h1 class="page-cover-title">Betöltés...</h1>
    </div>
    <div class="container">
        <div class="content">
            <div class="inline-group">
                <div class="inline-item">
                    asd
                </div>
            </div>
        </div>
        <div class="inline-group">
            <div class="inline-item">
                <p>asd</p>
            </div>
        </div>
        <div class="inline-group">
            <div class="inline-item">
                <p>asd</p>
            </div>
        </div>
        <div class="inline-group">
            <div class="inline-item">
                <p>asd</p>
            </div>
        </div>
        <div class="inline-group">
            <div class="inline-item">
                <p>asd</p>
            </div>
        </div>
    </div>
    <script src="/vizsgaremek/src/web/js/loader.js"></script>
</body>