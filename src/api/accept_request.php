<?php
include_once "../php_functions/php_functions.php";
if(session_status() === PHP_SESSION_NONE) {
    startSession();
}

if($_SERVER["REQUEST_METHOD"] == "POST" && isset($_SERVER["HTTP_JAVASCRIPT_FETCH_REQUEST"]) && $_SERVER["HTTP_JAVASCRIPT_FETCH_REQUEST"] === "accept-request") {
    $data = json_decode(file_get_contents("php://input"), true);
    $requestId = $data["requestId"];
    $request = preparedGetData(
        'SELECT felkeres.* FROM felkeres WHERE felkeres.id = ? AND felkeres.statusz = "nyitott"', 
        "i", 
        [$requestId]
    );
    if (!$request || $request[0]["felhasznalo_id"] == $_SESSION["userid"]) {
        echo json_encode(["success" => false, "message" => "A felkérés nem vállalható el."]);
        exit;
    }
    $filename = "test_r_" . $requestId;
    $filepath = "../web/codes/" . $filename . ".uqw";
    $fileContent = $request[0]["kod_minta"] ?? "// Nincs megadott kód minta";
    if (file_put_contents($filepath, $fileContent) === false) {
        echo json_encode(["success" => false, "message" => "Hiba történt a fájl létrehozása közben."]);
        exit;
    }
    $success = insertData(
        'UPDATE felkeres SET statusz = "folyamatban", elvallalo_felhasznalo_id = ?,kod_eleresi_ut = ? WHERE id = ?', 
        "isi", 
        [$_SESSION["userid"], $filename, $requestId]
    );
    echo json_encode(["success" => $success]);
}