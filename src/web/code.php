<?php
include_once "../php_functions/php_functions.php";
include_once "./upload_likes.php";

$data = preparedGetData("SELECT felhasznalo.nev AS username, felhasznalo.id AS userid, kategoria.nev AS category, kod.feltoltesi_ido AS uploadtime, kod.nev AS codename, kod.eleresi_ut AS url, kod.ar AS price FROM felhasznalo INNER JOIN kod ON kod.felhasznalo_id = felhasznalo.id INNER JOIN kategoria ON kod.kategoria_id = kategoria.id WHERE kod.id = ?;", "i", [$codeid]);
$userid = $data[0]["userid"];
$username = $data[0]["username"];
$category = $data[0]["category"];
$uploadtime = $data[0]["uploadtime"];
$codename = $data[0]["codename"];
$fileurl = $data[0]["url"];
$price = $data[0]["price"];
$likeState = returnLikeState($userid, $codeid);

$isOwned = false;
if($price === 0) {
    $isOwned = true;
}
else {
    if(preparedGetData("SELECT * FROM felhasznalo_megvett WHERE felhasznalo_id = ? AND kod_id = ?;", "ii", [$userid, $codeid]) != false) {
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
    <title><?php echo $username . " - " . $codename ?></title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link rel="icon" type="image/x-icon" href="/vizsgaremek/src/web/icon.png">
    <link rel="stylesheet" href="/vizsgaremek/src/web/css/code.css">
    <script>
        const codeId = <?php echo $codeid; ?>;
        const userId = <?php echo $userid; ?>;
        </script>
    <script src="/vizsgaremek/src/web/js/code.js" defer></script>
    <script src="/vizsgaremek/src/web//js/gsap-public/minified/gsap.min.js"></script>
    <?php include "loader.html"; ?>
</head>
<body>
    <?php
        if(!$isOwned) {
            if($_SESSION["username"]!="Vendég") {
            echo ' 
            <div class="body-container">
                <div class="main">
                    <div class="title-wrapper">
                        <div class="title-item-wrapper">
                            <div class="col">
                                <div class="title-group upvote-wrapper">
                                    <div class="title-item svg-like-wrapper ';
                                        if($likeState === 1) {
                                            echo "checked";
                                        }
                                        echo '
                                    ">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" fill="currentColor" class="bi bi-arrow-up-circle like-svg like-svg-empty" viewBox="0 0 16 16">
                                            <path fill-rule="evenodd" d="M1 8a7 7 0 1 0 14 0A7 7 0 0 0 1 8m15 0A8 8 0 1 1 0 8a8 8 0 0 1 16 0m-7.5 3.5a.5.5 0 0 1-1 0V5.707L5.354 7.854a.5.5 0 1 1-.708-.708l3-3a.5.5 0 0 1 .708 0l3 3a.5.5 0 0 1-.708.708L8.5 5.707z"/>
                                        </svg>
                                        <svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" fill="currentColor" class="bi bi-arrow-up-circle-fill like-svg like-svg-full" viewBox="0 0 16 16">
                                            <path d="M16 8A8 8 0 1 0 0 8a8 8 0 0 0 16 0m-7.5 3.5a.5.5 0 0 1-1 0V5.707L5.354 7.854a.5.5 0 1 1-.708-.708l3-3a.5.5 0 0 1 .708 0l3 3a.5.5 0 0 1-.708.708L8.5 5.707z"/>
                                        </svg>
                                    </div>
                                    <div class="title-item">
                                        <p class="likes" style="user-select: none;">';
                                            $codeLikes = getCodeLikes($codeid)[0]["likeCount"];
                                            if($codeLikes === null) {
                                                echo 0;
                                            }
                                            else {
                                                echo $codeLikes;
                                            }
                                            echo '
                                        </p>
                                    </div>
                                <div class="title-item svg-dislike-wrapper ';
                                            if($likeState === 0) {
                                                echo "checked";
                                            }
                                            echo '
                                    ">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" fill="currentColor" class="bi bi-arrow-down-circle dislike-svg-empty" viewBox="0 0 16 16">
                                        <path fill-rule="evenodd" d="M1 8a7 7 0 1 0 14 0A7 7 0 0 0 1 8m15 0A8 8 0 1 1 0 8a8 8 0 0 1 16 0M8.5 4.5a.5.5 0 0 0-1 0v5.793L5.354 8.146a.5.5 0 1 0-.708.708l3 3a.5.5 0 0 0 .708 0l3-3a.5.5 0 0 0-.708-.708L8.5 10.293z"/>
                                    </svg>
                                    <svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" fill="currentColor" class="bi bi-arrow-down-circle-fill dislike-svg-full" viewBox="0 0 16 16">
                                        <path d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0M8.5 4.5a.5.5 0 0 0-1 0v5.793L5.354 8.146a.5.5 0 1 0-.708.708l3 3a.5.5 0 0 0 .708 0l3-3a.5.5 0 0 0-.708-.708L8.5 10.293z"/>
                                    </svg>
                                </div>
                                </div>
                            </div>
                            <div class="col">
                                <div class="title-group">
                                    <div class="title-item" style="user-select: none;">Feltöltő</div>
                                    <div class="title-item" style="user-select: none;">
                                    <div class="link-wrapper">';
                                            echo "<a class='link' href='http://localhost/vizsgaremek/felhasznalo/".$username."'>".$username."</a>";
                                            echo '
                                    </div>
                                    </div>
                                </div>
                                <hr>
                                <div class="title-group">
                                    <div class="title-item" style="user-select: none;">Kód neve</div>
                                    <div class="title-item" style="user-select: none;">';
                                            echo $codename;
                                            echo '
                                    </div>
                                </div>
                                <hr>
                                <div class="title-group">
                                    <div class="title-item" style="user-select: none;">Kategóriák</div>
                                    <div class="title-item" style="user-select: none;">
                                        <div class="link-wrapper">';
                                                echo "<a class='link' href='http://localhost/vizsgaremek/kategoria/".$category."'>".$category."</a>";
                                                echo '
                                        </div>
                                    </div>
                                </div>
                                <hr>
                                <div class="title-group">
                                    <div class="title-item" style="user-select: none;">Feltöltés ideje</div>
                                    <div class="title-item" style="user-select: none;">';
                                            echo $uploadtime ? $uploadtime : "Nincs megadva.";
                                            echo '
                                    </div>
                                </div>
                                
                                <div class="title-group">
                                    <div class="title-item" style="user-select: none;">Ár</div>
                                    <div class="title-item" style="user-select: none;">';
                                            echo $price;
                                            echo '
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <a href="#" class="checkout">Megvásárlás</a>
                </div>
            </div>';
            }
            else {
                echo ' 
                    <div class="body-container">
                        <div class="main">
                            <div class="title-wrapper">
                                <div class="title-item-wrapper">
                                    <div class="col">
                                    <div class="col">
                                        <div class="title-group">
                                            <div class="title-item" style="user-select: none;">Feltöltő</div>
                                            <div class="title-item" style="user-select: none;">
                                            <div class="link-wrapper">';
                                                    echo "<a class='link' href='http://localhost/vizsgaremek/felhasznalo/".$username."'>".$username."</a>";
                                                    echo '
                                            </div>
                                            </div>
                                        </div>
                                        <hr>
                                        <div class="title-group">
                                            <div class="title-item" style="user-select: none;">Kód neve</div>
                                            <div class="title-item" style="user-select: none;">';
                                                    echo $codename;
                                                    echo '
                                            </div>
                                        </div>
                                        <hr>
                                        <div class="title-group">
                                            <div class="title-item" style="user-select: none;">Kategóriák</div>
                                            <div class="title-item" style="user-select: none;">
                                                <div class="link-wrapper">';
                                                        echo "<a class='link' href='http://localhost/vizsgaremek/kategoria/".$category."'>".$category."</a>";
                                                        echo '
                                                </div>
                                            </div>
                                        </div>
                                        <hr>
                                        <div class="title-group">
                                            <div class="title-item" style="user-select: none;">Feltöltés ideje</div>
                                            <div class="title-item" style="user-select: none;">';
                                                    echo $uploadtime ? $uploadtime : "Nincs megadva.";
                                                    echo '
                                            </div>
                                        </div>
                                        
                                        <div class="title-group">
                                            <div class="title-item" style="user-select: none;">Ár</div>
                                            <div class="title-item" style="user-select: none;">';
                                                    echo $price;
                                                    echo '
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>';
            }
        }
        else {
            if($_SESSION["username"]!="Vendég") {
            echo '
                <div class="body-container">
                    <div class="title-wrapper">
                    <div class="title-item-wrapper">
                        <div class="col">
                            <div class="title-group upvote-wrapper">
                                <div class="title-item svg-like-wrapper ';
                                        if($likeState === 1) {
                                            echo "checked";
                                        }
                                        echo '
                                ">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" fill="currentColor" class="bi bi-arrow-up-circle like-svg like-svg-empty" viewBox="0 0 16 16">
                                        <path fill-rule="evenodd" d="M1 8a7 7 0 1 0 14 0A7 7 0 0 0 1 8m15 0A8 8 0 1 1 0 8a8 8 0 0 1 16 0m-7.5 3.5a.5.5 0 0 1-1 0V5.707L5.354 7.854a.5.5 0 1 1-.708-.708l3-3a.5.5 0 0 1 .708 0l3 3a.5.5 0 0 1-.708.708L8.5 5.707z"/>
                                    </svg>
                                    <svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" fill="currentColor" class="bi bi-arrow-up-circle-fill like-svg like-svg-full" viewBox="0 0 16 16">
                                        <path d="M16 8A8 8 0 1 0 0 8a8 8 0 0 0 16 0m-7.5 3.5a.5.5 0 0 1-1 0V5.707L5.354 7.854a.5.5 0 1 1-.708-.708l3-3a.5.5 0 0 1 .708 0l3 3a.5.5 0 0 1-.708.708L8.5 5.707z"/>
                                    </svg>
                                </div>
                                <div class="title-item">
                                    <p class="likes" style="user-select: none;">';
                                            $codeLikes = getCodeLikes($codeid)[0]["likeCount"];
                                            if($codeLikes === null) {
                                                echo 0;
                                            }
                                            else {
                                                echo $codeLikes;
                                            }
                                            echo '
                                    </p>
                                </div>
                            <div class="title-item svg-dislike-wrapper ';
                                        if($likeState === 0) {
                                            echo "checked";
                                        }
                                        echo '
                                ">
                                <svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" fill="currentColor" class="bi bi-arrow-down-circle dislike-svg-empty" viewBox="0 0 16 16">
                                    <path fill-rule="evenodd" d="M1 8a7 7 0 1 0 14 0A7 7 0 0 0 1 8m15 0A8 8 0 1 1 0 8a8 8 0 0 1 16 0M8.5 4.5a.5.5 0 0 0-1 0v5.793L5.354 8.146a.5.5 0 1 0-.708.708l3 3a.5.5 0 0 0 .708 0l3-3a.5.5 0 0 0-.708-.708L8.5 10.293z"/>
                                </svg>
                                <svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" fill="currentColor" class="bi bi-arrow-down-circle-fill dislike-svg-full" viewBox="0 0 16 16">
                                    <path d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0M8.5 4.5a.5.5 0 0 0-1 0v5.793L5.354 8.146a.5.5 0 1 0-.708.708l3 3a.5.5 0 0 0 .708 0l3-3a.5.5 0 0 0-.708-.708L8.5 10.293z"/>
                                </svg>
                            </div>
                            </div>
                        </div>
                        <div class="col">
                            <div class="title-group">
                                <div class="title-item" style="user-select: none;">Feltöltő</div>
                                <div class="title-item" style="user-select: none;">
                                <div class="link-wrapper">';
                                        echo "<a class='link' href='http://localhost/vizsgaremek/felhasznalo/".$username."'>".$username."</a>";
                                        echo '
                                </div>
                                </div>
                            </div>
                            <hr>
                            <div class="title-group">
                                <div class="title-item" style="user-select: none;">Kód neve</div>
                                <div class="title-item" style="user-select: none;">';
                                        echo $codename;
                                        echo '
                                </div>
                            </div>
                            <hr>
                            <div class="title-group">
                                <div class="title-item" style="user-select: none;">Kategóriák</div>
                                <div class="title-item" style="user-select: none;">
                                    <div class="link-wrapper">';
                                            echo "<a class='link' href='http://localhost/vizsgaremek/kategoria/".$category."'>".$category."</a>";
                                            echo '
                                    </div>
                                </div>
                            </div>
                            <hr>
                            <div class="title-group">
                                <div class="title-item" style="user-select: none;">Feltöltés ideje</div>
                                <div class="title-item" style="user-select: none;">';
                                        echo $uploadtime ? $uploadtime : "Nincs megadva.";
                                        echo '
                                </div>
                            </div>
                            <hr>
                            <div class="title-group">
                                <div class="title-item" style="user-select: none;">Ár</div>
                                <div class="title-item" style="user-select: none;">';
                                        if($price === 0) {
                                            echo "Ingyenes";
                                        }
                                        else {
                                            echo $price;
                                        }
                                        echo '
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div id="container"></div>
                <script src="/vizsgaremek/src/web/js/compiler.js"></script>
                <script src="https://cdnjs.cloudflare.com/ajax/libs/monaco-editor/0.34.1/min/vs/loader.js"></script>';
                $file_content = file_get_contents("./codes/$fileurl.uqw");
                echo '<script>
                        const fileExtension = "' . $category . '";
                        const fileContent = ' . json_encode($file_content) . ';
                        createCompiler("container");
                    </script>
                </div>
            </div>'; }
            else {
                echo '
                <div class="body-container">
                    <div class="title-wrapper">
                    <div class="title-item-wrapper">
                        <div class="col"></div>
                        <div class="col">
                            <div class="title-group">
                                <div class="title-item" style="user-select: none;">Feltöltő</div>
                                <div class="title-item" style="user-select: none;">
                                <div class="link-wrapper">';
                                        echo "<a class='link' href='http://localhost/vizsgaremek/felhasznalo/".$username."'>".$username."</a>";
                                        echo '
                                </div>
                                </div>
                            </div>
                            <hr>
                            <div class="title-group">
                                <div class="title-item" style="user-select: none;">Kód neve</div>
                                <div class="title-item" style="user-select: none;">';
                                        echo $codename;
                                        echo '
                                </div>
                            </div>
                            <hr>
                            <div class="title-group">
                                <div class="title-item" style="user-select: none;">Kategóriák</div>
                                <div class="title-item" style="user-select: none;">
                                    <div class="link-wrapper">';
                                            echo "<a class='link' href='http://localhost/vizsgaremek/kategoria/".$category."'>".$category."</a>";
                                            echo '
                                    </div>
                                </div>
                            </div>
                            <hr>
                            <div class="title-group">
                                <div class="title-item" style="user-select: none;">Feltöltés ideje</div>
                                <div class="title-item" style="user-select: none;">';
                                        echo $uploadtime ? $uploadtime : "Nincs megadva.";
                                        echo '
                                </div>
                            </div>
                            <hr>
                            <div class="title-group">
                                <div class="title-item" style="user-select: none;">Ár</div>
                                <div class="title-item" style="user-select: none;">';
                                        if($price === 0) {
                                            echo "Ingyenes";
                                        }
                                        else {
                                            echo $price;
                                        }
                                        echo '
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div id="container"></div>
                <script src="/vizsgaremek/src/web/js/compiler.js"></script>
                <script src="https://cdnjs.cloudflare.com/ajax/libs/monaco-editor/0.34.1/min/vs/loader.js"></script>';
                $file_content = file_get_contents("./codes/$fileurl.uqw");
                echo '<script>
                        const fileExtension = "' . $category . '";
                        const fileContent = ' . json_encode($file_content) . ';
                        createCompiler("container");
                    </script>
                </div>
            </div>';
            }
        } ?>
</body>
</html>