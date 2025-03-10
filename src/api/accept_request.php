<?php
include_once "../php_functions/php_functions.php";
if(session_status() === PHP_SESSION_NONE) {
    startSession();
}

if($_SERVER["REQUEST_METHOD"] == "POST" && isset($_SERVER["HTTP_JAVASCRIPT_FETCH_REQUEST"]) && $_SERVER["HTTP_JAVASCRIPT_FETCH_REQUEST"] === "accept-request") {
    $data = json_decode(file_get_contents("php://input"), true);
    $requestId = $data["requestId"];
    $request = preparedGetData('SELECT * FROM felkeres WHERE id = ? AND statusz = "nyitott" AND (elvallalo_felhasznalo_id IS NULL OR elvallalo_felhasznalo_id = 0)',"i", [$requestId]
    );
    
    if (!$request || empty($request)) {
        echo json_encode([
            "success" => false, 
            "message" => "A felkérés már nem elérhető vagy valaki más már elvállalta."
        ]);
        exit;
    }
    $success = insertData('UPDATE felkeres SET statusz = "folyamatban", elvallalo_felhasznalo_id = ? WHERE id = ?', "ii", [$_SESSION["userid"], $requestId]
    );
    
    echo json_encode([
        "success" => $success,
        "message" => $success ? "A felkérés sikeresen elvállalva." : "Hiba történt a felkérés elvállalása közben."
    ]);
    exit;
}