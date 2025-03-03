<?php
include_once "../php_functions/php_functions.php";

if (isset($_GET["codeid"])) {
    startSession();
    $codeid = explode("/", $_GET["codeid"])[0];
    if (preparedGetData("SELECT * FROM kod WHERE kod.id = ? AND kod.jovahagyott = true;", "i", [$codeid]) != false) {
        $currentUrl = $_SERVER["REQUEST_URI"];
        $redirectUrl = "/vizsgaremek/kod/$codeid";
        if (str_ends_with($currentUrl, "/fetch")) {
            if ($currentUrl != $redirectUrl) {
                header("Location: $redirectUrl");
            }
        }
        if ($currentUrl != $redirectUrl) {
            header("Location: $redirectUrl");
            exit;
        }
        else {
            include "./code.php";
        }
    }
    else {
        http_response_code(404);
        include "./404.html";
    }
}
else if(isset($_GET["codeid"]) && isset($_GET["codecategory"])) {
    startSession();
    $codeid = explode("/", $_GET["codeid"])[0];
    $codeCategory = $_GET["codecategory"];
    if(preparedGetData("SELECT * FROM kod INNER JOIN kategoria ON kod.kategoria_id = kategoria.id WHERE kod.id = ? AND kategoria.compiler_azonosito = ? AND kod.jovahagyott = true;", "is", [$codeId, $codeCategory]) != false) {
        $codeCategory = $_GET["codecategory"];
        $currentUrl = $_SERVER["REQUEST_URI"];
        $redirectUrl = "/vizsgaremek/kategoria/$codeCategory/$codeId";
        if ($currentUrl != $redirectUrl) {
            header("Location: /vizsgaremek/kategoria/$codeCategory/$codeId");
            exit;
        }
        echo "Kategoria: " . $codeCategory;
        echo "<br>Kodid: " . $codeId;
    }
    else {
        http_response_code(404);
        include "./404.html";
    }
}
else if(isset($_GET["codecategory"]) ) {
    startSession();
    if(preparedGetData("SELECT * FROM kategoria WHERE kategoria.compiler_azonosito = ?;", "s", [$_GET["codecategory"]]) != false) {
        $codeCategory = $_GET["codecategory"];
        $currentUrl = $_SERVER["REQUEST_URI"];
        $redirectUrl = "/vizsgaremek/kategoria/$codeCategory";
        if ($currentUrl != $redirectUrl) {
            header("Location: /vizsgaremek/kategoria/$codeCategory");
            exit;
        }
        echo $codeCategory;
        echo "\nkategoria";
    }
    else {
        http_response_code(404);
        include "./404.html";
    }
}
else if(isset($_GET["username"])) {
    startSession();
    if(preparedGetData("SELECT * FROM felhasznalo WHERE felhasznalo.nev = ?", "s", [$_GET["username"]]) != false) {
        $username = $_GET["username"];
        $currentUrl = $_SERVER["REQUEST_URI"];
        $redirectUrl = "/vizsgaremek/felhasznalo/$username";
        if ($currentUrl != $redirectUrl) {
            header("Location: /vizsgaremek/felhasznalo/$username");
            exit;
        }
    }
    else {
        http_response_code(404);
        include "./404.html";
    }
}
else if(isset($_GET["request"])) {
    startSession();
    if(preparedGetData("SELECT * FROM felkeres WHERE felkeres.id = ?", "i", [$_GET["request"]]) != false) {
        $request = $_GET["request"];
        $currentUrl = $_SERVER["REQUEST_URI"];
        $redirectUrl = "/vizsgaremek/felkeres/$request";
        if ($currentUrl != $redirectUrl) {
            header("Location: /vizsgaremek/felkeres/$request");
            exit;
        }
        else {
            include "./requests.php";
        }
    }
    else {
        http_response_code(404);
        include "./404.html";
    }
}
else if(isset($_GET["requests"])) {
    $currentUrl = $_SERVER["REQUEST_URI"];
    $redirectUrl = "/vizsgaremek/felkeresek";
    if ($currentUrl != $redirectUrl) {
        header("Location: /vizsgaremek/felkeresek");
        exit;
    }
    else {
        include "./browse_requests.php";
    }
}
else {
    startSession();
    http_response_code(404);
    include "./404.html";
}