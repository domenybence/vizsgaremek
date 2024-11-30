<?php

function generateToken($userid) {
    $token = bin2hex(random_bytes(32));
    $expiry = date("Y-m-d H:i:s", strtotime("+30 days"));
    try {
        $uploadToken = insertData("INSERT INTO felhasznalo_token (felhasznalo_token.felhasznalo_id, felhasznalo_token.token, felhasznalo_token.lejarat) VALUES (?, ?, ?);", "iss", [$userid, $token, $expiry]);
        if($uploadToken) {
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