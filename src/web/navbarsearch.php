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
       
        <a class="nav-item nav-link" href="http://localhost/vizsgaremek/src/web/browse_requests.php">Felkérések</a>
    </div>
    <form class="d-flex">
          <input class="form-control me-2" id="kereso" type="search" placeholder="Szoftverkeresés">
          <button class="btn btn-outline-primary" id="keresobtn" type="button">Keresés</button>
        </form>
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
                            echo '<a class="nav-link" href="http://localhost/vizsgaremek/src/web/approve.php">Jóváhagyások</a>
                            <a class="nav-link" href="http://localhost/vizsgaremek/src/web/admin.php">Admin</a>';
                        }
                        echo '  <a class="nav-link" href="http://localhost/vizsgaremek/src/web/upload.php">Feltöltés</a>
                                <a class="nav-link" href="http://localhost/vizsgaremek/src/web/logout.php">Kijelentkezés</a>
                    </div>
                </div>';
        }
        ?>
    </div>
</nav>
