<?php

include_once "db_connect.php";
session_start();

function getUser($username) {
    $db = getDb();
    if ($db->connect_errno) {
        return "<div class='error-group'>Az adatbázishoz nem sikerült hozzákapcsolódni!</div>";
    }
    $query = $db->prepare("SELECT felhasznalo.id AS id, felhasznalo.nev AS username, felhasznalo.jelszo AS password, felhasznalo.tipus AS role FROM felhasznalo WHERE felhasznalo.nev = ?;");
    $query->bind_param("s", $username);
    try {
        $query->execute();
        $result = $query->get_result();
        if ($result->num_rows > 0) {
            return $result->fetch_assoc();
        }
        else {
            return null;
        }
    }
    catch (Exception $e) {
        return "<div class='error-group'>Hiba történt a lekérdezés során!</div>";
    }
    finally {
        $query->close();
        $db->close();
    }
}

function login($username, $password, $rememberme) {
    $user = getUser($username);
    if (!$user) {
        return "<div class='inline-error'>Hibás felhasználónév vagy jelszó!</div>";
    }
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

function rememberMe(){

}