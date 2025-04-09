<?php
include_once "../php_functions/php_functions.php";
include '../php_functions/adatbazis_lekeres.php';

if (session_status() === PHP_SESSION_NONE) {
    startSession();
}

if (!isset($_SESSION["userid"])) {
    echo "<script src='/src/web/js/gsap-public/minified/gsap.min.js'></script>
         <script src='/src/web/js/loader.js'></script>
         <script>
            alert('Bejelentkezés szükséges a feltöltéshez!');
            translateOut('/bejelentkezes');
         </script>";
    exit();
}

$target_dir = __DIR__ . "/codes/";

if (!file_exists($target_dir)) {
    mkdir($target_dir, 0777, true);
}

if($_SERVER["REQUEST_METHOD"] == "POST") { 
    if(isset($_FILES["fileToUpload"]) && $_FILES["fileToUpload"]["error"] == 0) {
        $file_name = $_FILES["fileToUpload"]["name"]; 
        $file_type = $_FILES["fileToUpload"]["type"]; 
        $file_size = $_FILES["fileToUpload"]["size"]; 
        $target_file = $target_dir . basename($file_name);
        $uploadOk = 1;
      
        $maxsize = 2 * 1024 * 1024;
        if ($file_size > $maxsize) { 
            echo "<script src='/src/web/js/gsap-public/minified/gsap.min.js'></script>
                 <script src='/src/web/js/loader.js'></script>
                 <script>
                    alert('Hiba: Maximum fájlméret túllépés!');
                    translateOut('/kodfeltoltes');
                 </script>";
            exit();
        }                     

        if (file_exists($target_file)) { 
            echo "<script src='/src/web/js/gsap-public/minified/gsap.min.js'></script>
                 <script src='/src/web/js/loader.js'></script>
                 <script>
                    alert('Hiba: $file_name már létezik. Válassz másik fájlnevet!');
                    translateOut('/kodfeltoltes');
                 </script>";
            exit();
        }

        $userid = $_SESSION["userid"];
        $name = $_POST["softwareName"];
        $existing_file = preparedGetData("SELECT id FROM kod WHERE eleresi_ut = ? OR nev = ?", "ss", [$file_name, $name]);
        
        if ($existing_file && count($existing_file) > 0) {
            echo "<script src='/src/web/js/gsap-public/minified/gsap.min.js'></script>
                 <script src='/src/web/js/loader.js'></script>
                 <script>
                    alert('Hiba: Már létezik kód ezzel a névvel vagy fájlnévvel!');
                    translateOut('/kodfeltoltes');
                 </script>";
            exit();
        }
        
        if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) { 
            $categoryid = $_POST["category"];
            $price = $_POST["softwarePrice"];
            
            $kod_result = insertData(
                "INSERT INTO `kod` (`felhasznalo_id`, `kategoria_id`, `nev`, `ar`, `eleresi_ut`, `feltoltesi_ido`, `jovahagyott`) 
                VALUES (?, ?, ?, ?, ?, CURRENT_TIMESTAMP, 0)",
                "iisss",
                [$userid, $categoryid, $name, $price, $file_name]
            );
            
            if($kod_result) {
                echo "<script src='/src/web/js/gsap-public/minified/gsap.min.js'></script>
                     <script src='/src/web/js/loader.js'></script>
                     <script>
                        alert('Sikeres feltöltés! A kód jóváhagyásra vár.');
                        translateOut('/');
                    </script>";
                exit();
            } else {
                unlink($target_file);
                
                echo "<script src='/src/web/js/gsap-public/minified/gsap.min.js'></script>
                     <script src='/src/web/js/loader.js'></script>
                     <script>
                        alert('Sikertelen adatbázis művelet!');                            
                        translateOut('/kodfeltoltes');
                     </script>";
                exit();
            }
        } else { 
            $error = error_get_last();
            echo "<script src='/src/web/js/gsap-public/minified/gsap.min.js'></script>
                 <script src='/src/web/js/loader.js'></script>
                 <script>
                    alert('Hiba történt a fájl feltöltése közben! " . addslashes($error['message'] ?? 'Ismeretlen hiba') . "');
                    translateOut('/kodfeltoltes');
                 </script>";
            exit();
        } 
    } else { 
        echo "<script src='/src/web/js/gsap-public/minified/gsap.min.js'></script>
             <script src='/src/web/js/loader.js'></script>
             <script>
                alert('Hiba: " . $_FILES["fileToUpload"]["error"] . "');
                translateOut('/kodfeltoltes');
             </script>";
        exit();
    } 
} else {
    header("Location: /kodfeltoltes");
    exit();
}
