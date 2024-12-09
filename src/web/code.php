<?php
include_once "../php_functions/db_functions.php";
startSession();
?>

<!DOCTYPE html>
<html lang="hu">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content=".">
    <title>Kód</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,100..900;1,100..900&display=swap" rel="stylesheet">
    <link rel="icon" type="image/x-icon" href="./icon.png">
    <link rel="stylesheet" href="./css/code.css">
</head>
<body>
    <div class="main">
        <div class="title-wrapper">
            <div class="title-item-wrapper">
                <div class="title-group">
                    <div class="title-item">Feltöltő</div>
                    <div class="title-item">domebence</div>
                </div>
                <hr>
                <div class="title-group">
                    <div class="title-item">Kód neve</div>
                    <div class="title-item">Teszt kódnév</div>
                </div>
                <hr>
                <div class="title-group">
                    <div class="title-item">Kategóriák</div>
                    <div class="title-item">HTML, JavaScript, PHP</div>
                </div>
                <hr>
                <div class="title-group">
                    <div class="title-item">Feltöltés ideje</div>
                    <div class="title-item">2024.12.05.</div>
                </div>
            </div>
        </div>
        <!-- editor import -->
        <div id="container"></div>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/monaco-editor/0.34.1/min/vs/loader.js"></script>
        <script src="./js/createCompiler.js"></script>
        <script>createCompiler("container");</script>
    </div>
</body>
</html>
