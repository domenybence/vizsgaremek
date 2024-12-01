<?php

include_once "db_connect.php";
include_once "db_get.php";
include_once "db_functions.php";

function login($username, $password, $rememberme) {
    if(!$rememberme) {
        $user = getData("SELECT felhasznalo.id AS id, felhasznalo.nev AS username, felhasznalo.jelszo AS password, felhasznalo.tipus AS role FROM felhasznalo WHERE felhasznalo.nev = ?;", "s", $username);
        if (!$user) {
            return "<div class='inline-error'>Hibás felhasználónév vagy jelszó!</div>";
        }
        if (password_verify($password, $user[0]["password"])) {
            $role = setRole($user[0]["role"]);
            setSession($user[0]["username"], $user[0]["id"], $role);
            startSession();
            return true;
        }
        else {
            return "<div class='inline-error'>Hibás felhasználónév vagy jelszó!</div>";
        }
    }
    else {
        $user = getData("SELECT felhasznalo.id AS id, felhasznalo.nev AS username, felhasznalo.jelszo AS password, felhasznalo.tipus AS role FROM felhasznalo WHERE felhasznalo.nev = ?;", "s", $username);
        if (!$user) {
            return "<div class='inline-error'>Hibás felhasználónév vagy jelszó!</div>";
        }
        $user = $user[0];
        if (password_verify($password, $user["password"])) {
            $token = generateToken($user["id"]);
            if($token != false) {
                $role = setRole($user["role"]);
                setSession($user["username"], $user["id"], $role);
                startSession();
                return true;
            }
            else {
                echo "<div class='inline-error'>Hiba lépett fel a felhasználó beléptetése során, kérjük próbálja újra később.</div>";
                return false;
            }
        }
    }
}