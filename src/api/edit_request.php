<?php
include_once "../php_functions/php_functions.php";
if(session_status() === PHP_SESSION_NONE) {
    startSession();
}

if($_SERVER["REQUEST_METHOD"] == "POST" && isset($_SERVER["HTTP_JAVASCRIPT_FETCH_REQUEST"]) && $_SERVER["HTTP_JAVASCRIPT_FETCH_REQUEST"] === "edit-request") {
    $data = json_decode(file_get_contents("php://input"), true);
    $requestId = $data["requestId"];
    $title = $data["title"];
    $price = $data["price"];
    $deadline = $data["deadline"];
    $description = $data["description"];
    $request = preparedGetData("SELECT felkeres.* FROM felkeres WHERE felkeres.id = ? AND felkeres.felhasznalo_id = ? AND felkeres.statusz = 'nyitott'", "ii", [$requestId, $_SESSION["userid"]]);
    if(!$request || empty($request)) {
        echo json_encode([
            "success" => false, 
            "message" => "Nincs jogosultsága a felkérés szerkesztéséhez vagy a felkérést már valaki elvállalta."
        ]);
        exit;
    }
    $success = insertData("UPDATE felkeres SET nev = ?, ar = ?, hatarido = ?, leiras = ? WHERE id = ? AND felhasznalo_id = ? AND statusz = 'nyitott'", "sissii", [$title, $price, $deadline, $description, $requestId, $_SESSION["userid"]]);   
    if($success) {
        echo json_encode([
            "success" => true,
            "message" => "A felkérés sikeresen frissítve."
        ]);
    }
    else {
        echo json_encode([
            "success" => false,
            "message" => "Hiba történt a felkérés frissítése közben."
        ]);
    }
    exit;
}