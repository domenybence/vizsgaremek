<?php
include_once "../php_functions/php_functions.php";
if(session_status() === PHP_SESSION_NONE) {
    startSession();
}
<<<<<<< HEAD

$data = preparedGetdata("SELECT felkeres.id, felkeres.nev, felkeres.leiras, felkeres.statusz, felkeres.ar, felkeres.hatarido, felkeres.feltoltesi_ido, felkeres.kod_minta, felkeres.felhasznalo_id, felkeres.elvallalo_felhasznalo_id, felkeres.beadott_kod, felhasznalo.nev AS username FROM felkeres  INNER JOIN felhasznalo ON felkeres.felhasznalo_id = felhasznalo.id WHERE felkeres.id = ?;", "i", [$request]);

if (!$data) {
    header("Location: 404.html");
    exit();
}

$data = $data[0];
$sessionUserid = $_SESSION["userid"];

$sessionUserid == $data["felhasznalo_id"] ? $isOwner = true : $isOwner = false;
$sessionUserid == $data["elvallalo_felhasznalo_id"] ? $isAssigned = true : $isAssigned = false;

if (!$isOwner && !$isAssigned && ($_SESSION["role"] !== "admin" || $_SESSION["role"] !== "moderator")) {
    header("Location: /vizsgaremek/src/web/404.html");
    exit();
}
!$isOwner && $data["statusz"] === "nyitott" ? $canAccept = true : $canAccept = false;
$data["elvallalo_felhasznalo_id"] == $sessionUserid ? $isSubmitted = true : $isSubmitted = false;

=======
$data = preparedGetData("SELECT felkeres.nev AS requestname, felkeres.leiras AS description, felhasznalo.nev AS username, felkeres.elvallalo_felhasznalo_id AS assignee_id, felkeres.feltoltesi_ido AS uploadtime, felkeres.ar AS offered_price FROM felkeres INNER JOIN kod ON felkeres.kod_id = kod.id INNER JOIN felhasznalo ON felhasznalo.id = felkeres.felhasznalo_id WHERE felkeres.id = ?;", "i", [$request]);
$requestname = $data[0]["requestname"];
$username = $data[0]["username"];
$uploadtime = $data[0]["uploadtime"];
$payment = $data[0]["offered_price"];
$description = $data[0]["description"];
$assigneeid = $data[0]["assignee_id"];
$userid = preparedGetData("SELECT felhasznalo.id FROM felhasznalo WHERE felhasznalo.nev = ?;", "s", [$_SESSION["username"]])[0]["id"];
>>>>>>> 6ddc53096dcecddf0fe15ad01063e2dbf417fd68
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
<<<<<<< HEAD
    <link rel="stylesheet" href="/vizsgaremek/src/web/css/navbar.css">
    <link rel="icon" type="image/x-icon" href="/vizsgaremek/src/web/icon.png">
    <script src="/vizsgaremek/src/web/js/navbar.js" defer></script>
    <script src="/vizsgaremek/src/web/js/requests.js" defer></script>
    <script>
        const requestid = <?php echo $request; ?>;
=======
    <script>
        const userId = <?php echo json_encode($userid); ?>;
        const requestId = <?php echo json_encode($request); ?>;
>>>>>>> 6ddc53096dcecddf0fe15ad01063e2dbf417fd68
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
                <h1><?php echo htmlspecialchars($data["nev"]); ?></h1>
                <span class="status <?php echo $data["statusz"]; ?>">
                    <?php echo getStatusText($data["statusz"]); ?>
                </span>
            </div>
            <div class="title-wrapper">
                <div class="title-item">
                    <label>Feltöltő:</label>
                    <span><?php echo htmlspecialchars($data["username"]); ?></span>
                </div>
                <div class="title-item">
                    <label>Feltöltés ideje:</label>
                    <span><?php echo formatDate($data["feltoltesi_ido"]); ?></span>
                </div>
                <div class="title-item">
                    <label>Határidő:</label>
                    <span><?php echo formatDate($data["hatarido"]); ?></span>
                </div>
                <div class="title-item">
                    <label>Díjazás:</label>
                    <span><?php echo number_format($data["ar"]); ?> pont</span>
                </div>
            </div>
            <div class="content">
                <h3>Leírás</h3>
                <div class="description">
                    <?php echo nl2br(htmlspecialchars($data["leiras"])); ?>
                </div>
            </div>
<<<<<<< HEAD
            <div class="actions">
                <?php if($canAccept) {
                    echo    '<button class="button primary accept-request">
                                Felkérés elvállalása
                            </button>';
                }
                if($isSubmitted && $data["statusz"] === "folyamatban") {
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
=======
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
            <?php if($assigneeid === null) echo '
                <div class="inline-group">
                    <button class="upload-button">Felkérés elvállalása</button>
                </div>
            '; ?>
>>>>>>> 6ddc53096dcecddf0fe15ad01063e2dbf417fd68
        </div>
    </div>
    <script src="/vizsgaremek/src/web/js/loader.js"></script>
</body>
</html>