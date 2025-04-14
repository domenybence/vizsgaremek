<?php
include_once "../php_functions/php_functions.php";
include_once "./upload_likes.php";
if(session_status() === PHP_SESSION_NONE) {
    startSession();
}
$data = preparedGetData("SELECT felhasznalo.nev AS username, felhasznalo.id AS userid, kategoria.nev AS category, kategoria.compiler_azonosito AS category_altname, kod.feltoltesi_ido AS uploadtime, kod.nev AS codename, kod.eleresi_ut AS url, kod.ar AS price FROM felhasznalo INNER JOIN kod ON kod.felhasznalo_id = felhasznalo.id INNER JOIN kategoria ON kod.kategoria_id = kategoria.id WHERE kod.id = ?;", "i", [$codeid]);
$uploaderid = $data[0]["userid"];
$username = $data[0]["username"];
$category = $data[0]["category"];
$categoryaltname = $data[0]["category_altname"];
$uploadtime = $data[0]["uploadtime"];
$codename = $data[0]["codename"];
$fileurl = $data[0]["url"];
$price = $data[0]["price"];
if($_SESSION["username"] != "Vendég") $likeState = returnLikeState($_SESSION["userid"], $codeid);

$isOwned = false;
if($_SESSION["role"] == "admin") {
    $isOwned = true;
}
if($price === 0) {
    $isOwned = true;
}
else if($_SESSION["username"] != "Vendég") {
    if(preparedGetData("SELECT * FROM felhasznalo_megvett WHERE felhasznalo_id = ? AND kod_id = ?;", "ii", [$_SESSION["userid"], $codeid]) != false) {
        $isOwned = true;
    }
}
?>

<!DOCTYPE html>
<html lang="hu">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content=".">
    <title><?php echo $username . " - " . $codename?> - CodeOverflow</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link rel="icon" type="image/x-icon" href="/src/web/icon.png">
    <link rel="stylesheet" href="/src/web/css/navbar.css">
    <link rel="stylesheet" href="/src/web/css/loader.css">
    <link rel="stylesheet" href="/src/web/css/code.css">
    <script>
        const codeId = <?php echo json_encode($codeid) ?? 0 ?>;
        <?php if ($_SESSION["username"] != "Vendég"): ?>
                const userId = <?php echo json_encode($_SESSION["userid"]); ?>;
        <?php endif; ?>
        const uploaderId = <?php echo json_encode($uploaderid); ?>;
        const isOwned = <?php echo json_encode($isOwned); ?>;
    </script>
    <script src="/src/web/js/code.js" defer></script>
    <script src="/src/web/js/navbar.js" defer></script>
</head>
<body>
    <script src="/src/web/js/gsap-public/minified/gsap.min.js"></script>
    <div class="page-cover"></div>
    <?php include "navbar.php"; ?>
    <?php if(!$isOwned): ?>
        <?php if($_SESSION["username"] != "Vendég"): ?>
            <div class="body-container">
                <div class="main">
                    <div class="title-wrapper">
                        <div class="title-item-wrapper">
                            <div class="col">
                                <div class="title-group">
                                    <div class="title-item">
                                        <p class="likes" style="user-select: none;">
                                            <?php $codeLikes = getCodeLikes($codeid)[0]["likeCount"];
                                            if($codeLikes === null) {
                                                echo 0;
                                            }
                                            else {
                                                echo $codeLikes;
                                            } ?>
                                        </p>
                                    </div>
                                </div>
                            </div>
                            <div class="col">
                                <div class="col">
                                    <div class="title-group">
                                        <div class="title-item" style="user-select: none;">Feltöltő</div>
                                        <div class="title-item" style="user-select: none;"><?php echo $username; ?></div>
                                    </div>
                                    <hr>
                                    <div class="title-group">
                                        <div class="title-item" style="user-select: none;">Kód neve</div>
                                        <div class="title-item" style="user-select: none;">
                                            <?php echo $codename; ?>
                                        </div>
                                    </div>
                                    <hr>
                                    <div class="title-group">
                                        <div class="title-item" style="user-select: none;">Kategóriák</div>
                                        <div class="title-item" style="user-select: none;"><?php echo $categoryaltname; ?></div>
                                    </div>
                                    <hr>
                                    <div class="title-group">
                                        <div class="title-item" style="user-select: none;">Feltöltés ideje</div>
                                        <div class="title-item" style="user-select: none;">
                                            <?php echo $uploadtime ? $uploadtime : "Nincs megadva."; ?>
                                        </div>
                                    </div>
                                    <hr>
                                    <div class="title-group">
                                        <div class="title-item" style="user-select: none;">Ár</div>
                                        <div class="title-item" style="user-select: none;">
                                            <?php echo $price; ?>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <button class="checkout">Megvásárlás</button>
                </div>
            </div>
        <?php else: ?>
            <div class="body-container">
                <div class="main">
                    <div class="title-wrapper">
                        <div class="title-item-wrapper">
                            <div class="col">
                                <div class="title-group">
                                    <div class="title-item">
                                        <p class="likes" style="user-select: none;">
                                            <?php $codeLikes = getCodeLikes($codeid)[0]["likeCount"];
                                            if($codeLikes === null) {
                                                echo 0;
                                            } else {
                                                echo $codeLikes;
                                            } ?> értékelés
                                        </p>
                                    </div>
                                </div>
                            </div>
                            <div class="col">
                                <div class="col"></div>
                                <div class="col">
                                    <div class="title-group">
                                        <div class="title-item" style="user-select: none;">Feltöltő</div>
                                        <div class="title-item" style="user-select: none;"><?php echo $username; ?></div>
                                    </div>
                                    <hr>
                                    <div class="title-group">
                                        <div class="title-item" style="user-select: none;">Kód neve</div>
                                        <div class="title-item" style="user-select: none;">
                                            <?php echo $codename; ?>
                                        </div>
                                    </div>
                                    <hr>
                                    <div class="title-group">
                                        <div class="title-item" style="user-select: none;">Kategóriák</div>
                                        <div class="title-item" style="user-select: none;">Kategóriák</div>
                                    </div>
                                    <hr>
                                    <div class="title-group">
                                        <div class="title-item" style="user-select: none;">Feltöltés ideje</div>
                                        <div class="title-item" style="user-select: none;">
                                            <?php echo $uploadtime ? $uploadtime : "Nincs megadva."; ?>
                                        </div>
                                    </div>
                                    <hr>
                                    <div class="title-group">
                                        <div class="title-item" style="user-select: none;">Ár</div>
                                        <div class="title-item" style="user-select: none;">
                                            <?php echo $price; ?>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        <?php endif; ?>
    <?php else: ?>
        <?php if($_SESSION["username"] != "Vendég"): ?>
            <div class="body-container">
                <div class="title-wrapper">
                    <div class="title-item-wrapper">
                        <div class="col">
                            <?php if ($isOwned) { ?>
                                <div class="title-group upvote-wrapper">
                                    <div class="title-item svg-like-wrapper <?php if($likeState === 1) { echo "checked"; } ?>">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" fill="currentColor" class="bi bi-arrow-up-circle like-svg like-svg-empty" viewBox="0 0 16 16">
                                            <path fill-rule="evenodd" d="M1 8a7 7 0 1 0 14 0A7 7 0 0 0 1 8m15 0A8 8 0 1 1 0 8a8 8 0 0 1 16 0m-7.5 3.5a.5.5 0 0 1-1 0V5.707L5.354 7.854a.5.5 0 1 1-.708-.708l3-3a.5.5 0 0 1 .708 0l3 3a.5.5 0 0 1-.708.708L8.5 5.707z"/>
                                        </svg>
                                        <svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" fill="currentColor" class="bi bi-arrow-up-circle-fill like-svg like-svg-full" viewBox="0 0 16 16">
                                            <path d="M16 8A8 8 0 1 0 0 8a8 8 0 0 0 16 0m-7.5 3.5a.5.5 0 0 1-1 0V5.707L5.354 7.854a.5.5 0 1 1-.708-.708l3-3a.5.5 0 0 1 .708 0l3 3a.5.5 0 0 1-.708.708L8.5 5.707z"/>
                                        </svg>
                                    </div>
                                    <div class="title-item">
                                        <p class="likes" style="user-select: none;">
                                            <?php $codeLikes = getCodeLikes($codeid)[0]["likeCount"];
                                            if($codeLikes === null) {
                                                echo 0;
                                            }
                                            else {
                                                echo $codeLikes;
                                            } ?>
                                        </p>
                                    </div>
                                    <div class="title-item svg-dislike-wrapper <?php if($likeState === 0) { echo "checked"; } ?>">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" fill="currentColor" class="bi bi-arrow-down-circle dislike-svg-empty" viewBox="0 0 16 16">
                                            <path fill-rule="evenodd" d="M1 8a7 7 0 1 0 14 0A7 7 0 0 0 1 8m15 0A8 8 0 1 1 0 8a8 8 0 0 1 16 0M8.5 4.5a.5.5 0 0 0-1 0v5.793L5.354 8.146a.5.5 0 1 0-.708.708l3 3a.5.5 0 0 0 .708 0l3-3a.5.5 0 0 0-.708-.708L8.5 10.293z"/>
                                        </svg>
                                        <svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" fill="currentColor" class="bi bi-arrow-down-circle-fill dislike-svg-full" viewBox="0 0 16 16">
                                            <path d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0M8.5 4.5a.5.5 0 0 0-1 0v5.793L5.354 8.146a.5.5 0 1 0-.708.708l3 3a.5.5 0 0 0 .708 0l3-3a.5.5 0 0 0-.708-.708L8.5 10.293z"/>
                                        </svg>
                                    </div>
                                </div>
                            
                                <?php 
                                if ($_SESSION["role"] == "admin" || $_SESSION["role"] == "moderator" || $_SESSION["userid"] == $uploaderid) { 
                                ?>
                                    <div class="title-group delete-wrapper">
                                        <button id="delete-code-btn" class="delete-btn" data-code-id="<?php echo $codeid; ?>">
                                            Kód törlése
                                        </button>
                                    </div>
                                <?php } ?>
                            <?php } ?>
                        </div>
                        <div class="col">
                            <div class="title-group">
                                <div class="title-item" style="user-select: none;">Feltöltő</div>
                                <div class="title-item" style="user-select: none;">
                                    <?php echo $username; ?>
                                </div>
                            </div>
                            <hr>
                            <div class="title-group">
                                <div class="title-item" style="user-select: none;">Kód neve</div>
                                <div class="title-item" style="user-select: none;">
                                    <?php echo $codename; ?>
                                </div>
                            </div>
                            <hr>
                            <div class="title-group">
                                <div class="title-item" style="user-select: none;">Kategóriák</div>
                                <div class="title-item" style="user-select: none;">
                                    <?php echo $category ?>
                                </div>
                            </div>
                            <hr>
                            <div class="title-group">
                                <div class="title-item" style="user-select: none;">Feltöltés ideje</div>
                                <div class="title-item" style="user-select: none;">
                                    <?php echo $uploadtime ? $uploadtime : "Nincs megadva."; ?>
                                </div>
                            </div>
                            <hr>
                            <div class="title-group">
                                <div class="title-item" style="user-select: none;">Ár</div>
                                <div class="title-item" style="user-select: none;">
                                    <?php if($price === 0) {
                                        echo "Ingyenes";
                                    }
                                    else {
                                        echo $price;
                                    } ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div id="container"></div>
                <script src="/src/web/js/compiler.js"></script>
                <script src="https://cdnjs.cloudflare.com/ajax/libs/monaco-editor/0.34.1/min/vs/loader.js"></script>
                <?php $file_content = file_get_contents("./codes/$fileurl"); ?>
                <script>
                    const fileExtension = "<?php echo $categoryaltname; ?>";
                    const fileContent = <?php echo json_encode($file_content); ?>;
                    createCompiler("container");
                </script>
            </div>
        <?php else: ?>
            <div class="body-container">
                <div class="title-wrapper">
                    <div class="title-item-wrapper">
                        <div class="col"></div>
                        <div class="col">
                            <div class="title-group">
                                <div class="title-item" style="user-select: none;">Feltöltő</div>
                                <div class="title-item" style="user-select: none;">
                                    <?php echo $username; ?>
                                </div>
                            </div>
                            <hr>
                            <div class="title-group">
                                <div class="title-item" style="user-select: none;">Kód neve</div>
                                <div class="title-item" style="user-select: none;">
                                    <?php echo $codename; ?>
                                </div>
                            </div>
                            <hr>
                            <div class="title-group">
                                <div class="title-item" style="user-select: none;">Kategóriák</div>
                                <div class="title-item" style="user-select: none;">
                                    <?php echo $categoryaltname; ?>
                                </div>
                            </div>
                            <hr>
                            <div class="title-group">
                                <div class="title-item" style="user-select: none;">Feltöltés ideje</div>
                                <div class="title-item" style="user-select: none;">
                                    <?php echo $uploadtime ? $uploadtime : "Nincs megadva."; ?>
                                </div>
                            </div>
                            <hr>
                            <div class="title-group">
                                <div class="title-item" style="user-select: none;">Ár</div>
                                <div class="title-item" style="user-select: none;">
                                    <?php if($price === 0) {
                                        echo "Ingyenes";
                                    }
                                    else {
                                        echo $price;
                                    } ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div id="container"></div>
                <script src="/src/web/js/compiler.js"></script>
                <script src="https://cdnjs.cloudflare.com/ajax/libs/monaco-editor/0.34.1/min/vs/loader.js"></script>
                <?php $file_content = file_get_contents("./codes/$fileurl"); ?>
                <script>
                    const fileExtension = "<?php echo $category; ?>";
                    const fileContent = <?php echo json_encode($file_content); ?>;
                    createCompiler("container");
                </script>
            </div>
        <?php endif; ?>
    <?php endif; ?>
    <script src="/src/web/js/loader.js"></script>
</body>
</html>