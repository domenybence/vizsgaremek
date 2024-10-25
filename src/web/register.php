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
        <form>
            <h1 class="title">Regisztráció</h1>
            <div class="inline-container">
                <label class="inline-text" class="inline-text">Felhasználónév</label>
                <input class="inline-input" type="text" name="username">
                <label class="inline-text" class="inline-text">Email</label>
                <input class="inline-input" type="email" name="email">
                <label class="inline-text" class="inline-text">Jelszó</label>
                <input class="inline-input" type="password" name="password">
                <label class="inline-text" class="inline-text">Jelszó megerősítése</label>
                <input class="inline-input" type="password" name="password2">
                <button class="inline-button" type="submit">Regisztráció</button>
            </div>
        </form>
    </div>
</body>
</html>