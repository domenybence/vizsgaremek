<!DOCTYPE html>
<html lang="hu">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CodeOverflow</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    
</head>
<body class="bg-dark" style="color: white">
    <nav class="navbar navbar-expand-lg  bg-dark border-bottom border-body" data-bs-theme="dark">
        <div class="container-fluid">
          <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarTogglerDemo03" aria-controls="navbarTogglerDemo03" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
          </button>
          <a class="navbar-brand" href="#">CodeOverflow</a>
          <div class="collapse navbar-collapse" id="navbarTogglerDemo03">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
              <li class="nav-item">
                <a class="nav-link" aria-current="page" href="#">Szoftverek</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="#">Kérések</a>
              </li>
              <li class="nav-item">
                <a class="nav-link">Könyvtár</a>
              </li>
            </ul>
            <form class="d-flex" role="search">
              <input class="form-control me-2" type="search" placeholder="Keresés" aria-label="Search">
              <button class="btn btn-outline-primary" type="submit">Keresés</button>
            </form>
          </div>
        </div>
      </nav>

      <div class="row">

        <div class="col col-1">

          <div class="d-flex flex-column flex-shrink-0 p-3 text-white bg-dark" style="height: 100vh;">
            <a href="#" class="d-flex align-items-center text-white text-decoration-none">
              <svg class="bi me-2" height="32"><use xlink:href="#bootstrap"></use></svg>
              <span class="fs-4">Kategóriák</span>
              
            </a>
            <hr>
            <ul class="nav nav-pills flex-column mb-auto">
              <li class="nav-item">
                <a href="#" class="nav-link text-white" aria-current="page">
                  <svg class="bi me-2" height="16"><use xlink:href="#home"></use></svg>
                  HTML
                </a>
              </li>
              <li>
                <a href="#" class="nav-link text-white">
                  <svg class="bi me-2" height="16"><use xlink:href="#speedometer2"></use></svg>
                  CSS
                </a>
              </li>
              <li>
                <a href="#" class="nav-link text-white">
                  <svg class="bi me-2" height="16"><use xlink:href="#table"></use></svg>
                  JS
                </a>
              </li>
              <li>
                <a href="#" class="nav-link text-white">
                  <svg class="bi me-2" height="16"><use xlink:href="#grid"></use></svg>
                  PHP
                </a>
              </li>
              <li>
                <a href="#" class="nav-link text-white">
                  <svg class="bi me-2" height="16"><use xlink:href="#people-circle"></use></svg>
                  Egyéb
                </a>
              </li>
            </ul>
            <hr>
            <div class="dropdown">
              <a href="#" class="d-flex align-items-center text-white text-decoration-none dropdown-toggle" id="dropdownUser1" data-bs-toggle="dropdown" aria-expanded="false">
                <img src="https://github.com/mdo.png" alt="" height="32" class="rounded-circle me-2">
                <strong>mdo</strong>
              </a>
              <ul class="dropdown-menu dropdown-menu-dark text-small shadow" aria-labelledby="dropdownUser1">
                <li><a class="dropdown-item" href="#">Beállítások</a></li>
                <li><a class="dropdown-item" href="#">Profil</a></li>
                <li><hr class="dropdown-divider"></li>
                <li><a class="dropdown-item" href="#">Kijelentkezés</a></li>
              </ul>
            </div>
          </div>

        </div>
        
        <div class="col col-1">

        <div class="vr" style="height:100vh"></div>
        
        </div>

        <div class="col col-10">

        a

        </div>

      </div>




      <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
</html>