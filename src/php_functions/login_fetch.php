<?php
include_once "./php_functions.php";
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_SERVER["HTTP_JAVASCRIPT_FETCH_REQUEST"]) && $_SERVER["HTTP_JAVASCRIPT_FETCH_REQUEST"] === "login-fetch-req") {
        $data = json_decode(file_get_contents("php://input"), true);
        $username = $data["username"];
        $password = $data["password"];
        $rememberme = isset($data["rememberme"]);
        if (!empty($username) && !empty($password)) {
            $loginResult = login($username, $password, $rememberme);
            if ($loginResult === true) {
                echo json_encode(["result" => "success"], JSON_UNESCAPED_UNICODE);
            }
            else {
                echo json_encode(["result" => "unsuccessful"], JSON_UNESCAPED_UNICODE);
            }
        } 
        else {
            echo json_encode(["result" => "unsuccessful"], JSON_UNESCAPED_UNICODE);
        }
    }
}