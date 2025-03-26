<?php
include_once "../php_functions/php_functions.php";
?>
<div class="nav-menu-button">
    <svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" fill="white" class="bi bi-list" viewBox="0 0 16 16">
        <path fill-rule="evenodd" d="M2.5 12a.5.5 0 0 1 .5-.5h10a.5.5 0 0 1 0 1H3a.5.5 0 0 1-.5-.5m0-4a.5.5 0 0 1 .5-.5h10a.5.5 0 0 1 0 1H3a.5.5 0 0 1-.5-.5m0-4a.5.5 0 0 1 .5-.5h10a.5.5 0 0 1 0 1H3a.5.5 0 0 1-.5-.5"/>
    </svg>
</div>
<nav>
    <div class="nav-group nav-home">
        <a class="nav-item nav-link" href="http://localhost/vizsgaremek/src/web/home.php">CodeOverflow</a>
    </div>
    <div class="nav-group">
        <div class="nav-dropdown-button nav-link">
            Kategóriák
            <div class="nav-dropdown-item">
            <?php
            $categories = simpleGetData("SELECT nev, compiler_azonosito FROM kategoria ORDER BY nev");
            if($categories && count($categories) > 0) {
                foreach ($categories as $category) {
                    echo '<a class="nav-link" href="http://localhost/vizsgaremek/kategoria/' . $category['compiler_azonosito'] . '">' . $category['nev'] . '</a>';
                }
            } else {
                echo '<a class="nav-link">Nincs elérhető kategória</a>';
            }
            ?>
            </div>
        </div>
        <div class="nav-dropdown-button nav-link">
            Felkérések
            <div class="nav-dropdown-item">
                <a class="nav-link" href="http://localhost/vizsgaremek/felkeresek/feltoltes">Feltöltés</a>
                <a class="nav-link" href="http://localhost/vizsgaremek/felkeresek">Böngészés</a>
            </div>
        </div>
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
                        echo '<div class="nav-item nav-link"><a class="nav-item nav-link" href="http://localhost/vizsgaremek/src/web/library.php">Könyvtár</a></div>';
                        if($_SESSION["role"] == "moderator") {
                            echo '<a class="nav-link" href="http://localhost/vizsgaremek/src/web/library.php">Könyvtár</a>
                            <a class="nav-link" href="http://localhost/vizsgaremek/src/web/approve.php">Jóváhagyások</a>';
                        }
                        else if($_SESSION["role"] == "admin") {
                            echo '<a class="nav-link" href="http://localhost/vizsgaremek/src/web/admin.php">Admin</a>';
                        }
                        echo '<a class="nav-link" href="http://localhost/vizsgaremek/src/web/logout.php">Kijelentkezés</a>
                    </div>
                </div>';
        }
        ?>
    </div>
</nav>
