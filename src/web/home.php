<?php

include_once "../php_functions/php_functions.php";

if (session_status() === PHP_SESSION_NONE) {
  startSession();
}
?>

<!DOCTYPE html>
<html lang="hu">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>CodeOverflow</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="./src/web/css/home.css">
  <link rel="icon" type="image/x-icon" href="./src/web/icon.png">
  <script src="./src/web/js/home.js" defer></script>
  <script src="./src/web/js/navbar.js" defer></script>
  <script src="./src/web/js/gsap-public/minified/gsap.min.js" defer></script>
  <link rel="stylesheet" href="./src/web/css/navbar.css">
  <link rel="stylesheet" href="./src/web/css/loader.css">
</head>

<body class="bg-dark text-light" style="padding-top: 100px;">
  <div class="page-cover"></div>
  <?php include "navbarsearch.php"; ?>

  <div class="container-fluid mt-3">
    <div class="row">
      <aside class="col-md-3 col-lg-2 bg-dark p-3">
        <h4>Kategóriák</h4>
        <hr>
        <form>
          <div class="d-grid gap-2" id="kategoriak">
            <button type="button" id="ossz" class="btn btn-outline-light">Összes</button>

          </div>
        </form>
      </aside>

      <main class="col-md-9 col-lg-10 bg-light p-3">
        <div id="carousel-fokepek" class="carousel slide" data-bs-ride="carousel">
          <div class="carousel-indicators">
            <button type="button" data-bs-target="#carousel-fokepek" data-bs-slide-to="0" class="active"></button>
            <button type="button" data-bs-target="#carousel-fokepek" data-bs-slide-to="1"></button>
            <button type="button" data-bs-target="#carousel-fokepek" data-bs-slide-to="2"></button>
          </div>
          <div class="carousel-inner">
            <div class="carousel-item active">
              <img src="./src/web/img/carousel1.jpg" class="d-block w-100" alt="CodeOverFlow">
            </div>
            <div class="carousel-item">
              <img src="./src/web/img/carousel2.jpg" class="d-block w-100" alt="CodeOverFlow">
            </div>
            <div class="carousel-item">
              <img src="./src/web/img/carousel3.jpg" class="d-block w-100" alt="CodeOverFlow">
            </div>
          </div>
          <button class="carousel-control-prev" type="button" data-bs-target="#carousel-fokepek" data-bs-slide="prev">
            <span class="carousel-control-prev-icon"></span>
          </button>
          <button class="carousel-control-next" type="button" data-bs-target="#carousel-fokepek" data-bs-slide="next">
            <span class="carousel-control-next-icon"></span>
          </button>

        </div>
        <div class="container mt-2 mb-4" id="about-section">
            <h2 class="text-center mb-4">Rólunk</h2>
            <div class="row">
              <div class="col-md-4">
                <div class="card shadow-sm border-0 mb-2 h-100">
                  <img src="./src/web/img/card1.jpg" class="card-img-top" alt="Our Mission">
                  <div class="card-body">
                    <h5 class="card-title">Mi a célunk?</h5>
                    <p class="card-text">A CodeOverflow célja, hogy egyszerűsítsük és megkönnyítsük a programozás világába való belépést, miközben erőforrásokat és eszközöket biztosítunk a fejlesztők számára minden szinten.</p>
                  </div>
                </div>
              </div>
              <div class="col-md-4">
                <div class="card shadow-sm border-0 mb-2 h-100">
                  <img src="./src/web/img/card2.jpg" class="card-img-top" alt="Our Vision">
                  <div class="card-body">
                    <h5 class="card-title">Jövőképünk</h5>
                    <p class="card-text">Célunk, hogy egy folyamatosan fejlődő közösséget építsünk, ahol a programozók együtt dolgozhatnak, tanulhatnak és megoszthatják tudásukat.</p>
                  </div>
                </div>
              </div>
              <div class="col-md-4">
                <div class="card shadow-sm border-0 mb-2 h-100">
                  <img src="./src/web/img/card3.jpg" class="card-img-top" alt="Our Team">
                  <div class="card-body">
                    <h5 class="card-title">Csapatunk</h5>
                    <p class="card-text">A csapatunk szenvedélyes és elkötelezett programozók, akik együtt dolgoznak a platform fejlesztésén, hogy minden felhasználónk a legjobb élményt kapja.</p>
                  </div>
                </div>
              </div>
            </div>
          </div>
        <div class="row mt-3" id="szoftverek"></div>
      </main>
    </div>
  </div>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
  <script src="./src/web/js/loader.js"></script>
</body>

</html>