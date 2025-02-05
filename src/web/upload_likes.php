<?php

include_once "../php_functions/php_functions.php";
$db = getDb();

if($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_SERVER["HTTP_JAVASCRIPT_FETCH_REQUEST"]) && $_SERVER["HTTP_JAVASCRIPT_FETCH_REQUEST"] === "like-fetch-req") {
    $data = json_decode(file_get_contents("php://input"), true);
    if($data) {
        $userid = $data["userid"];
        $codeid = $data["codeid"];
        $value = $data["value"];
        $getUserLike = preparedGetData("SELECT * FROM kod_like WHERE felhasznalo_id = ? AND kod_id = ? AND aktiv = 1;", "ii", [$userid, $codeid]);
        if($getUserLike != false) {
            if($value !== null) {
                insertData("UPDATE kod_like SET ertek = ? WHERE felhasznalo_id = ? AND kod_id = ? AND aktiv = 1", "iii", [$value, $userid, $codeid]);
            }
            else {
                insertData("UPDATE kod_like SET aktiv = 0 WHERE kod_id = ? AND felhasznalo_id = ?;", "ii", [$codeid, $userid]);
            }
        }
        else {
            $inactiveLike = preparedGetData("SELECT * FROM kod_like WHERE felhasznalo_id = ? AND kod_id = ? AND aktiv = 0;", "ii", [$userid, $codeid]);
            if ($inactiveLike != false) {
                if ($value !== null) {
                    insertData("UPDATE kod_like SET ertek = ?, aktiv = 1 WHERE felhasznalo_id = ? AND kod_id = ? AND aktiv = 0", "iii", [$value, $userid, $codeid]);
                }
                else {
                    insertData("UPDATE kod_like SET aktiv = 1 WHERE felhasznalo_id = ? AND kod_id = ? AND aktiv = 0", "ii", [$userid, $codeid]);
                }
            }
            else {
                if ($value !== null) {
                    insertData("INSERT INTO kod_like(felhasznalo_id, kod_id, ertek, aktiv) VALUES (?,?,?,1)", "iii", [$userid, $codeid, $value]);
                }
            }
        }
        echo json_encode(getCodeLikes($codeid)[0], JSON_UNESCAPED_UNICODE);
    }
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
    $preparedData = preparedGetData("SELECT SUM((ertek = 1) - (ertek = 0)) AS likeCount FROM kod_like WHERE kod_id = ? AND aktiv = 1;", "i", [$codeid]);
    return $preparedData;
}

function getUserLike($userid, $codeid) {
    return preparedGetData("SELECT ertek FROM kod_like WHERE felhasznalo_id = ? AND kod_id = ? AND aktiv = 1;", "ii", [$userid, $codeid]);
}