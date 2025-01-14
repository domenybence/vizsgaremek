<?php

include_once "php_functions.php";
if(!empty($_SERVER["HTTP_X_REQUESTED_WITH"]) && strtolower($_SERVER["HTTP_X_REQUESTED_WITH"]) == "xmlhttprequest") {
    $data = json_decode(file_get_contents("php://input"), true);
    $userid = $data["userid"];
    $codeid = $data["codeid"];
    $value = $data["value"];
    registration($username, $email, $hashedPassword);
}

function registration($username, $email, $hashedPassword) {
    try {
        insertData("INSERT INTO felhasznalo (`nev`, `email`, `jelszo`, `pontok`, `letrehozasi_ido`, `utolso_valt_ido`) VALUES (?, ?, ?, NULL, current_timestamp(), current_timestamp());", "sss", [$username, $email, $hashedPassword]);
        return "success";
    }
    catch (Exception $e) {
        $errorMessage = $e->getMessage();
        if (strpos($errorMessage, "nev") != false) {
                return "taken-username";
            }
            else if (strpos($errorMessage, "email") != false) {
                return "taken-email";
            }
    }
}