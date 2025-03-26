<?php
include_once "../php_functions/php_functions.php";
include_once "../php_functions/get.php";
include_once "../php_functions/insert.php";

if(session_status() === PHP_SESSION_NONE) {
    startSession();
}

if($_SERVER["REQUEST_METHOD"] == "POST" && isset($_SERVER["HTTP_JAVASCRIPT_FETCH_REQUEST"]) && 
   $_SERVER["HTTP_JAVASCRIPT_FETCH_REQUEST"] === "delete-user") {
    
    if(!isset($_SESSION["role"]) || $_SESSION["role"] !== "admin") {
        http_response_code(403);
        echo json_encode(["success" => false, "message" => "Unauthorized access"]);
        exit();
    }
    
    $data = json_decode(file_get_contents("php://input"), true);
    
    if (!isset($data["id"])) {
        http_response_code(400);
        echo json_encode(["success" => false, "message" => "Missing user ID"]);
        exit();
    }
    
    $id = (int)$data["id"];
    
    if ($id === (int)$_SESSION["userid"]) {
        http_response_code(400);
        echo json_encode([
            "success" => false,
            "message" => "Nem törölheti a saját felhasználóját."
        ]);
        exit();
    }
    
    try {
        $checkQuery = "SELECT id FROM felhasznalo WHERE id = ?";
        $existingUser = preparedGetData($checkQuery, "i", [$id]);
        
        if (!$existingUser || !is_array($existingUser)) {
            http_response_code(404);
            echo json_encode([
                "success" => false,
                "message" => "Felhasználó nem található."
            ]);
            exit();
        }
        
        $query = "DELETE FROM felhasznalo WHERE id = ?";
        $success = insertData($query, "i", [$id]);
        
        if ($success === true) {
            echo json_encode([
                "success" => true,
                "message" => "A felhasználó sikeresen törölve."
            ]);
        }
        else {
            http_response_code(500);
            echo json_encode([
                "success" => false,
                "message" => "Hiba történt a felhasználó törlésekor."
            ]);
        }
    }
    catch (Exception $e) {
        http_response_code(500);
        echo json_encode([
            "success" => false,
            "message" => "Database error: " . $e->getMessage()
        ]);
    }
} else {
    http_response_code(400);
    echo json_encode([
        "success" => false, 
        "message" => "Invalid request"
    ]);
}