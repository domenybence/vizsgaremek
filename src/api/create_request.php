<?php
include_once "../php_functions/php_functions.php";
if(session_status() === PHP_SESSION_NONE) {
    startSession();
}

if($_SERVER["REQUEST_METHOD"] == "POST" && isset($_SERVER["HTTP_JAVASCRIPT_FETCH_REQUEST"]) && $_SERVER["HTTP_JAVASCRIPT_FETCH_REQUEST"] === "create-request") {
    if($_SESSION["username"] === "Vendég") {
        echo json_encode([
            "success" => false, 
            "message" => "Be kell jelentkeznie a felkérés létrehozásához."
        ]);
        exit;
    }
    
    $data = json_decode(file_get_contents("php://input"), true);
    $title = $data["title"];
    $categoryId = $data["categoryId"];
    $price = $data["price"];
    $deadline = $data["deadline"];
    $description = $data["description"];
    $userId = $_SESSION["userid"];
    
    if(empty($title) || empty($categoryId) || !isset($price) || empty($deadline) || empty($description)) {
        echo json_encode([
            "success" => false, 
            "message" => "Minden mezőt ki kell tölteni."
        ]);
        exit;
    }
    
    $category = preparedGetData("SELECT id FROM kategoria WHERE id = ?", "i", [$categoryId]);
    if(!$category) {
        echo json_encode([
            "success" => false, 
            "message" => "A kiválasztott kategória nem létezik."
        ]);
        exit;
    }
    
    $deadlineDate = new DateTime($deadline);
    $today = new DateTime();
    $today->setTime(0, 0, 0);
    
    if($deadlineDate < $today) {
        echo json_encode([
            "success" => false, 
            "message" => "A határidő nem lehet korábbi, mint a mai nap."
        ]);
        exit;
    }
    
    $result = insertData("INSERT INTO felkeres (nev, leiras, statusz, ar, hatarido, feltoltesi_ido, felhasznalo_id, kategoria_id) 
        VALUES (?, ?, 'nyitott', ?, ?, NOW(), ?, ?)", "ssisii", [$title, $description, $price, $deadline, $userId, $categoryId]);
    
    if($result) {
        $lastId = simpleGetData("SELECT LAST_INSERT_ID() as id");
        $requestId = $lastId[0]["id"];
        
        echo json_encode([
            "success" => true,
            "message" => "A felkérés sikeresen létrehozva.",
            "requestId" => $requestId
        ]);
    }
    else {
        echo json_encode([
            "success" => false,
            "message" => "Hiba történt a felkérés létrehozása közben."
        ]);
    }
    
    exit;
}