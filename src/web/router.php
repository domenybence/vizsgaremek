<?php
include_once "db_connect.php";
include_once "db_functions.php";

// Get codename from URL
$codename = isset($_GET['codename']) ? $_GET['codename'] : null;

if (!$codename) {
    http_response_code(404);
    echo "Code not found.";
    exit;
}

// Fetch code data from the database
$codeData = preparedGetData("SELECT * FROM codes WHERE codename = ?", "s", [$codename]);

if (!$codeData) {
    http_response_code(404);
    echo "Code not found.";
    exit;
}

// Display the code
header('Content-Type: text/plain');
echo $codeData['code_content'];
?>
