<?php

include_once "php_functions.php";
if($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_SERVER["HTTP_JAVASCRIPT_FETCH_REQUEST"]) && $_SERVER["HTTP_JAVASCRIPT_FETCH_REQUEST"] === "codepurchase-fetch-req") {
        $data = json_decode(file_get_contents("php://input"), true);
        $userid = $data["userid"];
        $codeid = $data["codeid"];
        $userpoints = preparedGetData("SELECT felhasznalo.pontok FROM felhasznalo WHERE felhasznalo.id = ?;", "i", [$userid]);
        $codeprice = preparedGetData("SELECT kod.ar FROM kod WHERE kod.id = ?;", "i", [$codeid]);
        if($userpoints[0]["pontok"] >= $codeprice[0]["ar"]) {
            $successful = insertData("UPDATE felhasznalo SET felhasznalo.pontok = felhasznalo.pontok - ? WHERE felhasznalo.id = ?;", "ii", [$codeprice[0]["ar"], $userid]);
            if($successful) {
                $successful2 = insertData("INSERT INTO felhasznalo_megvett(felhasznalo_id, kod_id) VALUES (?,?);", "ii", [$userid, $codeid]);
                if($successful2) {
                    $uploaderData = preparedGetData("SELECT felhasznalo_id FROM kod WHERE id = ?;", "i", [$codeid]);
                    if($uploaderData) {
                        $uploaderId = $uploaderData[0]["felhasznalo_id"];
                        insertData("UPDATE felhasznalo SET pontok = pontok + ? WHERE id = ?;", "ii", [$codeprice[0]["ar"], $uploaderId]);
                    }
                    echo json_encode(["result" => "success"], JSON_UNESCAPED_UNICODE);
                }
                else {
                    echo json_encode(["result" => "error"], JSON_UNESCAPED_UNICODE);
                }
            }
        }
        else {
            echo json_encode(["result" => "insufficient_points"], JSON_UNESCAPED_UNICODE);
        }
    }
}