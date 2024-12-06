<?php

function generateToken($userid) {
    $token = bin2hex(random_bytes(32));
    $hashedToken = password_hash($token, PASSWORD_DEFAULT);
    $expiry = date("Y-m-d H:i:s", strtotime("+30 days"));
    try {
        $uploadToken = insertData("INSERT INTO felhasznalo_token (felhasznalo_token.felhasznalo_id, felhasznalo_token.token, felhasznalo_token.lejarat) VALUES (?, ?, ?);", "iss", [$userid, $hashedToken, $expiry]);
        if($uploadToken) {
            setcookie("rememberme", $token, time() + (30 * 24 * 60 * 60), "/", "", false, true);
            return $token;
        }
        else {
            return false;
        }
    }
    catch(PDOException $e) {
        if (strpos($e->getMessage(), "token") !== false) {
            generateToken($userid);
        }
    }
}