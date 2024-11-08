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
    }
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
    return "<div class='registration-successful'>Sikeres regisztráció!</div>";
}
?>
