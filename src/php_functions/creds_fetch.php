<?php
include_once "php_functions.php";
startSession();

if($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_SERVER["HTTP_JAVASCRIPT_FETCH_REQUEST"]) && $_SERVER["HTTP_JAVASCRIPT_FETCH_REQUEST"] === "purchase-fetch-req") {
        $data = json_decode(file_get_contents("php://input"), true);
        $amount = $data["amount"];
        $success = insertData("UPDATE felhasznalo SET felhasznalo.pontok = felhasznalo.pontok + ? WHERE felhasznalo.nev = ?;", "is", [$amount, $_SESSION["username"]]);
        if($success != false) {
            http_response_code(200);
            echo json_encode(["result" => "success"], JSON_UNESCAPED_UNICODE);
        }
        else {
            http_response_code(406);
            echo json_encode(["result" => "error"], JSON_UNESCAPED_UNICODE);
        }
    }
}