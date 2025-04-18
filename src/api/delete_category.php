<?php
include_once "../php_functions/php_functions.php";
include_once "../php_functions/get.php";
include_once "../php_functions/insert.php";

if(session_status() === PHP_SESSION_NONE) {
    startSession();
}

if($_SERVER["REQUEST_METHOD"] == "POST" && isset($_SERVER["HTTP_JAVASCRIPT_FETCH_REQUEST"]) && 
   $_SERVER["HTTP_JAVASCRIPT_FETCH_REQUEST"] === "delete-category") {
    
    if(!isset($_SESSION["role"]) || $_SESSION["role"] !== "admin") {
        http_response_code(403);
        echo json_encode(["success" => false, "message" => "Unauthorized access"]);
        exit();
    }
    
    $data = json_decode(file_get_contents("php://input"), true);
    
    if (!isset($data["id"])) {
        http_response_code(400);
        echo json_encode(["success" => false, "message" => "Missing category ID"]);
        exit();
    }
    
    $id = (int)$data["id"];
    
    
    
    try {
        $checkQuery = "SELECT id FROM kategoria WHERE id = ?";
        $existingUser = preparedGetData($checkQuery, "i", [$id]);
        
        if (!$existingUser || !is_array($existingUser)) {
            http_response_code(404);
            echo json_encode([
                "success" => false,
                "message" => "Kategória nem található."
            ]);
            exit();
        }
        
        $query = "DELETE FROM kategoria WHERE id = ?";
        $success = insertData($query, "i", [$id]);
        
        if ($success === true) {
            echo json_encode([
                "success" => true,
                "message" => "A kategória sikeresen törölve."
            ]);
        }
        else {
            http_response_code(500);
            echo json_encode([
                "success" => false,
                "message" => "Hiba történt a kategória törlésekor."
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