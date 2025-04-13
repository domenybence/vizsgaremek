<?php
$felhasznalo = "admin";
$jelszo = "titok123";

if ($_POST["user"] == $felhasznalo && $_POST["pass"] == $jelszo) {
    echo "Sikeres bejelentkezés!";
} else {
    echo "Hibás felhasználónév vagy jelszó.";
}
?>