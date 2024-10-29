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
<div class="container">
    <form method="POST" id="registrationForm">
        <h1 class="title">Regisztráció</h1>
        <div class="inline-group">
            <label class="inline-text" class="inline-text">Felhasználónév</label>
            <input class="inline-input" type="text" name="username" id="username" required>
        </div>
        <div class="inline-group">
            <label class="inline-text" class="inline-text">Email</label>
            <input class="inline-input" type="text" name="email" id="email" required>
        </div>
        <div class="inline-group">
            <label class="inline-text" class="inline-text">Jelszó</label>
            <input class="inline-input" type="password" name="password" id="password" required>
        </div>
        <div class="inline-group">
            <label class="inline-text" class="inline-text">Jelszó megerősítése</label>
            <input class="inline-input" type="password" name="password_confirm" id="password_confirm" required>
        </div>
        <div class="inline-group">
            <button class="inline-button" type="submit" name="submit_button" id="submit_button">Regisztráció</button>
        </div>
    </form>
    
</div>
<script type="module" src="./js/register.js"></script>
</body>
</html>
