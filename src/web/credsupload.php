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
    <title>Pontok feltöltése</title>
    <link rel="stylesheet" href="src/web/css/credsupload.css">
    <link rel="icon" type="image/x-icon" href="src/web/icon.png">
    <script src="./src/web/js/credsupload.js" defer></script>
    <script src="./src/web/js/navbar.js" defer></script>
    <link rel="stylesheet" href="./src/web/css/navbar.css">
    <link rel="stylesheet" href="./src/web/css/loader.css">
</head>
<body>
    <script src="src/web/js/gsap-public/minified/gsap.min.js"></script>
    <div class="page-cover"></div>
    <?php
    include "navbar.php";
    $price = simpleGetData("SELECT * FROM pont_ar"); ?>
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
    <script src="/src/web/js/loader.js"></script>
</body>
</html>