<?php
include_once "../php_functions/php_functions.php";
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
?>
<!DOCTYPE html>
<html lang="hu">
<head>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100..900;1,100..900&display=swap" rel="stylesheet">
    <style>
        nav {
            font-family: "Roboto", sans-serif;
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 7vh;
            font-size: 18px;
            background-color: #1E1E1E;
            display: flex;
            flex-direction: row;
            align-items: center;
            justify-content: space-between;
            color: white;
            z-index: 100;
            user-select: none;
        }
        .nav-group:first-of-type {
            margin-left: 2%;
        }
        .nav-group {
            display: flex;
            flex-direction: row;
            justify-content: space-between;
            gap: 40px;
        }
        .nav-group:last-of-type {
            margin-right: 2%;
        }
        .nav-dropdown-item:not(.visible) {
            display: none;
        }
        .nav-dropdown-item.visible {
            display: block;
            margin: 5px 0;
        }
        .nav-dropdown-item.visible {
            opacity: 1;
            visibility: visible;
        }
        .nav-dropdown-item a {
            display: block;
            padding: 6px 20px;
            color: #fff;
            text-decoration: none;
            transition: all 0.2s ease;
            font-size: 16px;
            position: relative;
        }
        .nav-dropdown-item a:hover {
            background-color: #333;
            padding-left: 25px;
        }
        .nav-dropdown-item a:hover::before {
            content: "";
            position: absolute;
            left: 0;
            top: 0;
            width: 3px;
            height: 100%;
            background-color: rgb(121, 178, 199);
            opacity: 1;
        }
        .nav-link {
            all: unset;
            cursor: pointer;
        }
        .nav-link:hover {
            color: rgb(121, 178, 199);
        }
        .nav-dropdown-button {
            position: relative;
            width: 7vw;
            text-align: center;
        }
        .nav-dropdown-item {
            min-width: calc(fit-content + 10px);
            text-align: left;
            position: absolute;
            left: 0;
            background-color: #1E1E1E;
            padding: 10px 5px;
            width: 100%;
            z-index: 1000;
            top: calc(100% + 5px);
        }
        .nav-dropdown-item.visible {
            display: block;
        }
        .active {
            color: rgb(121, 178, 199);
        }
        .nav-menu-button {
            display: none;
            position: absolute;
            top: 10px;
            left: 10px;
            background-color: #333;
            padding: 6px;
            border-radius: 5px;
            cursor: pointer;
            z-index: 101;
        }
        @media screen and (max-width: 800px) {
            .nav-menu-button {
                display: flex;
                position: fixed;
                top: 10px;
                left: 10px;
                z-index: 1000;
            }
            nav {
                position: fixed;
                top: 0;
                left: 0;
                height: 100vh;
                width: 70%;
                flex-direction: column;
                align-items: flex-start;
                padding: 20px;
                transform: translateX(-100%);
                background-color: #222;
            }
            .nav-group {
                flex-direction: column;
                width: 100%;
                gap: 15px;
                margin: 20px 0;
                font-size: 30px;
                margin-left: 3%;
            }
            .nav-dropdown-button {
                width: 100%;
                text-align: left;
            }
            .nav-dropdown-item {
                position: relative;
                top: 0;
                left: 0;
                width: 100%;
                box-shadow: none;
                margin: 5px 0;
                padding: 0;
            }
            .nav-item.nav-link {
                padding: 10px 0;
            }
            .nav-dropdown-item a {
                padding: 10px 25px;
            }
            .nav-home {
                margin-top: 15%;
            }
            .nav-group:last-of-type {
                margin-bottom: 15%; 
            }
        }
        @media screen and (max-width: 600px) {
            nav {
                width: 100%;
            }
        }
    </style>
</head>
<body>
<script src="/vizsgaremek/src/web//js/gsap-public/minified/gsap.min.js"></script>
    <div class="nav-menu-button">
        <svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" fill="white" class="bi bi-list" viewBox="0 0 16 16">
            <path fill-rule="evenodd" d="M2.5 12a.5.5 0 0 1 .5-.5h10a.5.5 0 0 1 0 1H3a.5.5 0 0 1-.5-.5m0-4a.5.5 0 0 1 .5-.5h10a.5.5 0 0 1 0 1H3a.5.5 0 0 1-.5-.5m0-4a.5.5 0 0 1 .5-.5h10a.5.5 0 0 1 0 1H3a.5.5 0 0 1-.5-.5"/>
        </svg>
    </div>
    <nav>
        <div class="nav-group nav-home">
            <a class="nav-item nav-link" href="http://localhost/vizsgaremek/codeoverflow">CodeOverflow</a>
        </div>
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
            <div class="nav-item nav-link">Felkérések</div>
        </div>
        <div class="nav-group">
            <?php
            if($_SESSION["username"] == "Vendég") {
                echo '<div class="nav-item nav-link"><a class="nav-item nav-link" href="http://localhost/vizsgaremek/src/web/login.php">Bejelentkezés</a></div>';
            }
            else {
                echo '
                    <div class="nav-dropdown-button nav-link">'.$_SESSION["username"].'
                        <div class="nav-dropdown-item">
                            ';
                            if($_SESSION["role"] == "moderator") {
                                echo '<a class="nav-link" href="http://localhost/vizsgaremek/src/web/library.php">Könyvtár</a>
                                <a class="nav-link" href="http://localhost/vizsgaremek/src/web/approve.php">Jóváhagyások</a>';
                            }
                            else {
                                echo '<a class="nav-link" href="http://localhost/vizsgaremek/src/web/approval.php">Jóváhagyások</a>
                                <a class="nav-link" href="http://localhost/vizsgaremek/src/web/admin.php">Admin</a>';
                            }
                            echo '<a class="nav-link" href="http://localhost/vizsgaremek/src/web/logout.php">Kijelentkezés</a>
                        </div>
                    </div>';
            }
            ?>
        </div>
    </nav>
    <script>
    document.addEventListener("DOMContentLoaded", () => {
        const menuButton = document.querySelector(".nav-menu-button");
        const nav = document.querySelector("nav");
        const dropdownButtons = document.querySelectorAll(".nav-dropdown-button");
        const dropdownItems = document.querySelectorAll(".nav-dropdown-item");
        let isMenuOpen = false;
        if (window.innerWidth <= 800) {
            gsap.set(nav, {
                x: "-100%"
            });
        }
        menuButton.addEventListener("click", (event) => {
            event.stopPropagation();
            isMenuOpen = !isMenuOpen;
            gsap.to(nav, {
                x: isMenuOpen ? 0 : "-100%",
                duration: 0.3,
                ease: "power2.inOut",
                onComplete: () => {
                    if(!isMenuOpen) {
                        resetDropdown()
                    }
                }
            });
        });
        document.addEventListener("click", (event) => {
            if(isMenuOpen && !event.target.closest("nav")) {
                isMenuOpen = false;
                gsap.to(nav, {
                    x: "-100%",
                    duration: 0.3,
                    ease: "power2.inOut",
                    onComplete: resetDropdown
                });
            }
            dropdownItems.forEach(dropdownItem => {
                if(dropdownItem.classList.contains("visible") && !event.target.closest("nav")) {
                    resetDropdown();
                }
            })
        });
        function resetDropdown() {
            dropdownButtons.forEach(button => {
                button.classList.remove("active");
            });
            dropdownItems.forEach(button => {
                button.classList.remove("visible");
                button.style.zIndex = "1000";
            });
        }
        window.addEventListener("resize", () => {
            if(window.innerWidth > 800) {
                gsap.set(nav, {
                    x: 0
                });
                isMenuOpen = false;
            }
            else {
                gsap.set(nav, {
                    x: "-100%"
                });
                isMenuOpen = false;
            }
            dropdownButtons.forEach(button => {
                button.classList.remove("active");
            });
            dropdownItems.forEach(item => {
                item.classList.remove("visible");
                item.style.zIndex = "1000";
            });
        });
        dropdownButtons.forEach(button => {
        const dropdownItem = button.querySelector(".nav-dropdown-item");
        button.addEventListener("click", (event) => {
            event.stopPropagation();
            const isVisible = dropdownItem.classList.contains("visible");
            dropdownButtons.forEach(selectedButton => {
                if (selectedButton != button) {
                    selectedButton.classList.remove("active");
                }
            });
            dropdownItems.forEach(item => {
                if (item != dropdownItem) {
                    gsap.to(item, {
                        height: 0,
                        opacity: 0,
                        duration: 0.3,
                        ease: "power2.out",
                        onComplete: () => {
                            item.classList.remove("visible");
                        }
                    });
                }
            });
            button.classList.toggle("active");
            if (!isVisible) {
                dropdownItem.classList.add("visible");
                gsap.fromTo(dropdownItem, {
                        height: 0,
                        opacity: 0
                    }, {
                        height: "auto",
                        opacity: 1,
                        duration: 0.3,
                        ease: "power2.out"
                    });
            }
            else {
                gsap.to(dropdownItem, {
                    height: 0,
                    opacity: 0,
                    duration: 0.3,
                    ease: "power2.out",
                    onComplete: () => {
                        dropdownItem.classList.remove("visible");
                    }
                });
            }
        });
    });
    });
    </script>
</body>
</html>