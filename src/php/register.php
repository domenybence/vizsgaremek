<!DOCTYPE html>
<html lang="hu">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Regisztráció</title>
    <link rel="stylesheet" href="../css/register.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,100..900;1,100..900&display=swap" rel="stylesheet">
</head>
<body>
    <div class="header">
        <h1>Regisztráció</h1>
    </div>
    <div class="container">
        <form>
            <label class="inline-text" for="email" class="inline-text">Email</label><br>
            <input class="inline-input" type="email" name="email" id="email"><br>
            <label class="inline-text" for="password" class="inline-text">Jelszó</label><br>
            <input class="inline-input" type="password" name="password" id="password"><br>
            <label class="inline-text" for="password2" class="inline-text">Jelszó megerősítése</label><br>
            <input class="inline-input" type="password" name="password2" id="password2"><br>
            <button class="inline-button" type="submit">Regisztráció</button>
        </form>
    </div>
</body>
</html>