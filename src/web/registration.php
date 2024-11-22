<?php
include_once "../php_functions/db_functions.php";
session_destroy();
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
                            <button class="inline-button" type="submit" name="button_submit" title="" id="button_submit">Regisztráció</button>
                        </div>
                        <?php
                    if ($_SERVER["REQUEST_METHOD"] == "POST") {
                        $username= filter_input(INPUT_POST,'username',FILTER_SANITIZE_SPECIAL_CHARS);
                        $email = filter_var(trim($_POST["email"]), FILTER_VALIDATE_EMAIL);
                        $password = $_POST["password"];
                        $passwordConfirm = $_POST["password_confirm"];
                        $policyCheckbox = $_POST["policy-checkbox"];
                        $usernameRegex = "/^[a-zA-Z0-9]{4,15}$/";
                        $passwordRegex = "/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d\s@$!%*?&]{8,20}$/";
                        if ($username && $email && preg_match($usernameRegex, $username) && preg_match($passwordRegex, $password) && $password === $passwordConfirm && isset($policyCheckbox)) {
                            if(isset($_POST['g-recaptcha-response'])) {
                                $captcha = $_POST['g-recaptcha-response'];
                                $secretKey = "6LdsP3kqAAAAADt-AI6ixXN1XQG5OZ9eUkdzfKid";
                                $response = file_get_contents("https://www.google.com/recaptcha/api/siteverify?secret={$secretKey}&response={$captcha}&remoteip=" . $_SERVER['REMOTE_ADDR']);
                                $g_response = json_decode($response);
                                if ($g_response->success === true) {
                                    $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
                                    $result = registration($username, $email, $hashedPassword);
                                    echo $result;
                                }
                                else {
                                    echo "<div class='inline-error captcha-error'>A reCAPTCHA ellenőrzés sikertelen volt!</div>";
                                }
                            }
                            else {
                                echo "<div class='inline-error captcha-error'>Kérjük végezze el a reCAPTCHA ellenőrzést!</div>";
                            }
                        }
                    }
                    ?>
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