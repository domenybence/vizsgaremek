<?php
include_once "../php_functions/php_functions.php";
if(session_status() === PHP_SESSION_NONE) {
    startSession();
}

$data = preparedGetdata("SELECT felkeres.id AS requestid, felkeres.nev AS requestname, felkeres.leiras AS description, felkeres.statusz AS status, felkeres.ar AS price, felkeres.hatarido AS deadline, felkeres.feltoltesi_ido AS uploadtime, felkeres.felhasznalo_id AS userid, felkeres.elvallalo_felhasznalo_id AS assigneeid, felhasznalo.nev AS username FROM felkeres  INNER JOIN felhasznalo ON felkeres.felhasznalo_id = felhasznalo.id WHERE felkeres.id = ?;", "i", [$request]);

if (!$data) {
    header("Location: 404.html");
    exit();
}

$data = $data[0];
$sessionUserid = $_SESSION["userid"];

$sessionUserid == $data["userid"] ? $isOwner = true : $isOwner = false;
$sessionUserid == $data["assigneeid"] ? $isAssigned = true : $isAssigned = false;

if (!$isOwner && !$isAssigned && ($_SESSION["role"] !== "admin" || $_SESSION["role"] !== "moderator")) {
    header("Location: /vizsgaremek/src/web/404.html");
    exit();
}
!$isOwner && $data["status"] === "nyitott" ? $canAccept = true : $canAccept = false;
$data["assigneeid"] == $sessionUserid ? $isSubmitted = true : $isSubmitted = false;

?>

<!DOCTYPE html>
<html lang="hu">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="A CodeOverflow felkéréseinek felülete.">
    <title>Felkérések</title>
    <link rel="stylesheet" href="/vizsgaremek/src/web/css/requests.css">
    <link rel="stylesheet" href="/vizsgaremek/src/web/css/loader.css">
    <link rel="stylesheet" href="/vizsgaremek/src/web/css/navbar.css">
    <link rel="icon" type="image/x-icon" href="/vizsgaremek/src/web/icon.png">
    <script src="/vizsgaremek/src/web/js/navbar.js" defer></script>
    <script src="/vizsgaremek/src/web/js/requests.js" defer></script>
    <script>
        const requestid = <?php echo $request; ?>;
    </script>
</head>
<body>
    <script src="/vizsgaremek/src/web/js/gsap-public/minified/gsap.min.js"></script>
    <div class="page-cover">
        <h1 class="page-cover-title">Betöltés...</h1>
    </div>
    <?php include "navbar.php"; ?>
    <div class="container">
        <div class="content">
            <div class="request-header">
                <h1><?php echo htmlspecialchars($data["requestname"]); ?></h1>
                <span class="status <?php echo $data["status"]; ?>">
                    <?php echo getStatusText($data["status"]); ?>
                </span>
            </div>
            <div class="title-wrapper">
                <div class="title-item">
                    <label>Feltöltő:</label>
                    <span><?php echo htmlspecialchars($data["username"]); ?></span>
                </div>
                <div class="title-item">
                    <label>Feltöltés ideje:</label>
                    <span><?php echo formatDate($data["uploadtime"]); ?></span>
                </div>
                <div class="title-item">
                    <label>Határidő:</label>
                    <span><?php echo formatDate($data["deadline"]); ?></span>
                </div>
                <div class="title-item">
                    <label>Díjazás:</label>
                    <span><?php echo number_format($data["price"]); ?> pont</span>
                </div>
            </div>
            <div class="content">
                <h3>Leírás</h3>
                <div class="description">
                    <?php echo nl2br(htmlspecialchars($data["description"])); ?>
                </div>
            </div>
            <div class="actions">
                <?php if($canAccept) {
                    echo    '<button class="button primary accept-request">
                                Felkérés elvállalása
                            </button>';
                }
                if($isSubmitted && $data["status"] === "folyamatban") {
                    echo    '<button class="button primary submit-solution">
                                Kód beküldése
                            </button>';
                }
                if($isOwner && $data["beadott_kod"]) {
                    echo    '<div class="review-actions">
                                <button class="button success accept-solution">Elfogadás</button>
                                <button class="button danger reject-solution">Elutasítás</button>
                            </div>';
                }
                ?>
            </div>
        </div>
    </div>
    <script src="/vizsgaremek/src/web/js/loader.js"></script>
</body>
</html>