<?php


include '../php_functions/adatbazis_lekeres.php';


$teljesURL = explode('/', $_SERVER['REQUEST_URI']);
$url = explode('?', end($teljesURL));

$bodyAdatok = json_decode(file_get_contents("php://input"), true);



switch (mb_strtolower($url[0])) {
    case 'osszesszoftver':
        if($_SERVER['REQUEST_METHOD'] == 'GET'){
            $osszes_sql = "SELECT * FROM `kod`";
            $osszes = adatokLekerese($osszes_sql);
            
            echo json_encode($osszes, JSON_UNESCAPED_UNICODE);
            
        }
        else{
            echo json_encode(['valasz' => 'Hibás metódus!'], JSON_UNESCAPED_UNICODE);
            header('bad request', true, 400);
        }
        break;
    
    case 'html':
        if($_SERVER['REQUEST_METHOD'] == 'GET'){
            
        }      
        else
        {
            echo json_encode(['valasz' => 'Hibás metódus!'], JSON_UNESCAPED_UNICODE);
            header('bad request', true, 400);
        }
        break;
    
    default:
        echo 'nem megfelelő http url';
        break;
}


?>