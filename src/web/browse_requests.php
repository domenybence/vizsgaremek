<?php
include_once "../php_functions/php_functions.php";
if(session_status() === PHP_SESSION_NONE) {
    startSession();
}

if(!isset($_SESSION["userid"])) {
    header("Location: /bejelentkezes");
    exit;
}

$userId = $_SESSION["userid"];
$isAdmin = isset($_SESSION["role"]) && $_SESSION["role"] === "admin";
$isModerator = isset($_SESSION["role"]) && $_SESSION["role"] === "moderator";
$requests = [];

if($isAdmin || $isModerator) {
    $result = simpleGetData("SELECT felkeres.*, felhasznalo.nev AS username, kategoria.nev AS kategoria FROM felkeres INNER JOIN felhasznalo ON felkeres.felhasznalo_id = felhasznalo.id LEFT JOIN kategoria ON felkeres.kategoria_id = kategoria.id ORDER BY felkeres.feltoltesi_ido DESC");
    if($result) {
        $requests = $result;
    }
}
else {
    $result = preparedGetData("SELECT felkeres.*, felhasznalo.nev AS username, kategoria.nev AS kategoria FROM felkeres 
        INNER JOIN felhasznalo ON felkeres.felhasznalo_id = felhasznalo.id 
        LEFT JOIN kategoria ON felkeres.kategoria_id = kategoria.id 
        WHERE (felkeres.felhasznalo_id = ? OR felkeres.elvallalo_felhasznalo_id = ? OR 
              (felkeres.statusz = 'nyitott' AND felkeres.elvallalo_felhasznalo_id IS NULL))
        AND felkeres.jovahagyott = 1  
        ORDER BY felkeres.feltoltesi_ido DESC", "ii", [$userId, $userId]);
    if($result) {
        $requests = $result;
    }
}
?>

<!DOCTYPE html>
<html lang="hu">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="A CodeOverflow oldalának felkérésböngésző oldala.">
    <title>Felkérések böngészése</title>
    <link rel="stylesheet" href="/src/web/css/browse_requests.css">
    <link rel="stylesheet" href="/src/web/css/navbar.css">
    <link rel="stylesheet" href="/src/web/css/loader.css">
    <link rel="icon" type="image/x-icon" href="/src/web/icon.png">
    <script src="/src/web/js/browse_requests.js" defer></script>
    <script src="/src/web/js/navbar.js" defer></script>
</head>
<body>
    <script src="/src/web/js/gsap-public/minified/gsap.min.js"></script>
    <div class="page-cover"></div>
    <?php include "navbar.php"; ?>
    <div class="container">
        <div class="request-wrapper">
            <?php if(empty($requests)): ?>
                <div class="no-requests-message">
                    <p>Nincs megjeleníthető felkérés.</p>
                </div>
            <?php else: ?>
                <?php foreach($requests as $request): ?>
                    <div class="request-card" data-request-id="<?php echo $request["id"]; ?>">
                        <div class="request-header">
                            <h2><?php echo htmlspecialchars($request["nev"]); ?></h2>
                            <span class="status <?php echo $request["statusz"]; ?>">
                                <?php echo getStatusText($request["statusz"]); ?>
                            </span>
                        </div>
                        <div class="request-info">
                            <div class="info-item">
                                <label>Feltöltő:</label>
                                <span><?php echo htmlspecialchars($request["username"]); ?></span>
                            </div>
                            <div class="info-item">
                                <label>Kategória:</label>
                                <span><?php echo htmlspecialchars($request["kategoria"]); ?></span>
                            </div>
                            <div class="info-item">
                                <label>Díjazás:</label>
                                <span><?php echo number_format($request["ar"]); ?> pont</span>
                            </div>
                            <div class="info-item">
                                <label>Feltöltés ideje:</label>
                                <span><?php echo formatDate($request["feltoltesi_ido"]); ?></span>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            <?php endif; ?>
        </div>
    </div>
    <script src="/src/web/js/loader.js"></script>
</body>
</html>