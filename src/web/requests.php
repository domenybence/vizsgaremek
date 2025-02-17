<?php
include_once "../php_functions/php_functions.php";
if(session_status() === PHP_SESSION_NONE) {
    startSession();
}
$data = preparedGetData("SELECT felkeres.nev AS requestname, felkeres.leiras AS description, felhasznalo.nev AS username, felkeres.feltoltesi_ido AS uploadtime, felkeres.ar AS payment FROM felkeres INNER JOIN kod ON felkeres.kod_id = kod.id INNER JOIN felhasznalo ON felhasznalo.id = felkeres.felhasznalo_id WHERE felkeres.id = ?;", "i", [$request]);
$requestname = $data[0]["requestname"];
$username = $data[0]["username"];
$uploadtime = $data[0]["uploadtime"];
$payment = $data[0]["payment"];
$description = $data[0]["description"];
?>

<!DOCTYPE html>
<html lang="hu">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="A CodeOverflow felkéréseinek felülete.">
    <title>Felkérések</title>
    <link rel="stylesheet" href="/vizsgaremek/src/web/css/requests.css">
    <link rel="icon" type="image/x-icon" href="/vizsgaremek/src/web/icon.png">
    <script type="module" src="/vizsgaremek/src/web/js/requests.js" defer></script>
    <script src="/vizsgaremek/src/web/js/navbar.js" defer></script>
    <link rel="stylesheet" href="/vizsgaremek/src/web/css/navbar.css">
    <link rel="stylesheet" href="/vizsgaremek/src/web/css/loader.css">
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
                    <p>Név</p>
                </div>
                <div class="inline-item">
                <p><?php echo $requestname ?></p>
                </div>
            </div>
            <div class="inline-group">
                <div class="inline-item">
                    <p>Feltöltés ideje</p>
                </div>
                <div class="inline-item">
                    <?php echo $uploadtime ?>
                </div>
            </div>
            <div class="inline-group">
                <div class="inline-item">
                    <p>Ár</p>
                </div>
                <div class="inline-item">
                    <?php echo $payment ?>
                </div>
            </div>
            <div class="inline-group">
                <div class="inline-item">
                    <?php echo $description ?>
                </div>
            </div>
            <div class="inline-group">
                <button class="upload-button">Felkérés feltöltése</button>
            </div>
        </div>
    </div>
    <script src="/vizsgaremek/src/web/js/loader.js"></script>
</body>