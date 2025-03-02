<?php
include_once "../php_functions/php_functions.php";
if(session_status() === PHP_SESSION_NONE) {
    startSession();
}
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_SERVER["HTTP_JAVASCRIPT_FETCH_REQUEST"]) && $_SERVER["HTTP_JAVASCRIPT_FETCH_REQUEST"] === "submit-solution") {
    $data = json_decode(file_get_contents("php://input"), true);
    $requestId = $data["requestId"];
    $code = $data["code"];
    $request = preparedGetData('SELECT felkeres.*, kategoria.nev AS category, felkeres.nev AS requestname FROM felkeres INNER JOIN kategoria ON felkeres.kategoria_id = kategoria.id WHERE felkeres.id = ? AND elvallalo_felhasznalo_id = ? AND statusz = "folyamatban"', "ii", [$requestId, $_SESSION["userid"]]);
    if (!$request || empty($request)) {
        echo json_encode(["success" => false, "message" => "Nincs jogosultsága a kód beküldéséhez."]);
        exit;
    }
    $request = $request[0];
    $cleanRequestName = preg_replace('/[^a-zA-Z0-9]/', '_', $request["requestname"]);
    $filename = $requestId . "-" . $cleanRequestName . "-r.uqw";
    $filepath = "../web/codes/";
    $fullPath = $filepath . $filename;
    if(file_put_contents($fullPath, $code) === false) {
        echo json_encode(["success" => false, "message" => "Hiba történt a fájl létrehozása közben."]);
        exit;
    }
    $relativePath = "codes/" . $filename;
    $success = insertData("UPDATE felkeres SET beadas_ideje = CURRENT_TIMESTAMP, kod_eleresi_ut = ? WHERE id = ?", "si", [$filename, $requestId]);
    
    if($success) {
        echo json_encode(["success" => true, "message" => "A kód sikeresen beküldve!"]);
    }
    else {
        echo json_encode(["success" => false, "message" => "Hiba történt az adatbázis frissítése közben."]);
    }
    exit;
}