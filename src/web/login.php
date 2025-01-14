<!DOCTYPE html>
<html lang="hu">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="A CodeOverflow bejelentkezési felülete.">
    <title>Bejelentkezés</title>
    <link rel="stylesheet" href="./css/login.css">
    <link rel="icon" type="image/x-icon" href="./icon.png">
    <?php include "loader.html"; ?>
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
                        <label for="rememberme">Bejelentkezve maradok</label>
                        <input type="checkbox" id="rememberme" name="rememberme">
                    </div>
                    <div class="inline-group">
                        <button class="inline-button" type="submit" name="button_submit" id="button_submit">Bejelentkezés</button>
                    </div>
                    
                    <?php
                    include "../php_functions/php_functions.php";
                    if ($_SERVER["REQUEST_METHOD"] == "POST") {
                        $username = $_POST["username"];
                        $password = $_POST["password"];
                        $rememberme = isset($_POST["rememberme"]);
                        if (!empty($username) && !empty($password)) {
                            $loginResult = login($username, $password, $rememberme);
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