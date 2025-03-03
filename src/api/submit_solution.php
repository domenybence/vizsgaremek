<?php
include_once "../php_functions/php_functions.php";
if(session_status() === PHP_SESSION_NONE) {
    startSession();
}
if($_SERVER["REQUEST_METHOD"] == "POST" && isset($_SERVER["HTTP_JAVASCRIPT_FETCH_REQUEST"]) && $_SERVER["HTTP_JAVASCRIPT_FETCH_REQUEST"] === "submit-solution") {
    $data = json_decode(file_get_contents("php://input"), true);
    $requestId = $data["requestId"];
    $code = $data["code"];
    $request = preparedGetData('SELECT felkeres.*, kategoria.nev AS category, felkeres.nev AS requestname, kategoria.id AS kategoria_id FROM felkeres INNER JOIN kategoria ON felkeres.kategoria_id = kategoria.id WHERE felkeres.id = ? AND elvallalo_felhasznalo_id = ? AND statusz = "folyamatban"', "ii", [$requestId, $_SESSION["userid"]]);
    if (!$request || empty($request)) {
        echo json_encode(["success" => false, "message" => "Nincs jogosultsága a kód beküldéséhez."]);
        exit;
    }
    $request = $request[0];
    $cleanTitle = preg_replace('/[^a-zA-Z0-9]/', '-', $request["requestname"]);
    $cleanTitle = substr($cleanTitle, 0, 30);
    $tempFilename = $cleanTitle . "-temp.uqw";
    $requesterId = $request["felhasznalo_id"];
    $codeNev = $request["requestname"];
    $kategoriaId = $request["kategoria_id"];
    $insertcode = insertData("INSERT INTO kod (felhasznalo_id, kategoria_id, nev, ar, eleresi_ut, feltoltesi_ido, jovahagyott) VALUES (?, ?, ?, 0, ?, CURRENT_TIMESTAMP, 1)", "iiss", [$requesterId, $kategoriaId, $codeNev, $tempFilename]);
    if(!$insertcode) {
        echo json_encode(["success" => false, "message" => "Hiba történt az adatbázisba való feltöltés közben."]);
        exit;
    }
    $newcodeId = preparedGetData("SELECT MAX(id) as kod_id FROM kod WHERE felhasznalo_id = ? AND nev = ? AND eleresi_ut = ?", "iss", [$requesterId, $codeNev, $tempFilename]);
    if(!$newcodeId || empty($newcodeId)) {
        echo json_encode(["success" => false, "message" => "Nem sikerült azonosítót generálni a kód számára."]);
        exit;
    }
    $codeId = $newcodeId[0]["kod_id"];
    $filename = $cleanTitle . "-" . $codeId . ".uqw";
    $updatecodeFilename = insertData("UPDATE kod SET eleresi_ut = ? WHERE id = ?", "si", [$filename, $codeId]);
    $filepath = "../web/codes/";
    $fullPath = $filepath . $filename;
    if(file_put_contents($fullPath, $code) === false) {
        echo json_encode(["success" => false, "message" => "Hiba történt a fájl létrehozása közben."]);
        exit;
    }
    
    $updateRequest = insertData("UPDATE felkeres SET beadas_ideje = CURRENT_TIMESTAMP, kod_eleresi_ut = ?, statusz = 'teljesitve' WHERE id = ?", "si", [$filename, $requestId]);
    if(!$updateRequest) {
        echo json_encode(["success" => false, "message" => "Hiba történt a felkérés frissítésekor!"]);
        exit;
    }
    
    insertData("INSERT INTO felhasznalo_megvett (felhasznalo_id, kod_id) VALUES (?, ?)", "ii", [$requesterId, $codeId]);
    echo json_encode(["success" => true, "message" => "A kód sikeresen beküldve!"]);
    exit;
}
