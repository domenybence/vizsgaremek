<?php



include_once "../php_functions/php_functions.php";
include '../php_functions/adatbazis_lekeres.php';


if (session_status() === PHP_SESSION_NONE) {
    startSession();
  }


$teljesURL = explode('/', $_SERVER['REQUEST_URI']);
$url = explode('?', end($teljesURL));

$bodyAdatok = json_decode(file_get_contents("php://input"), true);



switch (mb_strtolower($url[0])) {
    case 'osszesszoftver':
        if($_SERVER['REQUEST_METHOD'] == 'GET'){
            $osszes_sql = "SELECT kod.id, kod.nev, kategoria.nev AS katnev FROM `kod` INNER JOIN kategoria ON kod.kategoria_id = kategoria.id WHERE kod.jovahagyott = 1;";
            $osszes = adatokLekerese($osszes_sql);
            
            echo json_encode($osszes, JSON_UNESCAPED_UNICODE);
            
        }
        else{
            echo json_encode(['valasz' => 'Hibás metódus!'], JSON_UNESCAPED_UNICODE);
            header('bad request', true, 400);
        }
        break;
    
    case 'katkereses':
        if($_SERVER['REQUEST_METHOD'] == 'POST'){
            $kategoria = $bodyAdatok['kategoria'];
            $kat_sql = "SELECT kod.id, kod.nev, kategoria.nev AS katnev FROM `kod` INNER JOIN kategoria ON kod.kategoria_id = kategoria.id WHERE kategoria_id = {$kategoria} AND kod.jovahagyott = 1 LIMIT 10";
            $kat = adatokLekerese($kat_sql);
            
            echo json_encode($kat, JSON_UNESCAPED_UNICODE);

        }      
        else
        {
            echo json_encode(['valasz' => 'Hibás metódus!'], JSON_UNESCAPED_UNICODE);
            header('bad request', true, 400);
        }
        break;
    case 'jovahagyando':
        if($_SERVER['REQUEST_METHOD'] == 'GET'){
            $jova_sql = "SELECT kod.id, kod.nev, kategoria.nev AS katnev FROM `kod` INNER JOIN kategoria ON kod.kategoria_id = kategoria.id WHERE kod.jovahagyott = 0";
            $jova = adatokLekerese($jova_sql);
                
            echo json_encode($jova, JSON_UNESCAPED_UNICODE);
                
        }
        else{
            echo json_encode(['valasz' => 'Hibás metódus!'], JSON_UNESCAPED_UNICODE);
            header('bad request', true, 400);
        }
        break;
        case 'jovahagyas':
            if($_SERVER['REQUEST_METHOD'] == 'POST'){
                $id = $bodyAdatok['id'];
                $jovahagy_sql = "UPDATE `kod` SET jovahagyott = 1 WHERE id = {$id}";
                $jovahagy = adatokValtoztatasa($jovahagy_sql);

                echo json_encode($jovahagy, JSON_UNESCAPED_UNICODE);

                    
            }
            else{
                echo json_encode(['valasz' => 'Hibás metódus!'], JSON_UNESCAPED_UNICODE);
                header('bad request', true, 400);
            }
            break;
        case 'konyvtar':
            if($_SERVER['REQUEST_METHOD'] == 'GET'){
                $userid = $_SESSION["userid"];
                $konyvtar_sql = "SELECT kod.id, kod.nev, kategoria.nev AS katnev FROM `kod` INNER JOIN kategoria ON kod.kategoria_id = kategoria.id INNER JOIN felhasznalo_megvett ON kod.id = felhasznalo_megvett.kod_id WHERE felhasznalo_megvett.felhasznalo_id = {$userid}";
                $konyvtar = adatokLekerese($konyvtar_sql);

                echo json_encode($konyvtar, JSON_UNESCAPED_UNICODE);

                    
            }
            else{
                echo json_encode(['valasz' => 'Hibás metódus!'], JSON_UNESCAPED_UNICODE);
                header('bad request', true, 400);
            }
            break;
            case 'kategoriak':
                if($_SERVER['REQUEST_METHOD'] == 'GET'){
                
                    $kat_sql = "SELECT * FROM kategoria";
                    $kat = adatokLekerese($kat_sql);
    
                    echo json_encode($kat, JSON_UNESCAPED_UNICODE);
    
                        
                }
                else{
                    echo json_encode(['valasz' => 'Hibás metódus!'], JSON_UNESCAPED_UNICODE);
                    header('bad request', true, 400);
                }
                break;
    
    default:
        echo 'nem megfelelő http url';
        break;
}


?>