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
    <title>Könyvtár</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="css/upload.css">
    <link rel="icon" type="image/x-icon" href="./icon.png">
    <script src="./js/navbar.js" defer></script>
    <link rel="stylesheet" href="./css/navbar.css">
    <script src="./js/gsap-public/minified/gsap.min.js" defer></script>
    <link rel="stylesheet" href="./css/loader.css">
</head>
<body class="bg-dark text-light" style="padding-top: 100px;">
<script src="/vizsgaremek/src/web/js/gsap-public/minified/gsap.min.js"></script>
    <div class="page-cover"></div>

    <?php include "navbar.php"; ?>

    <div class="container mt-4">
        <div class="row justify-content-center">
            <div class="col-lg-6 col-md-8 col-sm-12">
                <div class="card bg-light text-dark shadow-lg p-4">
                    <h2 class="text-center mb-2">Könyvtár</h2>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <div class="container mt-4">
        <div class="row justify-content-center">
            <div class="col-lg-6 col-md-8 col-sm-12">
                <div class="card bg-light text-dark shadow-lg p-4">
                    <input class="form-control me-2 mb-2" id="kereso" type="search" placeholder="Megvásárolt Szoftver keresése">
                    <button class="btn btn-outline-primary" id="keresobtn" type="button">Keresés</button>
                    
                </div>
            </div>
        </div>
    </div>

    <div class="container mt-4">
        <div class="row justify-content-center">
            <div class="col-lg-6 col-md-8 col-sm-12">
                <div class="bg-light text-dark shadow-lg p-4">
                   
               <div class="row mt-3" id="szoftverek"></div>
                </div>
            </div>
        </div>
    </div>


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="js/library.js"></script>
    <script src="/vizsgaremek/src/web/js/loader.js"></script>
</body>
</html>