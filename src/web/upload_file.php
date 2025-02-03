
<?php
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
                      echo "The file ".  $_FILES["fileToUpload"]["name"].  
                        " has been uploaded."; 
                  }  
                  else { 
                      echo "Hiba."; 
                  } 
              } 
           
       
      } 
      else { 
          echo "Error: ". $_FILES["fileToUpload"]["error"]; 
      } 
  } 