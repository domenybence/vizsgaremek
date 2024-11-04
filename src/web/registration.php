<!DOCTYPE html>
<html lang="hu">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Regisztráció</title>
        <link rel="stylesheet" href="./css/registration.css">
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
            <input class="inline-input" type="text" name="username" id="username" title="" minlength="4" maxlength="15">
        </div>
        <div class="inline-group">
            <label class="inline-text" class="inline-text">Email</label>
            <input class="inline-input" type="text" name="email" id="email" title="">
        </div>
        <div class="inline-group">
            <label class="inline-text" class="inline-text">Jelszó</label>
            <input class="inline-input" type="password" name="password" id="password" title="" minlength="8" maxlength="20">
        </div>
        <div class="inline-group">
            <label class="inline-text" class="inline-text">Jelszó megerősítése</label>
            <input class="inline-input" type="password" name="password_confirm" id="password_confirm" title="" minlength="8" maxlength="20"
        </div>
        <div class="inline-group">
            <button class="inline-button" type="submit" name="button_submit" title="" id="button_submit">Regisztráció</button>
        </div>
        <?php
        include_once "../php_functions/db_insert.php";
        include_once "../php_functions/db_getuser.php";

        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $username = htmlspecialchars(trim($_POST["username"]), ENT_QUOTES, 'UTF-8');
            $email = $_POST["email"];
            $password = $_POST["password"];
            $passwordConfirm = $_POST["password_confirm"];
            if (!empty($username) && !empty($email) && !empty($password) && !empty($passwordConfirm)) {
                $usernameRegex = "/^[a-zA-Z0-9]{4,15}$/";
                $emailRegex = "/^[\w\.\-]+@([\w\-]+\.)+[a-zA-Z]{2,20}$/";
                $passwordRegex = "/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d\s@$!%*?&]{8,20}$/";
                if(preg_match($usernameRegex, $username) && preg_match($emailRegex, $email) && preg_match($passwordRegex, $password) && $password === $passwordConfirm){
                    $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
                    $registrationQuery = "INSERT INTO `felhasznalo` (`nev`, `email`, `jelszo`) VALUES ('{$username}', '{$email}', '{$hashedPassword}');";
                    $getuser = "SELECT * FROM felhasznalo WHERE felhasznalo.nev LIKE '{$username}' OR felhasznalo.email LIKE '{$email}';";
                    if(!getUser($getuser)){
                        dataInsert($registrationQuery);
                        echo "<div class='registration-successful'>Sikeres regisztráció!</div>";
                    }
                    else {
                        echo "<div class='registration-failed'>Már használt felhasználónév vagy email!</div>";
                    }
                }
            }
        }
        ?>
        <div class="inline-group" id="inline-link-group">
            <p class="inline-text" id="login-text">Van már fiókod? <a href="./login.php" class="inline-link">Jelentkezz be.</a></p>
        </div>
    </form>
</div>
</body>
</html>