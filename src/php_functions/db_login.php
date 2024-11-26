<?php

include_once "db_connect.php";
include_once "db_get.php";

function login($username, $password) {
    $user = getData("SELECT felhasznalo.id AS id, felhasznalo.nev AS username, felhasznalo.jelszo AS password, felhasznalo.tipus AS role FROM felhasznalo WHERE felhasznalo.nev = ?;", "s", $username);
    if (!$user) {
        return "<div class='inline-error'>Hibás felhasználónév vagy jelszó!</div>";
    }
    $user = $user[0];
    if (password_verify($password, $user["password"])) {
        $_SESSION["username"] = $user["username"];
        $_SESSION["userid"] = $user["id"];
        if($user["role"] === 0){
            $_SESSION["role"] = "guest";
        }
        else if($user["role"] === 1){
            $_SESSION["role"] = "moderator";
        }
        else if($user["role"] === 2){
            $_SESSION["role"] = "admin";
        }
        return true;
    }
    else {
        return "<div class='inline-error'>Helytelen felhasználónév vagy jelszó!</div>";
    }
}