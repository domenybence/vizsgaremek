<?php

function startSession() {
    session_start();
    if(isset($_SESSION["username"])) {
        return;
    }
    else if(isset($_COOKIE["rememberme"])) {
        $token = $_COOKIE["rememberme"];
        $user = simpleGetData("SELECT felhasznalo.id AS id, felhasznalo.nev AS username, felhasznalo.tipus AS role, felhasznalo_token.token FROM felhasznalo INNER JOIN felhasznalo_token ON felhasznalo_token.felhasznalo_id = felhasznalo.id WHERE felhasznalo_token.lejarat > NOW()");
        $tokenExists = false;
        if($user != false) {
            foreach ($user as $u) {
                if(password_verify($token, $u["token"])){
                    generateToken($u["id"]);
                    $role = setRole($u["role"]);
                    setSession($u["username"], $u["id"], $role);
                    $tokenExists = true;
                }
            }
        }
        if(!$tokenExists) {
            unsetCookie();
        }
    }
    else {
        unsetCookie();
    }
}

function setRole($role) {
    if($role == 0) {
        return "guest";
    }
    else if($role == 1){
        return "moderator";
    }
    else if($role == 2){
        return "admin";
    }
}

function setSession($username, $userid, $role) {
    if(!isset($_SESSION)) {
        session_start();
    }
    $_SESSION["username"] = $username;
    $_SESSION["userid"] = $userid;
    $_SESSION["role"] = $role;
}

function unsetCookie() {
    setcookie("rememberme", "", time() - 3600, "/");
    $_SESSION["username"] = "Vendég";
    $_SESSION["role"] = "guest";
}

function setFirstSession($username, $id, $role) {
    session_start();
    if(isset($_COOKIE["rememberme"])) {
        unsetCookie();
    }
    $token = generateToken($id);
    if($token !== false) {
        setSession($username, $id, $role);
        return true;
    }
    else {
        return false;
    }
}

function getStatusText($status) {
    $statusMap = [
        "nyitott" => "Nyitott",
        "folyamatban" => "Folyamatban",
        "teljesitve" => "Teljesítve",
        "elutasitva" => "Elutasítva"
    ];
    return $statusMap[$status] ?? $status;
}

function formatDate($date) {
    if (!$date) return "Nincs megadva";
    return date("Y.m.d H:i", strtotime($date));
}