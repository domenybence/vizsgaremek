<?php
include_once "../php_functions/php_functions.php";
?>
<!DOCTYPE html>
<html lang="hu">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pontok feltöltése</title>
    <link rel="stylesheet" href="/vizsgaremek/src/web/css/credsupload.css">
    <link rel="icon" type="image/x-icon" href="./icon.png">
    <script src="./js/credsupload.js" defer></script>
    <script src="./js/navbar.js" defer></script>
    <link rel="stylesheet" href="./css/navbar.css">
    <link rel="stylesheet" href="./css/loader.css">
</head>
<body>
    <script src="/vizsgaremek/src/web//js/gsap-public/minified/gsap.min.js"></script>
    <div class="page-cover">
        <h1 class="page-cover-title">Betöltés...</h1>
    </div>
    <?php include "navbar.php"; ?>
    <?php $price = simpleGetData("SELECT * FROM pont_ar"); ?>
    <script>const price = <?php echo json_encode($price[0]["ar"]) ?></script>
        <div class="container">
            <div class="column">
                <h1 class="page-title">Pontok feltöltése</h1>
                <span>Pontok száma</span>
                <input type="number" id="points" class="num-input" default="0" min="1">
                <span>Ár</span>
                <input type="number" id="price" class="num-input" default="0" min="1">
                <button type="button" class="button-input">Vásárlás</button>
                <div id="message-container"></div>
            </div>
        </div>
    <script src="/vizsgaremek/src/web/js/loader.js"></script>
</body>
</html>