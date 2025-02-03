<?php

include_once "php_functions.php";

function login($username, $password, $rememberme) {
    if(!$rememberme) {
        $user = preparedGetData("SELECT felhasznalo.id AS id, felhasznalo.nev AS username, felhasznalo.jelszo AS password, felhasznalo.tipus AS role FROM felhasznalo WHERE felhasznalo.nev = ?;", "s", $username);
        if (!$user) {
            return false;
        }
        if (password_verify($password, $user[0]["password"])) {
            $role = setRole($user[0]["role"]);
            setSession($user[0]["username"], $user[0]["id"], $role);
            startSession();
            return true;
        }
        else {
            return false;
        }
    }
    else {
        $user = preparedGetData("SELECT felhasznalo.id AS id, felhasznalo.nev AS username, felhasznalo.jelszo AS password, felhasznalo.tipus AS role FROM felhasznalo WHERE felhasznalo.nev = ?;", "s", $username);
        if (!$user) {
            return false;
        }
        $user = $user[0];
        if (password_verify($password, $user["password"])) {
            $role = setRole($user["role"]);
            if(setFirstSession($user["username"], $user["id"], $role)) {
                return true;
            }
            else {
                return false;
            }
        }
        else {
            return false;
        }
    }
}