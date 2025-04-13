<?php
include_once "../php_functions/php_functions.php";
include_once "../php_functions/get.php";

if (session_status() === PHP_SESSION_NONE) {
    startSession();
}

if (($_SERVER["REQUEST_METHOD"] == "GET" && isset($_SERVER["HTTP_JAVASCRIPT_FETCH_REQUEST"]) &&
        $_SERVER["HTTP_JAVASCRIPT_FETCH_REQUEST"] === "get-users") ||
    ($_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET["search"]))
) {

    if (!isset($_SESSION["role"]) || $_SESSION["role"] !== "admin") {
        http_response_code(403);
        echo json_encode(["success" => false, "message" => "Unauthorized access"]);
        exit();
    }

    $search = isset($_GET["search"]) ? $_GET["search"] : "";

    try {
        if (!empty($search)) {
            $searchTerm = "%$search%";
            $query = "SELECT id, nev as username, email, tipus as role, pontok as points, 
                      DATE_FORMAT(letrehozasi_ido, '%Y-%m-%d') as registration_date 
                      FROM felhasznalo 
                      WHERE nev LIKE ? OR email LIKE ? 
                      ORDER BY id";
            $users = preparedGetData($query, "ss", [$searchTerm, $searchTerm]);
        } else {
            $query = "SELECT id, nev as username, email, tipus as role, pontok as points, 
                      DATE_FORMAT(letrehozasi_ido, '%Y-%m-%d') as registration_date 
                      FROM felhasznalo ORDER BY id";
            $users = simpleGetData($query);
        }

        if (!is_array($users)) {
            $users = [];
        }

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

        echo json_encode([
            "success" => true,
            "users" => $formattedUsers
        ]);
    } catch (Exception $e) {
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
