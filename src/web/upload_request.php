<?php
include_once "../php_functions/php_functions.php";
if(session_status() === PHP_SESSION_NONE) {
    startSession();
}

if($_SESSION["username"] === "Vendég") {
    header("Location: /vizsgaremek/src/web/login.php");
    exit();
}
?>
<!DOCTYPE html>
<html lang="hu">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Felkérés létrehozása</title>
    <link rel="stylesheet" href="/vizsgaremek/src/web/css/upload_request.css">
    <link rel="stylesheet" href="/vizsgaremek/src/web/css/loader.css">
    <link rel="stylesheet" href="/vizsgaremek/src/web/css/navbar.css">
    <link rel="icon" type="image/x-icon" href="/vizsgaremek/src/web/icon.png">
    <script src="/vizsgaremek/src/web/js/navbar.js" defer></script>
    <script src="/vizsgaremek/src/web/js/upload_request.js" defer></script>
</head>
<body>
    <script src="/vizsgaremek/src/web/js/gsap-public/minified/gsap.min.js"></script>

    <div class="page-cover"></div>
    
    <?php include "navbar.php"; ?>
    
    <div class="container">
        <div class="content">
            <div class="request-header">
                <h1>Új felkérés létrehozása</h1>
            </div>
            
            <form id="request-form" class="edit-form" onsubmit="event.preventDefault();">
                <div class="form-group">
                    <label for="request-title">Cím</label>
                    <input type="text" id="request-title" class="form-control">
                </div>
                
                <div class="form-group">
                    <label for="request-category">Kategória</label>
                    <select id="request-category" class="form-control">
                        <option value="">Betöltés...</option>
                    </select>
                </div>
                
                <div class="form-group">
                    <label for="request-price">Díjazás (pont)</label>
                    <input type="number" id="request-price" class="form-control" min="0" value="0">
                </div>
                
                <div class="form-group">
                    <label for="request-deadline">Határidő</label>
                    <input type="date" id="request-deadline" class="form-control" value="" data-date-format="YYYY-MM-DD">
                </div>
                
                <div class="form-group">
                    <label for="request-description">Leírás</label>
                    <textarea id="request-description" class="form-control" rows="6"></textarea>
                </div>
                
                <div id="message-container"></div>
                
                <div class="button-group">
                    <button type="button" id="create-request-btn" class="button success">Felkérés létrehozása</button>
                </div>
            </form>
        </div>
    </div>
    
    <script src="/vizsgaremek/src/web/js/loader.js"></script>
</body>
</html>