<?php

include_once "php_functions.php";
if($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_SERVER["HTTP_JAVASCRIPT_FETCH_REQUEST"]) && $_SERVER["HTTP_JAVASCRIPT_FETCH_REQUEST"] === "fetch-req") {
        $data = json_decode(file_get_contents("php://input"), true);
        $username = $data["username"];
        $email = $data["email"];
        $password = $data["password"];
        $captcha = $data["captcha"];
        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
        $isValid = true;
        if (empty($username) || !preg_match("/^[a-zA-Z0-9]{4,20}$/", $username)) {
            $isValid = false;    
        }
        if (empty($email) || !filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $isValid = false;
        }
        if (empty($password) || !preg_match("/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]{8,}$/", $password)) {
            $isValid = false;
        }
        if (empty($captcha)) {
            $isValid = false;
        }
        else {
            $key = "6LdsP3kqAAAAADt-AI6ixXN1XQG5OZ9eUkdzfKid";
            $verifyResponse = file_get_contents("https://www.google.com/recaptcha/api/siteverify?secret=" . urlencode($key) . "&response=" . urlencode($captcha));
            $captchaResponse = json_decode($verifyResponse, true);
            if (!$captchaResponse["success"]) {
                $isValid = false;
            }
        }
        if($isValid) {
            registration($username, $email, $hashedPassword);
        }
        else {
            echo json_encode(["result" => "error"], JSON_UNESCAPED_UNICODE);
        }
    }
}
function registration($username, $email, $hashedPassword) {
    try {
        insertData("INSERT INTO felhasznalo (nev, email, jelszo, letrehozasi_ido, utolso_valt_ido) VALUES (?, ?, ?, current_timestamp(), current_timestamp());", "sss", [$username, $email, $hashedPassword]);
        http_response_code(200);
        echo json_encode(["result" => "success"], JSON_UNESCAPED_UNICODE);
    }
    catch (Exception $e) {
        $errorMessage = $e->getMessage();
        if (strpos($errorMessage, "nev") !== false) {
            http_response_code(409);
            echo json_encode(["result" => "taken-username"], JSON_UNESCAPED_UNICODE);
        }
        else if (strpos($errorMessage, "email") !== false) {
            http_response_code(409);
            echo json_encode(["result" => "taken-email"], JSON_UNESCAPED_UNICODE);
        }
    }
}