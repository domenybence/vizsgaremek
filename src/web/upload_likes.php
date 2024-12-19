<?php

include_once "../php_functions/php_functions.php";
$db = getDb();

// $fullURL = explode("/", $_SERVER["REQUEST_URI"]);
// $url = explode("?", end($fullURL))[0];

if($_SERVER["REQUEST_METHOD"] == "POST") {
    $data = json_decode(file_get_contents("php://input"), true);
    if($data) {
        $userid = $data["userid"];
        $codeid = $data["codeid"];
        $value = $data["value"];
        $getUserLike = preparedGetData("SELECT * FROM kod_like WHERE felhasznalo_id = ? AND kod_id = ?;", "ii", [$userid, $codeid]);
        if($getUserLike != false) {
            if($value !== null) {
                insertData("UPDATE kod_like SET ertek = ? WHERE felhasznalo_id = ? AND kod_id = ?", "iii", [$value, $userid, $codeid]);
            }
            else {
                insertData("DELETE FROM kod_like WHERE kod_id = ? && felhasznalo_id = ?;", "ii", [$codeid, $userid]);
            }
        }
        else {
            insertData("INSERT INTO kod_like(felhasznalo_id, kod_id, ertek) VALUES (?,?,?)", "iii", [$userid, $codeid, $value]);
        }
        echo json_encode(getCodeLikes($codeid)[0], JSON_UNESCAPED_UNICODE);
    }
}

function returnLikeState($userid, $codeid){
    $getUserLike = getUserLike($userid, $codeid);
    if (!empty($getUserLike)) {
        return $getUserLike[0]["ertek"];
    }
    return -1;
}

function getCodeLikes($codeid) {
    return preparedGetData("SELECT SUM((ertek = 1) - (ertek = 0)) AS likeCount FROM kod_like WHERE kod_id = ?;", "i", [$codeid]);
}

function getUserLike($userid, $codeid) {
    return preparedGetData("SELECT ertek FROM kod_like WHERE felhasznalo_id = ? AND kod_id = ?;", "ii", [$userid, $codeid]);
}