<?php
include_once "../php_functions/php_functions.php";
if(session_status() === PHP_SESSION_NONE) {
    startSession();
}

if($_SERVER["REQUEST_METHOD"] == "POST" && isset($_SERVER["HTTP_JAVASCRIPT_FETCH_REQUEST"]) && $_SERVER["HTTP_JAVASCRIPT_FETCH_REQUEST"] === "delete-request") {
    $data = json_decode(file_get_contents("php://input"), true);
    $requestId = $data["requestId"];
    
    $userRole = $_SESSION["role"] ?? "user";
    $isAdmin = ($userRole === "admin");
    $isModerator = ($userRole === "moderator");
    
    $request = preparedGetData("SELECT felkeres.*, kod.id AS kod_id, kod.eleresi_ut FROM felkeres LEFT JOIN kod ON kod.eleresi_ut = felkeres.kod_eleresi_ut WHERE felkeres.id = ?", "i", [$requestId]);
    
    if(!$request || empty($request)) {
        echo json_encode(["success" => false, "message" => "A felkérés nem található."]);
        exit;
    }
    
    $request = $request[0];
    $isOwner = ($request["felhasznalo_id"] == $_SESSION["userid"]);
    $isDeletable = ($request["statusz"] === "nyitott");
    
    if(!($isAdmin || $isModerator || ($isOwner && $isDeletable))) {
        echo json_encode(["success" => false, "message" => "Nincs jogosultsága törölni ezt a felkérést."]);
        exit;
    }

    if (!empty($request["kod_eleresi_ut"]) && !empty($request["kod_id"])) {
        $kodId = $request["kod_id"];
        $userId = $request["felhasznalo_id"];
        
        $existingEntry = preparedGetData("SELECT * FROM felhasznalo_megvett WHERE felhasznalo_id = ? AND kod_id = ?", "ii", [$userId, $kodId]);
        
        if (!$existingEntry) {
            insertData("INSERT INTO felhasznalo_megvett (felhasznalo_id, kod_id) VALUES (?, ?)", "ii", [$userId, $kodId]);
        }
    }
    
    $result = insertData("DELETE FROM felkeres WHERE id = ?", "i", [$requestId]);
    
    if($result) {
        echo json_encode([
            "success" => true, 
            "message" => "A felkérés sikeresen törölve."
        ]);
    }
    else {
        echo json_encode([
            "success" => false, 
            "message" => "Hiba történt a felkérés törlése közben."
        ]);
    }
    exit;
}