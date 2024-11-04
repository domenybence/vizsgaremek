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
        <link rel="icon" type="image/x-icon" href="./icon.png">
    </head>
<body>
<script type="module" src="./js/registration.js"></script>
<div class="container" id="container">
    <form method="POST" id="registrationForm">
        <h1 class="title">Regisztráció</h1>
        <div class="inline-group">
            <label class="inline-text" class="inline-text">Felhasználónév</label>
            <input class="inline-input" type="text" name="username" id="username" title="">
        </div>
        <div class="inline-group">
            <label class="inline-text" class="inline-text">Email</label>
            <input class="inline-input" type="text" name="email" id="email" title="">
        </div>
        <div class="inline-group">
            <label class="inline-text" class="inline-text">Jelszó</label>
            <input class="inline-input" type="password" name="password" id="password" title="">
        </div>
        <div class="inline-group">
            <label class="inline-text" class="inline-text">Jelszó megerősítése</label>
            <input class="inline-input" type="password" name="password_confirm" id="password_confirm" title="">
        </div>
        <div class="inline-group">
            <button class="inline-button" type="submit" name="button_submit" title="" id="button_submit">Regisztráció</button>
        </div>
        <?php
        include_once "../php_functions/db_insert.php";
        include_once "../php_functions/db_getuser.php";

        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $username = $_POST["username"];
            $email = $_POST["email"];
            $password = $_POST["password"];
            $passwordConfirm = $_POST["password_confirm"];
            if (!empty($username) && !empty($email) && !empty($password) && !empty($passwordConfirm)) {
                $usernameRegex = "/^[a-zA-Z0-9]{4,15}$/";
                $emailRegex = "/^[\w\.\-]+@([\w\-]+\.)+[a-zA-Z]{2,}$/";
                $passwordRegex = "/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d\s@$!%*?&]{8,}$/";
                if(preg_match($usernameRegex, $username) && preg_match($emailRegex, $email) && preg_match($passwordRegex, $password) && $password === $passwordConfirm){
                    $passwordHash = password_hash($password, PASSWORD_DEFAULT);
                    $registrationQuery = "INSERT INTO `felhasznalo` (`nev`, `email`, `jelszo`) VALUES ('{$username}', '{$email}', '{$passwordHash}');";
                    $getuser = "SELECT * FROM felhasznalo WHERE felhasznalo.nev LIKE '{$username}' OR felhasznalo.email LIKE '{$email}';";
                    if(!getUser($getuser)){
                        dataInsert($registrationQuery);
                        echo "<div class='registration-response'>Sikeres regisztráció!</div>";
                    }
                    else {
                        echo "<div class='registration-response'>Már használt felhasználónév vagy email!</div>";
                    }
                }
            }
        }
        ?>
        <div class="inline-group" id="inline-link-group">
            <p class="inline-text" id="login-text">Van már fiókod? <a href="#" class="inline-link">Jelentkezz be.</a></p>
        </div>
    </form>
</div>
</body>
</html>