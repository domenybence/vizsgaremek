
<!DOCTYPE html>
<html lang="hu">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Feltöltés - CodeOverflow</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="css/upload.css">
    <link rel="icon" type="image/x-icon" href="./icon.png">
</head>
<body class="bg-dark text-light">
    
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark border-bottom">
        <div class="container">
            <a class="navbar-brand" href="home.html">CodeOverflow</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav me-auto">
                    <li class="nav-item"><a class="nav-link" href="home.html">Főoldal</a></li>
                    <li class="nav-item"><a class="nav-link" href="#">Szoftverek</a></li>
                    <li class="nav-item"><a class="nav-link" href="#">Kapcsolat</a></li>
                </ul>
                <div class="dropdown">
                    <a href="#" class="d-flex align-items-center text-white text-decoration-none dropdown-toggle" data-bs-toggle="dropdown">
                        <img src="https://github.com/mdo.png" alt="Profile" width="32" height="32" class="rounded-circle me-2">
                        <strong>Profil</strong>
                    </a>
                    <ul class="dropdown-menu dropdown-menu-dark">
                        <li><a class="dropdown-item" href="#">Beállítások</a></li>
                        <li><a class="dropdown-item" href="#">Profil</a></li>
                        <li><hr class="dropdown-divider"></li>
                        <li><a class="dropdown-item" href="#">Kijelentkezés</a></li>
                    </ul>
                </div>
            </div>
        </div>
    </nav>

    <div class="container mt-4">
        <div class="row justify-content-center">
            <div class="col-lg-6 col-md-8 col-sm-12">
                <div class="card bg-light text-dark shadow-lg p-4">
                    <h2 class="text-center mb-4">Szoftver Feltöltése</h2>
                    <form enctype="multipart/form-data" action="upload_file.php" method="POST">
                        <div class="mb-3">
                            <label for="softwareName" class="form-label">Szoftver Neve</label>
                            <input type="text" class="form-control" id="nevInput" name="softwareName" required>
                        </div>
                        <div class="mb-3">
                            <label for="softwarePrice" class="form-label">Szoftver Ára</label>
                            <input type="number" class="form-control" id="arInput" name="softwarePrice" required>
                        </div>
                        <div class="mb-3">
                            <label for="category" class="form-label">Kategória</label>
                            <select class="form-select" id="katInput" name="category" required>
                                <option value="1">HTML</option>
                                <option value="2">CSS</option>
                                <option value="3">JavaScript</option>
                                <option value="4">PHP</option>
                                <option value="5">C#</option>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="fileToUpload" class="form-label">Fájl Feltöltése</label>
                            <input class="form-control" type="file" id="fileToUpload" name="fileToUpload" required>
                        </div>
                        <button type="submit" id="uploadBtn" class="btn btn-primary w-100">Feltöltés</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="js/upload.js"></script>
</body>
</html>