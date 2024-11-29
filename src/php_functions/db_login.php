<?php

include_once "db_connect.php";
include_once "db_get.php";
session_start();

function login($username, $password, $rememberme) {
    if(!$rememberme) {
        $user = getData("SELECT felhasznalo.id AS id, felhasznalo.nev AS username, felhasznalo.jelszo AS password, felhasznalo.tipus AS role FROM felhasznalo WHERE felhasznalo.nev = ?;", "s", $username);
        if (!$user) {
            return "<div class='inline-error'>Hibás felhasználónév vagy jelszó!</div>";
        }
        $user = $user[0];
        if (password_verify($password, $user["password"])) {
            $_SESSION["username"] = $user["username"];
            $_SESSION["userid"] = $user["id"];
            if($user["role"] == 0){
                $_SESSION["role"] = "guest";
            }
            else if($user["role"] == 1){
                $_SESSION["role"] = "moderator";
            }
            else if($user["role"] == 2){
                $_SESSION["role"] = "admin";
            }
            return true;
        }
        else {
            return "<div class='inline-error'>Helytelen felhasználónév vagy jelszó!</div>";
        }
    }
    else {
        $user = getData("SELECT felhasznalo.id AS id, felhasznalo.nev AS username, felhasznalo.jelszo AS password, felhasznalo.tipus AS role FROM felhasznalo WHERE felhasznalo.nev = ?;", "s", $username);
        if (!$user) {
            return "<div class='inline-error'>Hibás felhasználónév vagy jelszó!</div>";
        }
        $user = $user[0];
        if (password_verify($password, $user["password"])) {
            $_SESSION["username"] = $user["username"];
            $_SESSION["userid"] = $user["id"];
            if($user["role"] == 0){
                $_SESSION["role"] = "guest";
            }
            else if($user["role"] == 1){
                $_SESSION["role"] = "moderator";
            }
            else if($user["role"] == 2){
                $_SESSION["role"] = "admin";
            }
            $token = bin2hex(random_bytes(32));
            $expiry = date("Y-m-d H:i:s", strtotime("+30 days"));
            /* ---------------------------------- todo ---------------------------------- */
            $uploadToken = insertData("INSERT INTO felhasznalo_token (felhasznalo_token.felhasznalo_id, felhasznalo_token.token, felhasznalo_token.lejarat) VALUES (?, ?, ?);", "iss");
            return true;
        }
    }
}