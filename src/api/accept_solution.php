<?php
include_once "../php_functions/php_functions.php";
if(session_status() === PHP_SESSION_NONE) {
    startSession();
}

if($_SERVER["REQUEST_METHOD"] == "POST" && isset($_SERVER["HTTP_JAVASCRIPT_FETCH_REQUEST"]) && $_SERVER["HTTP_JAVASCRIPT_FETCH_REQUEST"] === "accept-solution") {
    $data = json_decode(file_get_contents("php://input"), true);
    $requestId = $data["requestId"];
    
    $request = preparedGetData("SELECT * FROM felkeres WHERE id = ? AND felhasznalo_id = ? AND statusz = 'teljesitve'", "ii", [$requestId, $_SESSION["userid"]]);
    
    if (!$request || empty($request)) {
        echo json_encode([
            "success" => false, 
            "message" => "Nincs jogosultsága a megoldás elfogadásához vagy a felkérés nem teljesített állapotban van."
        ]);
        exit;
    }
    
    $request = $request[0];
    $solverId = $request["elvallalo_felhasznalo_id"];
    $requesterId = $request["felhasznalo_id"];
    $price = $request["ar"];
    
    $updateRequest = insertData("UPDATE felkeres SET statusz = 'jóváhagyott' WHERE id = ?", "i", [$requestId]);
    
    if (!$updateRequest) {
        echo json_encode([
            "success" => false, 
            "message" => "Hiba történt a felkérés elfogadása közben."
        ]);
        exit;
    }
    
    $subtractPoints = insertData("UPDATE felhasznalo SET pontok = pontok - ? WHERE id = ?", "ii", [$price, $requesterId]);
    
    if (!$subtractPoints) {
        echo json_encode([
            "success" => false, 
            "message" => "Hiba történt a pontok levonása közben."
        ]);
        exit;
    }
    
    $updatePoints = insertData("UPDATE felhasznalo SET pontok = pontok + ? WHERE id = ?", "ii", [$price, $solverId]);
    
    if (!$updatePoints) {
        echo json_encode([
            "success" => false, 
            "message" => "Hiba történt a pontok hozzáadása közben."
        ]);
        exit;
    }
    
    echo json_encode([
        "success" => true, 
        "message" => "A megoldás sikeresen elfogadva! A pontok átutalásra kerültek."
    ]);
    exit;
}

http_response_code(403);
echo json_encode(["success" => false, "message" => "Nem megengedett hozzáférés."]);
exit;