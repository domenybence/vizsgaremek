<?php
include_once "../php_functions/php_functions.php";
if(isset($_SESSION)){
    session_destroy();
}
?>

<!DOCTYPE html>
<html lang="hu">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="A CodeOverflow regisztrációs felülete.">
    <title>Regisztráció</title>
    <link rel="stylesheet" href="./css/registration.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,100..900;1,100..900&display=swap" rel="stylesheet">
    <link rel="icon" type="image/x-icon" href="./icon.png">
    <script src="https://www.google.com/recaptcha/api.js?hl=hu" async defer></script>
    <script type="module" src="./js/registration.js" defer></script>
    <?php include "loader.html"; ?>
</head>
<body>
    <div class="background"></div>
    <div class="container" id="container">
        <div class="wrapper">
            <div class="column1">
                <div class="registration-page-wrapper">
                    <form method="POST" id="registrationForm">
                        <h1 class="title">Regisztráció</h1>
                        <div class="inline-group">
                            <label for="username" class="inline-text">Felhasználónév</label>
                            <input class="inline-input" type="text" name="username" id="username" title="" value="">
                        </div>
                        <div class="inline-group">
                            <label for="email" class="inline-text">Email</label>
                            <input class="inline-input" type="text" name="email" id="email" title="" value="">
                        </div>
                        <div class="inline-group">
                            <label for="password" class="inline-text">Jelszó</label>
                            <input class="inline-input" type="password" name="password" id="password" title="" value="">
                        </div>
                        <div class="inline-group">
                            <label for="password_confirm" class="inline-text">Jelszó megerősítése</label>
                            <input class="inline-input" type="password" name="password_confirm" id="password_confirm" title="" value="">
                        </div>
                        <div class="inline-group">
                            <input type="checkbox" name="policy-checkbox" id="policy-checkbox"/>
                            <label class="inline-text inline-checkbox-text" id="policy-label">A regisztrációmmal elfogadom a weboldal <a href="#" class="inline-link">adatvédelmi nyilatkozatát.</a></label>
                        </div>
                        <div class="checkbox-group"></div>
                        <div class="captcha-container">
                            <div class="g-recaptcha" id="captcha" data-sitekey="6LdsP3kqAAAAAB_5T7GZTTTQfiWLUs68G_KTta2a"></div>
                        </div>
                        <div class="inline-group">
                            <button class="inline-button" type="button" name="button_submit" title="" id="button_submit">Regisztráció</button>
                        </div>
                    <p class="inline-text" id="login-text">Van már fiókja? <a href="./login.php" class="inline-link">Jelentkezzen be itt.</a></p>
                    </form>
                </div>
            </div>
            <div class="column2">
                <div class="image-container">
                    <div class="image-wrapper"></div>
                </div>
            </div>
        </div>
    </div>
</body>

</html>