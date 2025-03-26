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
    
    $userRole = $_SESSION["role"] ?? "user";
    $isAdmin = ($userRole === "admin");
    $isModerator = ($userRole === "moderator");
    
    $request = preparedGetData("SELECT * FROM felkeres WHERE id = ?", "i", [$requestId]);
    
    if(!$request || empty($request)) {
        echo json_encode(["success" => false, "message" => "A felkérés nem található."]);
        exit;
    }
    
    $request = $request[0];
    $isOwner = ($request["felhasznalo_id"] == $_SESSION["userid"]);
    $isEditable = ($request["statusz"] === "nyitott");
    
    if(!($isAdmin || $isModerator || ($isOwner && $isEditable))) {
        echo json_encode(["success" => false, "message" => "Nincs jogosultsága szerkeszteni ezt a felkérést."]);
        exit;
    }
    
    $result = insertData("UPDATE felkeres SET nev = ?, ar = ?, hatarido = ?, leiras = ? WHERE id = ?", "sissi", [$title, $price, $deadline, $description, $requestId]);
    
    if($result) {
        echo json_encode(["success" => true, "message" => "A felkérés sikeresen frissítve."]);
    }
    else {
        echo json_encode(["success" => false, "message" => "Hiba történt a felkérés frissítése közben."]);
    }
    exit;
}