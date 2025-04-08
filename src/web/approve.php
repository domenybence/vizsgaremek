<?php
include_once "../php_functions/php_functions.php";
if(session_status() === PHP_SESSION_NONE) {
    startSession();
}

if($_SESSION["role"] !== "admin" && $_SESSION["role"] !== "moderator") {
    header("Location: /");
    exit();
}
?>
<!DOCTYPE html>
<html lang="hu">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Jóváhagyások - CodeOverflow</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="/src/web/css/approve.css">
    <link rel="stylesheet" href="/src/web/css/navbar.css">
    <link rel="stylesheet" href="/src/web/css/loader.css">
    <link rel="icon" type="image/x-icon" href="/src/web/icon.png">
    <script src="/src/web/js/navbar.js" defer></script>
</head>
<body class="bg-dark text-light">
    <script src="/src/web/js/gsap-public/minified/gsap.min.js"></script>
    <div class="page-cover"></div>

    <?php include "navbar.php"; ?>

    <div class="container mt-5">
        <h1 class="mb-4">Jóváhagyásra váró kódok</h1>
        
        <div class="alert alert-info">
            <strong>Információ:</strong> Itt láthatók a felhasználók által feltöltött, jóváhagyásra váró kódok.
            Jóváhagyás után a kód publikusan elérhetővé válik, elutasítás esetén törlődik a rendszerből.
        </div>
        
        <div class="row mt-3">
            <div class="col-md-6 mb-3">
                <input class="form-control" id="kereso" type="search" placeholder="Jóváhagyandó szoftver keresése">
            </div>
            <div class="col-md-2 mb-3">
                <button class="btn btn-primary w-100" id="keresobtn" type="button">Keresés</button>
            </div>
        </div>
        
        <div id="szoftverek" class="mt-4">
            <div class="d-flex justify-content-center">
                <div class="spinner-border text-light" role="status">
                    <span class="visually-hidden">Betöltés...</span>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="/src/web/js/approve.js"></script>
    <script src="/src/web/js/loader.js"></script>
</body>
</html>