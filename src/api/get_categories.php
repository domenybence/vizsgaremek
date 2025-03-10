<?php
include_once "../php_functions/php_functions.php";
if(session_status() === PHP_SESSION_NONE) {
    startSession();
}

if($_SERVER["REQUEST_METHOD"] == "GET" && isset($_SERVER["HTTP_JAVASCRIPT_FETCH_REQUEST"]) && $_SERVER["HTTP_JAVASCRIPT_FETCH_REQUEST"] === "get-categories") {
    $categories = simpleGetData("SELECT id, nev FROM kategoria ORDER BY nev");
    
    if($categories) {
        echo json_encode([
            "success" => true,
            "categories" => $categories
        ]);
    } else {
        echo json_encode([
            "success" => false,
            "message" => "Nem sikerült betölteni a kategóriákat."
        ]);
    }
    exit;
}

echo json_encode([
    "success" => false,
    "message" => "Érvénytelen kérés."
]);
exit;
