<?php
include_once "../php_functions/php_functions.php";

if (isset($_GET["codeid"])) {
    startSession();
    $codeid = explode("/", $_GET["codeid"])[0];
    
    $isStaff = isset($_SESSION["role"]) && ($_SESSION["role"] == "admin" || $_SESSION["role"] == "moderator");
    
    $query = $isStaff ? 
        "SELECT * FROM kod WHERE kod.id = ?;" :
        "SELECT * FROM kod WHERE kod.id = ? AND kod.jovahagyott = true;";
        
    if (preparedGetData($query, "i", [$codeid]) != false) {
        $currentUrl = $_SERVER["REQUEST_URI"];
        $redirectUrl = "/kod/$codeid";
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
else if(isset($_GET["request"])) {
    startSession();
    if(preparedGetData("SELECT * FROM felkeres WHERE felkeres.id = ?", "i", [$_GET["request"]]) != false) {
        $request = $_GET["request"];
        $currentUrl = $_SERVER["REQUEST_URI"];
        $redirectUrl = "/felkeresek/$request";
        if ($currentUrl != $redirectUrl) {
            header("Location: /felkeresek/$request");
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
    $redirectUrl = "/felkeresek";
    if ($currentUrl != $redirectUrl) {
        header("Location: /felkeresek");
        exit;
    }
    else {
        include "./browse_requests.php";
    }
}
else if(isset($_GET["upload_request"])) {
    $currentUrl = $_SERVER["REQUEST_URI"];
    $redirectUrl = "/felkeresek/feltoltes";
    if ($currentUrl != $redirectUrl) {
        header("Location: /felkeresek/feltoltes");
        exit;
    }
    else {
        include "./upload_request.php";
    }
}
else {
    startSession();
    http_response_code(404);
    include "./404.html";
}
?>