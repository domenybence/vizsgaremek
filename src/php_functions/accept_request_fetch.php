<?php

include_once "php_functions.php";
if($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_SERVER["HTTP_JAVASCRIPT_FETCH_REQUEST"]) && $_SERVER["HTTP_JAVASCRIPT_FETCH_REQUEST"] === "accreq-fetch-req") {
        $data = json_decode(file_get_contents("php://input"), true);
        $userid = $data["userid"];
        $request = $data["requestid"];
        $isaccepted = insertData("UPDATE felkeres SET elvallalo_felhasznalo_id = ?, befejezesi_ido = NULL WHERE felkeres.id = ?;", "ii", [$userid, $request]);
        if($isaccepted) {
            echo json_encode(["result" => "success"], JSON_UNESCAPED_UNICODE);
        }
        else {
            echo json_encode(["result" => "error"], JSON_UNESCAPED_UNICODE);
        }
    }
}