<?php
include_once "../php_functions/php_functions.php";
?>
<!DOCTYPE html>
<html lang="hu">
<head>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100..900;1,100..900&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: "Roboto", sans-serif;
        }
        nav {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 50px;
            background-color: #222;
            display: flex;
            flex-direction: row;
            align-items: center;
            justify-content: space-between;
            color: white;
        }
        .nav-item:first-of-type {
            margin-left: 2%;
        }
        .nav-group {
            display: flex;
            flex-direction: row;
            justify-content: space-between;
            gap: 20px;
        }
        .nav-group:last-of-type {
            margin-right: 2%;
        }
        .nav-dropdown-item:not(.visible) {
            display: none;
        }
        .nav-dropdown-item.visible {
            display: block;
        }
        .nav-link {
            all: unset;
            cursor: pointer;
        }
        .nav-link:hover {
            color:rgb(121, 178, 199);
        }
        /* ---------------------------------- TODO ---------------------------------- */
        .nav-dropdown-button {
            position: relative;
        }
        .nav-dropdown-item {
            position: absolute;
            top: 100%;
            left: 0;
            background-color: #222;
            padding: 10px 5px;
            z-index: 1;
        }
        .nav-dropdown-item.visible {
            display: block;
        }
        /* ------------------------------- END OF TODO ------------------------------ */
    </style>
</head>
<body>
    <nav>
        <div class="nav-item nav-link">CodeOverflow</div>
        <div class="nav-group">
            <div class="nav-dropdown-button nav-link">
                Kategóriák
                <?php
                $categories = simpleGetData("SELECT kategoria.nev FROM kategoria;")[0];
                foreach ($categories as $category) {
                    echo '<div class="nav-dropdown-item"><a class="nav-link" href="http://localhost/vizsgaremek/kategoria/' . $category . '">' . $category . '</a></div>';
                }
                ?>
            </div>
            <div class="nav-item nav-link">Könyvtár</div>
            <div class="nav-item nav-link">Felkérések</div>
        </div>
        <div class="nav-group">
            <div class="nav-dropdown-button nav-link">domebence<div class="nav-dropdown-item"><a class="nav-link" href="http://localhost/vizsgaremek/src/web/logout.php">Kijelentkezés</a></div>
            </div>
        </div>
    </nav>
    <script>
        document.addEventListener("DOMContentLoaded", () => {
        const dropdownButtons = document.querySelectorAll(".nav-dropdown-button");
        const dropdownItems = document.querySelectorAll(".nav-dropdown-item");
        dropdownButtons.forEach(button => {
            const dropdownItem = button.querySelector(".nav-dropdown-item");
            button.addEventListener("click", (event) => {
                event.stopPropagation();
                dropdownItems.forEach(item => {
                    if(item != dropdownItem) {
                        item.classList.remove("visible");
                    }
                });
                dropdownItem.classList.toggle("visible");
            });
        });
        dropdownItems.forEach(item => {
            item.addEventListener("click", (event) => {
                event.stopPropagation();
            });
        });
        document.addEventListener("click", () => {
            dropdownItems.forEach(item => {
                item.classList.remove("visible");
            });
        });
    });
    </script>
</body>
</html>