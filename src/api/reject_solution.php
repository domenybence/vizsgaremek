<?php
include_once "../php_functions/php_functions.php";
if(session_status() === PHP_SESSION_NONE) {
    startSession();
}

if($_SERVER["REQUEST_METHOD"] == "POST" && isset($_SERVER["HTTP_JAVASCRIPT_FETCH_REQUEST"]) && $_SERVER["HTTP_JAVASCRIPT_FETCH_REQUEST"] === "reject-solution") {
    $data = json_decode(file_get_contents("php://input"), true);
    $requestId = $data["requestId"];
    $reason = $data["reason"] ?? "Nincs megadva";
    
    $request = preparedGetData("SELECT felkeres.*, kod.id AS kod_id, kod.eleresi_ut FROM felkeres LEFT JOIN kod ON kod.eleresi_ut = felkeres.kod_eleresi_ut WHERE felkeres.id = ? AND felkeres.felhasznalo_id = ? AND felkeres.statusz = 'teljesitve'", "ii", [$requestId, $_SESSION["userid"]]);
    
    if (!$request || empty($request)) {
        echo json_encode([
            "success" => false, 
            "message" => "Nincs jogosultsága a megoldás elutasításához vagy a felkérés nem teljesített állapotban van."
        ]);
        exit;
    }
    
    $request = $request[0];
    $kodId = $request["kod_id"];
    $solverId = $request["elvallalo_felhasznalo_id"];
    $updateRequest = insertData("UPDATE felkeres SET statusz = 'elutasítva', kod_eleresi_ut = NULL, beadas_ideje = NULL WHERE id = ?", "i", [$requestId]);
    if (!$updateRequest) {
        echo json_encode([
            "success" => false, 
            "message" => "Hiba történt a felkérés visszaállítása közben."
        ]);
        exit;
    }
    if ($kodId) {
        insertData("DELETE FROM felhasznalo_megvett WHERE kod_id = ?", "i", [$kodId]);
        insertData("DELETE FROM kod WHERE id = ?", "i", [$kodId]);
    }
    
    echo json_encode([
        "success" => true, 
        "message" => "A megoldás sikeresen elutasítva!"
    ]);
    exit;
}