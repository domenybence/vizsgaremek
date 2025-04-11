<?php
include_once "../php_functions/php_functions.php";
include_once "../php_functions/get.php";

if(session_status() === PHP_SESSION_NONE) {
    startSession();
}


$data = json_decode(file_get_contents("php://input"), true);

if(isset($data["id"])) {
    
    $data = json_decode(file_get_contents("php://input"), true);
    $userId = (int)$data["id"];
    
    try {
        $query = "SELECT id, nev as username, email, tipus as role, pontok as points
                  FROM felhasznalo WHERE id = ?";
        $user = preparedGetData($query, "i", [$userId]);
        
        if (!$user || !is_array($user)) {
            http_response_code(404);
            echo json_encode([
                "success" => false,
                "message" => "User not found"
            ]);
            exit();
        }
        
        $user = $user[0];
        $roleType = (int)($user["role"] ?? 0);
        
        $roleText = "user";
        if ($roleType === 2) $roleText = "admin";
        else if ($roleType === 1) $roleText = "moderator";
        
        echo json_encode([
            "success" => true,
            "user" => [
                "id" => $user["id"],
                "username" => $user["username"],
                "email" => $user["email"],
                "role" => $roleText,
                "points" => (int)($user["points"] ?? 0)
            ]
        ]);
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