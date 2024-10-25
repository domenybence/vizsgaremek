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
        <form method="post">
            <label for="email" class="inline-text">Email</label>
            <input type="email" name="email" id="email">
            <label for="password" class="inline-text">Jelszó</label>
            <input type="password" name="password" id="password">
            <label for="password2" class="inline-text">Jelszó megerősítése</label>
            <input type="password" name="password2" id="password2">
            <button type="submit">Regisztráció</button>
        </form>
    </div>
</body>
</html>