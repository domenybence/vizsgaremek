<?php


include '../php_functions/adatbazis_lekeres.php';



    if($_SERVER['REQUEST_METHOD'] == 'POST'){

        $userid = $_POST["userid"];
        $categoryid = $_POST["categoryid"];
        $name = $_POST["name"];
        $price = $_POST["price"];


        $feltoltes_sql = "INSERT INTO `kod` (`id`, `felhasznalo_id`, `kategoria_id`, `nev`, `ar`, `eleresi_ut`, `feltoltesi_ido`, `jovahagyott`) VALUES (NULL , $userid, $categoryid, $name , $price , 'test', CURRENT_TIMESTAMP , 0)";
        $feltoltes = adatokValtoztatasa($feltoltes_sql);
        echo $feltoltes;
       
            
    }
    else{
        echo json_encode(['valasz' => 'Hibás metódus!'], JSON_UNESCAPED_UNICODE);
        header('bad request', true, 400);
    }
 


?>