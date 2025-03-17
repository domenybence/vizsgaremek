<?php
include_once "../php_functions/php_functions.php";
include_once "../php_functions/get.php";

if(session_status() === PHP_SESSION_NONE) {
    startSession();
}

if(($_SERVER["REQUEST_METHOD"] == "GET" && isset($_SERVER["HTTP_JAVASCRIPT_FETCH_REQUEST"]) && 
   $_SERVER["HTTP_JAVASCRIPT_FETCH_REQUEST"] === "get-users") || 
   ($_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET["page"]))) {
    
    if(!isset($_SESSION["role"]) || $_SESSION["role"] !== "admin") {
        http_response_code(403);
        echo json_encode(["success" => false, "message" => "Unauthorized access"]);
        exit();
    }
    
    // Ensure we have proper integer values for pagination
    $page = isset($_GET["page"]) ? intval($_GET["page"]) : 1;
    $limit = isset($_GET["limit"]) ? intval($_GET["limit"]) : 10;
    
    // Handle edge cases
    if ($page < 1) $page = 1;
    if ($limit < 1) $limit = 10;
    
    $offset = ($page - 1) * $limit;
    $search = isset($_GET["search"]) ? $_GET["search"] : "";
    
    try {
        // Count total users for pagination
        if (!empty($search)) {
            $searchTerm = "%$search%";
            $countQuery = "SELECT COUNT(*) as total FROM felhasznalo WHERE nev LIKE ? OR email LIKE ?";
            $countResult = preparedGetData($countQuery, "ss", [$searchTerm, $searchTerm]);
        } else {
            $countQuery = "SELECT COUNT(*) as total FROM felhasznalo";
            $countResult = preparedGetData($countQuery, "", []);
        }
        
        // Extract total count
        $totalCount = 0;
        if ($countResult && is_array($countResult) && isset($countResult[0]["total"])) {
            $totalCount = (int)$countResult[0]["total"];
        }
        
        // Get users with pagination
        if (!empty($search)) {
            $searchTerm = "%$search%";
            $query = "SELECT id, nev as username, email, tipus as role, pontok as points, 
                      DATE_FORMAT(letrehozasi_ido, '%Y-%m-%d') as registration_date 
                      FROM felhasznalo 
                      WHERE nev LIKE ? OR email LIKE ? 
                      ORDER BY id LIMIT ? OFFSET ?";
            $users = preparedGetData($query, "ssii", [$searchTerm, $searchTerm, $limit, $offset]);
        } else {
            $query = "SELECT id, nev as username, email, tipus as role, pontok as points, 
                      DATE_FORMAT(letrehozasi_ido, '%Y-%m-%d') as registration_date 
                      FROM felhasznalo ORDER BY id LIMIT ? OFFSET ?";
            $users = preparedGetData($query, "ii", [$limit, $offset]);
        }
        
        // Ensure we have a valid array
        if (!is_array($users)) {
            $users = [];
        }
        
        // Format user data
        $formattedUsers = [];
        foreach ($users as $user) {
            $roleType = (int)($user["role"] ?? 0);
            
            $roleText = "user";
            if ($roleType === 2) $roleText = "admin";
            else if ($roleType === 1) $roleText = "moderator";
            
            $formattedUsers[] = [
                "id" => $user["id"],
                "username" => $user["username"],
                "email" => $user["email"],
                "role" => $roleText,
                "points" => (int)($user["points"] ?? 0),
                "registrationDate" => $user["registration_date"]
            ];
        }
        
        // Calculate pagination values
        $totalPages = max(1, ceil($totalCount / $limit));
        
        // Return data with explicit integer values for pagination
        echo json_encode([
            "success" => true,
            "users" => $formattedUsers,
            "pagination" => [
                "currentPage" => (int)$page,
                "totalPages" => (int)$totalPages,
                "totalCount" => (int)$totalCount,
                "limit" => (int)$limit
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