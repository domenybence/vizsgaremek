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
        <a class="nav-item nav-link" href="http://localhost/">CodeOverflow</a>
    </div>
    <div class="nav-group">
        <div class="nav-dropdown-button nav-link">
            Felkérések
            <div class="nav-dropdown-item">
                <a class="nav-link" href="http://localhost/felkeresek/feltoltes">Feltöltés</a>
                <a class="nav-link" href="http://localhost/felkeresek/bongeszes">Böngészés</a>
            </div>
        </div>
    </div>
    <form class="d-flex">
          <input class="form-control me-2" id="kereso" type="search" placeholder="Szoftverkeresés">
          <button class="btn btn-outline-primary" id="keresobtn" type="button">Keresés</button>
        </form>
    <div class="nav-group">
        <?php
        if($_SESSION["username"] == "Vendég") {
            echo '<div class="nav-item nav-link"><a class="nav-item nav-link" id="login" href="http://localhost/bejelentkezes">Bejelentkezés</a></div>';
        }
        else {
            echo '
                <div class="nav-dropdown-button nav-link" id="navusername">'.$_SESSION["username"].'
                    <div class="nav-dropdown-item">
                        ';
                        echo '<div class="nav-item nav-link"><a class="nav-item nav-link" href="http://localhost/konyvtar">Könyvtár</a></div>';
                        echo '
                         <a class="nav-item nav-link" href="http://localhost/pontfeltoltes">Pontok feltöltése</a>
                        <div class="nav-item nav-link"><a class="nav-item nav-link" href="http://localhost/konyvtar">Könyvtár</a></div>';
                        if($_SESSION["role"] == "moderator") {
                            echo '<a class="nav-link" href="http://localhost/konyvtar">Könyvtár</a>
                            <a class="nav-link" href="http://localhost/jovahagyasok">Jóváhagyások</a>';
                        }
                        else if($_SESSION["role"] == "admin") {
                            echo '<a class="nav-link" href="http://localhost/jovahagyasok">Jóváhagyások</a>
                                 <a class="nav-link" href="http://localhost/admin">Admin</a>';
                        }
                        echo '  <a class="nav-link" href="http://localhost/kodfeltoltes">Kód feltöltése</a>
                                <a class="nav-link" href="http://localhost/kijelentkezes">Kijelentkezés</a>
                        </div>
                    </div>';
        }
        ?>
    </div>
</nav>
