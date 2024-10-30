<!DOCTYPE html>
<html lang="hu">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Regisztráció</title>
        <link rel="stylesheet" href="./css/register.css">
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,100..900;1,100..900&display=swap" rel="stylesheet">
    </head>
<body>
<script type="module" src="./js/register.js"></script>
<div class="container">
    <form method="POST" id="registrationForm">
        <h1 class="title">Regisztráció</h1>
        <div class="inline-group">
            <label class="inline-text" class="inline-text">Felhasználónév</label>
            <input class="inline-input" type="text" name="username" id="username" title="" required>
        </div>
        <div class="inline-group">
            <label class="inline-text" class="inline-text">Email</label>
            <input class="inline-input" type="text" name="email" id="email" title="" required>
        </div>
        <div class="inline-group">
            <label class="inline-text" class="inline-text">Jelszó</label>
            <input class="inline-input" type="password" name="password" id="password" title="" required>
        </div>
        <div class="inline-group">
            <label class="inline-text" class="inline-text">Jelszó megerősítése</label>
            <input class="inline-input" type="password" name="password_confirm" id="password_confirm" title="" required>
        </div>
        <div class="inline-group">
            <button class="inline-button" type="submit" name="button_submit" title="" id="button_submit">Regisztráció</button>
        </div>
    </form>
</div>
</body>
<?php
    if($_SERVER["REQUEST_METHOD"] == "POST"){
        $username = $_POST["username"];
        $email = $_POST["email"];
        $password = $_POST["password"];
        $passwordConfirm = $_POST["password_confirm"];
        if(!empty($username) && !empty($email) && !empty($password) && !empty($passwordConfirm)) {
            if($password === $passwordConfirm) {
                
            }
            else {
                echo "A jelszók nem egyeznek!";
            }
        }
        else {
        }
    }
    else {
    }
?>
</html>