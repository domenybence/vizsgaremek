<?php

include_once "../php_functions/php_functions.php";
include '../php_functions/adatbazis_lekeres.php';
if (session_status() === PHP_SESSION_NONE) {
  startSession();
}

// Redirect if not logged in
if(!isset($_SESSION["userid"])) {
    header("Location: /bejelentkezes");
    exit;
}
?>

<!DOCTYPE html>
<html lang="hu">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Feltöltés - CodeOverflow</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="/src/web/css/upload.css">
    <link rel="icon" type="image/x-icon" href="/src/web/icon.png">
    <script src="/src/web/js/navbar.js" defer></script>
    <link rel="stylesheet" href="/src/web/css/navbar.css">
    <link rel="stylesheet" href="/src/web/css/loader.css">
</head>
<body class="bg-dark text-light" style="padding-top: 100px;">
    <script src="/src/web/js/gsap-public/minified/gsap.min.js"></script>
    <div class="page-cover"></div>

    <?php include "navbar.php"; ?>
   
    <div class="container mt-4">
        <div class="row justify-content-center">
            <div class="col-lg-6 col-md-8 col-sm-12">
                <div class="card bg-light text-dark shadow-lg p-4">
                    <h2 class="text-center mb-4">Szoftver Feltöltése</h2>
                    <form enctype="multipart/form-data" action="/src/web/upload_file.php" method="POST">
                        <div class="mb-3">
                            <label for="softwareName" class="form-label">Szoftver Neve</label>
                            <input type="text" class="form-control" id="nevInput" name="softwareName" required>
                        </div>
                        <div class="mb-3">
                            <label for="softwarePrice" class="form-label">Szoftver Ára</label>
                            <input type="number" class="form-control" id="arInput" name="softwarePrice" required min="0" value="0">
                        </div>
                        <div class="mb-3">
                            <label for="category" class="form-label">Kategória</label>
                            <select class="form-select" id="katInput" name="category" required></select>
                        </div>
                        <div class="mb-3">
                            <label for="fileToUpload" class="form-label">Fájl Feltöltése</label>
                            <input class="form-control" type="file" id="fileToUpload" name="fileToUpload" required>
                        </div>
                        <button type="submit" class="btn btn-primary w-100">Feltöltés</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <div id="toast-message" class="toast-message"></div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="/src/web/js/upload.js"></script>
    <script src="/src/web/js/loader.js"></script>
</body>
</html>