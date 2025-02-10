
<!DOCTYPE html>
<html lang="hu">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Szoftverfeltöltés</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
  <link rel="stylesheet" href="css/upload.css">
  <link rel="icon" type="image/x-icon" href="./icon.png">
</head>

<body>

  <body class="bg-dark" style="color: white">
    <nav class="navbar navbar-expand-lg  bg-dark border-bottom border-body" data-bs-theme="dark">
      <div class="container-fluid">
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarTogglerDemo03"
          aria-controls="navbarTogglerDemo03" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
        <a class="navbar-brand" href="home.html">CodeOverflow</a>
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


          <div class="dropdown mx-5">
            <a href="#" class="d-flex align-items-center text-white text-decoration-none dropdown-toggle"
              id="dropdownUser1" data-bs-toggle="dropdown" aria-expanded="false">
              <img src="https://github.com/mdo.png" alt="" width="32" height="32" class="rounded-circle me-2">
              <strong>ProfilNév</strong>
            </a>
            <ul class="dropdown-menu dropdown-menu-dark text-small shadow" aria-labelledby="dropdownUser1">
              <li><a class="dropdown-item" href="upload.html">Szoftverfeltöltés</a></li>
              <li><a class="dropdown-item" href="#">Beállítások</a></li>
              <li><a class="dropdown-item" href="#">Profil</a></li>
              <li>
                <hr class="dropdown-divider">
              </li>
              <li><a class="dropdown-item" href="#">Kijelentkezés</a></li>

          </div>
        </div>
    </nav>


    <div class="row" style="height: 100vw;">
      <div class="col my-sidebar">

      </div>

      <div class="col bg-light m-1">
        <div class="row m-2">
          <nav class="navbar navbar-dark bg-dark rounded">
            <a class="navbar-brand mx-auto" style="font-weight: bold;">Szoftver feltöltése</a>
          </nav>
        </div>
        <div class="row" data-bs-theme="dark">

          <form enctype="multipart/form-data" action="upload_file.php" method="post">
            <nav class="navbar navbar-dark bg-dark rounded mb-5 mx-auto w-50">
              <a class="navbar-brand mx-auto" style="font-weight: bold;">Adatok</a>
            </nav>

            <div class="mb-3">
              <input type="text" class="form-control" id="nevInput" placeholder="Kérem adja meg a kód nevét">
            </div>

            <div class="mb-3">

              <input type="number" class="form-control" id="arInput" placeholder="Kérem adja meg a kód árát">
            </div>

            <select class="form-select mb-5" id="katInput" aria-label="kategoria">
              <option selected>Kérem válasszon kategóriát</option>
              <option value="1">HTML</option>
              <option value="2">CSS</option>
              <option value="3">JS</option>
              <option value="4">PHP</option>
              <option value="5">C#</option>
            </select>
            <nav class="navbar rounded mb-5 mx-auto w-50 navbar-dark bg-dark">
              <a class="navbar-brand mx-auto" style="font-weight: bold;">Kód</a>
            </nav>
            <div class="mb-3">

              <input class="form-control" type="file" id="fileToUpload" name="fileToUpload">

            </div>
            <div class="mb-3 text-center">

              <button type="submit" id="uploadBtn" class="btn btn-dark btn-lg">Feltöltés</button>
            </div>
          </form>
        </div>
      </div>

      <div class="col my-sidebar">

      </div>

    </div>




    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
      integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
      crossorigin="anonymous"></script>
      
    <script src="js/upload.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    
  </body>

</html>