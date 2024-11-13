<?php

function dataInsert($username, $email, $hashedPassword) {
    include_once "db_connect.php";
    $db = getDb();
    
    if ($db->connect_errno) {
        return "<div class='error-group'>Az adatbázishoz nem sikerült hozzákapcsolódni!</div>";
    }

    $query = $db->prepare("INSERT INTO felhasznalo (`nev`, `email`, `jelszo`, `pontok`, `letrehozasi_ido`, `utolso_valt_ido`, `moderator`, `admin`) VALUES (?, ?, ?, NULL, current_timestamp(), current_timestamp(), NULL, NULL)");
    $query->bind_param("sss", $username, $email, $hashedPassword);
    try {
        $query->execute();
        return `<div class="registration-wrapper">
                    <div class="registration-popup">
                        <div class="title-container">
                            <h3>Sikeres regisztráció!</h3>
                            <svg xmlns="http://www.w3.org/2000/svg" id="svg_x" width="35" height="35" fill="currentColor" class="bi bi-x" viewBox="0 0 16 16">
                            <path d="M4.646 4.646a.5.5 0 0 1 .708 0L8 7.293l2.646-2.647a.5.5 0 0 1 .708.708L8.707 8l2.647 2.646a.5.5 0 0 1-.708.708L8 8.707l-2.646 2.647a.5.5 0 0 1-.708-.708L7.293 8 4.646 5.354a.5.5 0 0 1 0-.708"/>
                            </svg>
                        </div>
                        <hr>
                        <div class="content">
                            <p>Szeretne bejelentkezni?</p>
                        </div>
                        <hr>
                        <div class="button-container">
                            <a href="./registration.php"><button id="button_login">Vigyél a bejelentkezéshez</button></a>
                        </div>
                    </div>
                </div>`;
    }
    /* -- TODO POPOP FOR THE FAILED REGISTRATIONS AND MAKE SVG A WORKING BUTTON - */
    catch (mysqli_sql_exception $e) {
        if ($e->getCode() === 1062) {
            if (strpos($e->getMessage(), 'nev') !== false) {
                return "<div class='registration-unsuccessful'>Foglalt felhasználónév!</div>";
            }
            else if (strpos($e->getMessage(), 'email') !== false) {
                return "<div class='registration-unsuccessful'>Az email cím már egy meglévő fiókhoz tartozik!</div>";
            }
        }
        else {
            return "<div class='registration-unsuccessful'>A regisztráció során hiba lépett fel! " . $query->error . "</div>";
        }
    }
}
