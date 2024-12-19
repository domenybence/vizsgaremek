<?php
include_once "../php_functions/php_functions.php";

// Get codename from URL
$codename = isset($_GET['codename']) ? $_GET['codename'] : null;

if (!$codename) {
    http_response_code(404);
    echo "Code not found.";
    exit;
}

$codeData = preparedGetData("SELECT * FROM kod WHERE kod.nev = ?;", "s", [$codename]);

if (!$codeData) {
    http_response_code(404);
    echo "Code not found.";
    exit;
}

var_dump($codeData);