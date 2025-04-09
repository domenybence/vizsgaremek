<?php
include_once "../php_functions/php_functions.php";
include_once "../php_functions/get.php";
include_once "../php_functions/insert.php";

if(session_status() === PHP_SESSION_NONE) {
    startSession();
}

if($_SERVER["REQUEST_METHOD"] == "POST" && isset($_SERVER["HTTP_JAVASCRIPT_FETCH_REQUEST"]) && 
   $_SERVER["HTTP_JAVASCRIPT_FETCH_REQUEST"] === "update-category") {
    
    if(!isset($_SESSION["role"]) || $_SESSION["role"] !== "admin") {
        http_response_code(403);
        echo json_encode(["success" => false, "message" => "Unauthorized access"]);
        exit();
    }
    
    $data = json_decode(file_get_contents("php://input"), true);
    
    if (!isset($data["id"]) || !isset($data["nev"]) || !isset($data["compiler_azonosito"]) || 
        !isset($data["kep"])) {
        http_response_code(400);
        echo json_encode(["success" => false, "message" => "Missing required fields"]);
        exit();
    }
    
    $id = (int)$data["id"];
    $nev = $data["nev"];
    $compiler_azonosito = $data["compiler_azonosito"];
    $kep = $data["kep"];
    
    
    try {
        $checkQuery = "SELECT id FROM kategoria WHERE (nev = ? OR compiler_azonosito = ?) AND id != ?";
        $existingCategory = preparedGetData($checkQuery, "ssi", [$nev, $compiler_azonosito, $id]);
        
        if ($existingCategory && is_array($existingCategory)) {
            http_response_code(409);
            echo json_encode([
                "success" => false,
                "message" => "A kategória már létezik."
            ]);
            exit();
        }
        
     
           
        $query = "UPDATE kategoria SET nev = ?, compiler_azonosito = ?, kep = ? WHERE id = ?";
        $success = insertData($query, "sssi", [$nev, $compiler_azonosito, $kep, $id]);
        
        
        if ($success === true) {
            echo json_encode([
                "success" => true,
                "message" => "A kategória sikeresen frissítve."
            ]);
        } else {
            http_response_code(500);
            echo json_encode([
                "success" => false,
                "message" => "Hiba történt a kategória frissítésekor."
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
