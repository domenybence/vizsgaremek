<?php

function startSession() {
    session_start();
    if(isset($_SESSION["username"])) {
        
    }
    else if(isset($_COOKIE["rememberme"])) {
        $token = $_COOKIE["rememberme"];
        $user = getData("SELECT felhasznalo.id AS id, felhasznalo.nev AS username, felhasznalo.tipus AS role FROM felhasznalo INNER JOIN felhasznalo_token ON felhasznalo_token.felhasznalo_id WHERE felhasznalo_token.token = ? AND felhasznalo_token.lejarat > NOW();", "s", $token);
        $user = $user[0];
        if($user !== false) {
            generateToken($user["id"]);
            $role = setRole($user["role"]);
            setSession($user["username"], $user["id"], $role);
        }
        else {
            unsetCookie();
        }
    }
    else {
        unsetCookie();
    }
}

function setRole($role) {
    if($role === 0) {
        return "guest";
    }
    else if($role === 1){
        return "moderator";
    }
    else if($role === 2){
        return "admin";
    }
}

function setSession($username, $userid, $role) {
    session_start();
    $_SESSION["userid"] = $userid;
    $_SESSION["username"] = $username;
    $_SESSION["role"] = $role;
}

function unsetCookie() {
    setcookie("rememberme", "", time() - 3600, "/");
    $_SESSION["username"] = "Vendég";
    $_SESSION["role"] = "guest";
}