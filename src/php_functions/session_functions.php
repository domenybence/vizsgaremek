<?php

function startSession() {
    session_start();
    if (isset($_SESSION["userid"])) {
        $userid = $_SESSION["userid"];
        $username = $_SESSION["username"];
        $role = $_SESSION["role"];
    }
    else if(isset($_COOKIE["rememberme"])) {
        $token = $_COOKIE["rememberme"];
        $user = getData("SELECT felhasznalo.id, felhasznalo.nev AS username, felhasznalo.tipus AS role FROM felhasznalo INNER JOIN felhasznalo_token ON felhasznalo_token.felhasznalo_id WHERE felhasznalo_token.token = ? AND felhasznalo_token.lejarat > NOW();", "s", $token);
        if($user) {
            $_SESSION["userid"] = $user["id"];
            $_SESSION["username"] = $user["username"];
            if($user["role"] === 0) {
                $_SESSION["role"] = "guest";
            }
            else if($user["role"] === 1){
                $_SESSION["role"] = "moderator";
            }
            else if($user["role"] === 2){
                $_SESSION["role"] = "admin";
            }
            if(generateToken($user["id"]) !== false) {
                setcookie("rememberme", $token, time() + (30 * 24 * 60 * 60), "/", "", false, true);
            }
            else {
                setcookie("rememberme", "", time() - 3600, "/", "", false, true);
                header("Location: login.php");
                exit();
            }
        }
        else {
            setcookie("rememberme", "", time() - 3600, "/", "", false, true);
            header("Location: login.php");
            exit();
        }
    }
}