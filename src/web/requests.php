<?php
include_once "../php_functions/php_functions.php";
if(session_status() === PHP_SESSION_NONE) {
    startSession();
}

$data = preparedGetdata("SELECT felkeres.id AS requestid, felkeres.nev AS requestname, 
    felkeres.leiras AS description, felkeres.statusz AS status, felkeres.ar AS price, 
    felkeres.hatarido AS deadline, felkeres.feltoltesi_ido AS uploadtime, 
    felkeres.felhasznalo_id AS userid, felkeres.elvallalo_felhasznalo_id AS assigneeid, 
    felkeres.kod_eleresi_ut,
    felhasznalo.nev AS username, kategoria.compiler_azonosito AS compilerid 
    FROM felkeres 
    INNER JOIN felhasznalo ON felkeres.felhasznalo_id = felhasznalo.id 
    INNER JOIN kategoria ON kategoria.id = felkeres.kategoria_id 
    WHERE felkeres.id = ?;", "i", [$request]);

if(!$data) {
    header("Location: 404.html");
    exit();
}

$data = $data[0];
$sessionUserid = $_SESSION["userid"];

$sessionUserid == $data["userid"] ? $isOwner = true : $isOwner = false;
$sessionUserid == $data["assigneeid"] ? $isAssigned = true : $isAssigned = false;

$isAdmin = $_SESSION["role"] === "admin";
$isModerator = $_SESSION["role"] === "moderator";
$requestIsPublic = $data["status"] === "nyitott";

if(!$isOwner && !$isAssigned && !$isAdmin && !$isModerator && !$requestIsPublic) {
    header("Location: /vizsgaremek/src/web/404.html");
    exit();
}

!$isOwner && $data["status"] === "nyitott" ? $canAccept = true : $canAccept = false;
$data["assigneeid"] == $sessionUserid ? $isSubmitted = true : $isSubmitted = false;
$canEdit = $isOwner && $data["status"] === "nyitott";

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
                <h1 id="request-title"><?php echo htmlspecialchars($data["requestname"]); ?></h1>
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
                    <span id="deadline-display"><?php echo formatDate($data["deadline"]); ?></span>
                </div>
                <div class="title-item">
                    <label>Díjazás:</label>
                    <span id="price-display"><?php echo number_format($data["price"]); ?> pont</span>
                </div>
            </div>
            <div class="content">
                <h3>Leírás</h3>
                <div class="description" id="description-display">
                    <?php echo nl2br(htmlspecialchars($data["description"])); ?>
                </div>
            </div>
            
            <?php if($canEdit): ?>
            <div class="edit-section">
                <button id="edit-request-btn" class="button primary">Szerkesztés</button>
                
                <div id="edit-form" class="edit-form" style="display: none;">
                    <h3>Felkérés szerkesztése</h3>
                    <div class="form-group">
                        <label for="edit-title">Cím</label>
                        <input type="text" id="edit-title" class="form-control" value="<?php echo htmlspecialchars($data["requestname"]); ?>">
                    </div>
                    <div class="form-group">
                        <label for="edit-price">Díjazás (pont)</label>
                        <input type="number" id="edit-price" class="form-control" value="<?php echo $data["price"]; ?>">
                    </div>
                    <div class="form-group">
                        <label for="edit-deadline">Határidő</label>
                        <input type="date" id="edit-deadline" class="form-control" value="<?php echo date('Y-m-d', strtotime($data["deadline"])); ?>">
                    </div>
                    <div class="form-group">
                        <label for="edit-description">Leírás</label>
                        <textarea id="edit-description" class="form-control" rows="6"><?php echo htmlspecialchars($data["description"]); ?></textarea>
                    </div>
                    <div class="button-group">
                        <button id="cancel-edit-btn" class="button secondary">Mégse</button>
                        <button id="save-edit-btn" class="button success">Mentés</button>
                    </div>
                </div>
            </div>
            <?php endif; ?>
            
            <?php if($isAssigned && ($data["status"] === "folyamatban")): ?>
            <div class="editor-section">
                <div class="editor-header">
                    <h3>Kód szerkesztése</h3>
                </div>
                <div id="monaco-editor" style="width:100%; height:500px; border:1px solid #444; border-radius: 4px;"></div>
            <?php 
                $fileExtension = $data["compilerid"];
                $initialCode = "";
                if(!empty($data["kod_eleresi_ut"]) && file_exists("codes/" . $data["kod_eleresi_ut"])) {
                    $initialCode = file_get_contents("codes/" . $data["kod_eleresi_ut"]);
                }
            ?>
                <script src="https://cdnjs.cloudflare.com/ajax/libs/require.js/2.3.6/require.min.js"></script>
                <script src="/vizsgaremek/src/web/js/compiler.js"></script>
                <script>
                    const fileExtension = "<?php echo $fileExtension; ?>";
                    const fileContent = <?php echo json_encode($initialCode); ?>;
                    document.addEventListener("DOMContentLoaded", () => {
                        createCompiler("monaco-editor", false);
                        const acceptSolutionButton = document.querySelector(".accept-solution");
                        const rejectSolutionButton = document.querySelector(".reject-solution");
                        if(acceptSolutionButton) {
                            acceptSolutionButton.addEventListener("click", () => acceptSolution(requestId));
                        }
                        if(rejectSolutionButton) {
                            rejectSolutionButton.addEventListener("click", () => rejectSolution(requestId));
                        }
                    });
                </script>
                <div class="button-container">
                    <button id="save-solution" class="button primary">Kód mentése</button>
                    <button class="button success submit-solution">Megoldás beküldése</button>
                </div>
            </div>
            <?php endif; ?>
            <div class="actions">
                <?php if($canAccept) {
                    echo    '<button class="button primary accept-request">
                                Felkérés elvállalása
                            </button>';
                }
                
                if($isOwner && $data["status"] === "teljesitve" && !empty($data["kod_eleresi_ut"])) {
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