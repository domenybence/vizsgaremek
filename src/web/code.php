<?php
include_once "../php_functions/db_functions.php";
startSession();
$userid = 8;
$codeid = 3;
$likeState = returnLikeState($userid, $codeid);
?>

<!DOCTYPE html>
<html lang="hu">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content=".">
    <title>Kód</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,100..900;1,100..900&display=swap" rel="stylesheet">
    <link rel="icon" type="image/x-icon" href="./icon.png">
    <link rel="stylesheet" href="./css/code.css">
    <script src="./js/code.js" defer></script>
</head>
<body>
    <div class="main">
        <div class="title-wrapper">
            <div class="title-item-wrapper">
                <div class="col">
                    <div class="title-group upvote-wrapper">
                        <div class="title-item svg-like-wrapper
                            <?php
                                if($likeState === 1) {
                                    echo "checked";
                                }
                            ?>
                        ">
                            <svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" fill="currentColor" class="bi bi-arrow-up-circle like-svg like-svg-empty" viewBox="0 0 16 16">
                                <path fill-rule="evenodd" d="M1 8a7 7 0 1 0 14 0A7 7 0 0 0 1 8m15 0A8 8 0 1 1 0 8a8 8 0 0 1 16 0m-7.5 3.5a.5.5 0 0 1-1 0V5.707L5.354 7.854a.5.5 0 1 1-.708-.708l3-3a.5.5 0 0 1 .708 0l3 3a.5.5 0 0 1-.708.708L8.5 5.707z"/>
                            </svg>
                            <svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" fill="currentColor" class="bi bi-arrow-up-circle-fill like-svg like-svg-full" viewBox="0 0 16 16">
                                <path d="M16 8A8 8 0 1 0 0 8a8 8 0 0 0 16 0m-7.5 3.5a.5.5 0 0 1-1 0V5.707L5.354 7.854a.5.5 0 1 1-.708-.708l3-3a.5.5 0 0 1 .708 0l3 3a.5.5 0 0 1-.708.708L8.5 5.707z"/>
                            </svg>
                        </div>
                        <div class="title-item">
                            <p class="likes" style="user-select: none;">
                                <?php
                                    echo getCodeLikes(3)[0]["likeCount"];
                                ?>
                            </p>
                        </div>
                    <div class="title-item svg-dislike-wrapper
                            <?php
                                if($likeState === 0) {
                                    echo "checked";
                                }
                            ?>
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
                        <div class="title-item" style="user-select: none;">domebence</div>
                    </div>
                    <hr>
                    <div class="title-group">
                        <div class="title-item" style="user-select: none;">Kód neve</div>
                        <div class="title-item" style="user-select: none;">Teszt kódnév</div>
                    </div>
                    <hr>
                    <div class="title-group">
                        <div class="title-item" style="user-select: none;">Kategóriák</div>
                        <div class="title-item" style="user-select: none;">HTML, JavaScript, PHP</div>
                    </div>
                    <hr>
                    <div class="title-group">
                        <div class="title-item" style="user-select: none;">Feltöltés ideje</div>
                        <div class="title-item" style="user-select: none;">2024.12.05.</div>
                    </div>
                </div>
            </div>
        </div>
        <!-- editor import -->
        <div id="container"></div>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/monaco-editor/0.34.1/min/vs/loader.js"></script>
        <script src="./js/createCompiler.js"></script>
        <script>createCompiler("container");</script>
    </div>
</body>
</html>
