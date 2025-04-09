<?php
include_once "../php_functions/php_functions.php";
include '../php_functions/adatbazis_lekeres.php';

if (session_status() === PHP_SESSION_NONE) {
    startSession();
}

// This file is now kept for API reference but is no longer used directly
// All uploads are handled via upload_file.php using standard form submission

// Return an error if someone tries to use this endpoint
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    echo json_encode([
        'valasz' => 'Ez a végpont elavult, kérjük használja a formot a fájl feltöltéséhez.',
        'success' => false
    ], JSON_UNESCAPED_UNICODE);
    http_response_code(410); // Gone
    exit;
} else {
    echo json_encode([
        'valasz' => 'Hibás metódus!',
        'success' => false
    ], JSON_UNESCAPED_UNICODE);
    http_response_code(400); // Bad Request
    exit;
}
?>