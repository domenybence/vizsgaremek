<!DOCTYPE html>
<html lang="hu">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bejelentkezés</title>
    <link rel="stylesheet" href="./css/login.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,100..900;1,100..900&display=swap" rel="stylesheet">
    <link rel="icon" type="image/x-icon" href="./icon.png">
</head>
<body>
<script type="module" src="./js/login.js"></script>
    <div class="container" id="container">
        <form method="POST" id="loginForm">
            <h1 class="title">Bejelentkezés</h1>
            <div class="inline-group">
                <label class="inline-text" class="inline-text">Felhasználónév</label>
                <input class="inline-input" type="text" name="username" id="username" title="" minlength="4" maxlength="15">
            </div>
            <div class="inline-group">
                <label class="inline-text" class="inline-text">Jelszó</label>
                <input class="inline-input" type="password" name="password" id="password" title="">
            </div>
            <div class="inline-group">
                <button class="inline-button" type="submit" name="button_submit" title="" id="button_submit">Bejelentkezés</button>
            </div>
        </form>
    </div>
</body>
</html>