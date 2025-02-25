<?php

function getUser($query){
    include_once "db_connect.php";
    $db = getDb();
    if($db -> connect_errno == 0){
        $result = $db -> query($query);
        if($db -> errno == 0){
            if($result->num_rows != 0){
                return true;
            }
            else{
                return false;
            }
        }
        else{
            return $db -> error; 
        }
    }
    else{
        return $db -> connect_error;
    }
}
?>