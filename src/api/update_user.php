<?php
include_once "../php_functions/php_functions.php";
include_once "../php_functions/get.php";
include_once "../php_functions/insert.php";

if(session_status() === PHP_SESSION_NONE) {
    startSession();
}

if($_SERVER["REQUEST_METHOD"] == "POST" && isset($_SERVER["HTTP_JAVASCRIPT_FETCH_REQUEST"]) && 
   $_SERVER["HTTP_JAVASCRIPT_FETCH_REQUEST"] === "update-user") {
    
    if(!isset($_SESSION["role"]) || $_SESSION["role"] !== "admin") {
        http_response_code(403);
        echo json_encode(["success" => false, "message" => "Unauthorized access"]);
        exit();
    }
    
    $data = json_decode(file_get_contents("php://input"), true);
    
    if (!isset($data["id"]) || !isset($data["username"]) || !isset($data["email"]) || 
        !isset($data["role"]) || !isset($data["points"])) {
        http_response_code(400);
        echo json_encode(["success" => false, "message" => "Missing required fields"]);
        exit();
    }
    
    $id = (int)$data["id"];
    $username = $data["username"];
    $email = $data["email"];
    $role = $data["role"];
    $points = (int)$data["points"];
    $password = $data["password"];
    
    $roleValue = 0;
    if ($role === "admin") $roleValue = 2;
    else if ($role === "moderator") $roleValue = 1;
    
    try {
        $checkQuery = "SELECT id FROM felhasznalo WHERE (nev = ? OR email = ?) AND id != ?";
        $existingUser = preparedGetData($checkQuery, "ssi", [$username, $email, $id]);
        
        if ($existingUser && is_array($existingUser)) {
            http_response_code(409);
            echo json_encode([
                "success" => false,
                "message" => "A felhasználónév vagy email cím már foglalt."
            ]);
            exit();
        }
        
        if ($password) {
            $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
            $query = "UPDATE felhasznalo SET nev = ?, email = ?, tipus = ?, pontok = ?, jelszo = ? WHERE id = ?";
            $success = insertData($query, "ssiiis", [$username, $email, $roleValue, $points, $hashedPassword, $id]);
        } else {
            $query = "UPDATE felhasznalo SET nev = ?, email = ?, tipus = ?, pontok = ? WHERE id = ?";
            $success = insertData($query, "ssiii", [$username, $email, $roleValue, $points, $id]);
        }
        
        if ($success === true) {
            echo json_encode([
                "success" => true,
                "message" => "A felhasználó sikeresen frissítve."
            ]);
        } else {
            http_response_code(500);
            echo json_encode([
                "success" => false,
                "message" => "Hiba történt a felhasználó frissítésekor."
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
