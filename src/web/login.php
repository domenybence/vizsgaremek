<!DOCTYPE html>
<html lang="hu">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="A CodeOverflow bejelentkező felülete.">
    <title>Bejelentkezés</title>
    <link rel="stylesheet" href="./css/login.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,100..900;1,100..900&display=swap" rel="stylesheet">
    <link rel="icon" type="image/x-icon" href="./icon.png">
    <script type="module" src="./js/login.js" defer></script>
</head>
<body>
    <div class="background"></div>
    <div class="container" id="container">
        <div class="wrapper">
        <div class="column1"></div>
            <div class="column2">
            <form method="POST" id="loginForm">
                <h1 class="title">Bejelentkezés</h1>
                <div class="inline-group">
                    <label class="inline-text">Felhasználónév</label>
                    <input class="inline-input" type="text" name="username" id="username" minlength="4" maxlength="15">
                </div>
                <div class="inline-group">
                    <label class="inline-text">Jelszó</label>
                    <input class="inline-input" type="password" name="password" id="password">
                </div>
                <div class="inline-group">
                    <input type="checkbox" name="rememberme">
                </div>
                <div class="inline-group">
                    <button class="inline-button" type="submit" name="button_submit" id="button_submit">Bejelentkezés</button>
                </div>
                
                <?php
                include "../php_functions/db_functions.php";
                if ($_SERVER["REQUEST_METHOD"] === "POST") {
                    $username = $_POST["username"];
                    $password = $_POST["password"];
                    $remember = $_POST["rememberme"];
                    if (!empty($username) && !empty($password)) {
                        $loginResult = login($username, $password, $remember);
                        if ($loginResult === true) {
                            header("Location: dashboard.php");
                            exit();
                        }
                        else {
                            echo $loginResult;
                        }
                    } 
                    else {
                        echo "<div class='inline-error'>Kérjük töltse ki mindkét mezőt!</div>";
                    }
                }
                ?>
                <p class="inline-text register-text">Még nincs fiókja? <a href="./registration.php" class="inline-link">Regisztráljon itt.</a></p>
            </form>
            </div>
        </div>
        </div>
    </div>
</body>
</html>