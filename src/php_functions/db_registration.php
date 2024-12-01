<?php

include_once "db_connect.php";
include_once "db_insert.php";

function registration($username, $email, $hashedPassword) {

    try {
        insertData("INSERT INTO felhasznalo (`nev`, `email`, `jelszo`, `pontok`, `letrehozasi_ido`, `utolso_valt_ido`) VALUES (?, ?, ?, NULL, current_timestamp(), current_timestamp());", "sss", [$username, $email, $hashedPassword]);
        return "success";
    }
    catch (Exception $e) {
        $errorMessage = $e->getMessage();
        if (strpos($errorMessage, "nev") !== false) {
                return "taken-username";
            }
            else if (strpos($errorMessage, "email") !== false) {
                return "taken-email";
            }
    }
}