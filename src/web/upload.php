<?php


include '../php_functions/adatbazis_lekeres.php';

$data = json_decode(file_get_contents('php://input'), true);

    if($_SERVER['REQUEST_METHOD'] == 'POST'){

        $userid = $data["userid"];
        $categoryid = $data["categoryid"];
        $name = $data["name"];
        $price = $data["price"];


        $feltoltes_sql = "INSERT INTO `kod` (`id`, `felhasznalo_id`, `kategoria_id`, `nev`, `ar`, `eleresi_ut`, `feltoltesi_ido`, `jovahagyott`) VALUES (NULL , '$userid', '$categoryid', '$name' , '$price' , 'test', CURRENT_TIMESTAMP , 0)";
        $feltoltes = adatokValtoztatasa($feltoltes_sql);
        echo $feltoltes;
       
            
    }
    else{
        echo json_encode(['valasz' => 'Hibás metódus!'], JSON_UNESCAPED_UNICODE);
        header('bad request', true, 400);
    }
 


?>