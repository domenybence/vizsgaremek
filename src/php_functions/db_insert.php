<?php

function dataInsert($query){
    include_once "db_connect.php";
    $db = getDb();
    if($db->connect_errno == 0){
        $db->query($query);
        if($db->errno == 0){
            if($db->affected_rows > 0){
                return true;
            }
            else if($db->affected_rows == 0){
                return false;
            }
            else{
                return $db->error;
            }
        }
        else{
            return $db->error;
        }
    }
    else{
        return $db->connect_error;
    }
}
?>