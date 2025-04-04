<?php

include '../php_functions/adatbazis_lekeres.php';
$target_dir = "codes/"; 
    $target_file = $target_dir 
      . basename($_FILES["fileToUpload"]["name"]); 
    $uploadOk = 1; 
    
    if($_SERVER["REQUEST_METHOD"] == "POST") { 
    
   
      if(isset($_FILES["fileToUpload"]) &&  
          $_FILES["fileToUpload"]["error"] == 0) { 
      
          $file_name = $_FILES["fileToUpload"]["name"]; 
          $file_type = $_FILES["fileToUpload"]["type"]; 
          $file_size = $_FILES["fileToUpload"]["size"]; 
        
          $maxsize = 2 * 1024 * 1024; 
            
          if ($file_size > $maxsize) { 
              die("Hiba: Maximum fájlméret túllépés."); 
          }                     

              if (file_exists("codes/" . $_FILES["fileToUpload"]["name"])) { 
                  echo $_FILES["fileToUpload"]["name"]." már létezik."; 
              }         
              else { 
                  if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"],  
                    $target_file)) { 
                       
                    
                        $eleresi_sql = "UPDATE kod SET eleresi_ut = '$file_name' WHERE id = (SELECT id FROM kod ORDER BY id DESC LIMIT 1)";
                        $eleresi = adatokValtoztatasa($eleresi_sql);
                        if($eleresi = "Sikeres művelet!")
                        {
                         
                           header('SUCCESS',true, 200);
                        }
                        else
                        {
                            header('PATH ERROR', true, 400);
                        }

                  }  
                  else { 
                    header('ALREADY EXISTS', true, 400);
                  } 
              } 
           
       
      } 
      else { 
          echo "Error: ". $_FILES["fileToUpload"]["error"]; 
      } 
  } 