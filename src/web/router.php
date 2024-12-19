<?php
include_once "../php_functions/php_functions.php";

// Get codename from URL
$codename = isset($_GET['codename']) ? $_GET['codename'] : null;
$codeCategory = isset($_GET['codecategory']) ? $_GET['codecategory'] : null;
if (!$codename) {
    http_response_code(404);
    echo "Code not found.";
    exit;
}

$codeData = preparedGetData("SELECT * FROM kod INNER JOIN kategoria ON kod.kategoria_id = kategoria.id WHERE kod.nev = ? AND kategoria.nev = ?;", "ss", [$codename, $codeCategory]);

if (!$codeData) {
    http_response_code(404);
    echo "Code not found.";
    exit;
}

var_dump($codeData);