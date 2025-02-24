<?php
include_once "../php_functions/php_functions.php";
if(session_status() === PHP_SESSION_NONE) {
    startSession();
}
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_SERVER["HTTP_JAVASCRIPT_FETCH_REQUEST"]) && $_SERVER["HTTP_JAVASCRIPT_FETCH_REQUEST"] === "submit-solution") {
    $data = json_decode(file_get_contents("php://input"), true);
    $requestId = $data["requestId"];
    $code = $data["code"];
    $request = preparedGetData(
        'SELECT felkeres.*, kategoria.nev AS category FROM felkeres INNER JOIN kategoria ON felkeres.kategoria_id = kategoria.id WHERE felkeres.id = ? AND elvallalo_felhasznalo_id = ? AND statusz = "folyamatban"', "ii", [$requestId, $_SESSION["userid"]]
    );
    if (!$request) {
        echo json_encode(["success" => false, "message" => "Nincs jogosultsága a megoldás beküldéséhez."]);
        exit;
    }
    /* ---------------------------------- TODO ---------------------------------- */
    $fileContent = $code;
    if (file_put_contents($filepath, $fileContent) === false) {
        echo json_encode(["success" => false, "message" => "Hiba történt a fájl létrehozása közben."]);
        exit;
    }
    $success = insertData(
        "UPDATE felkeres SET beadott_kod = ?, beadas_ideje = CURRENT_TIMESTAMP, kod_eleresi_ut = ? WHERE id = ?",
        "ssi",
        [$code, $filename, $requestId]
    );
    echo json_encode(["success" => $success]);
}