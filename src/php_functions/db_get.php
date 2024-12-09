<?php

include_once "db_connect.php";

function preparedGetData($queryText, $parameterTypes, $bindParameters = []) {
    $db = getDb();

    if ($db->connect_errno) {
        return "<div class='error-group'>Az adatbázishoz nem sikerült hozzákapcsolódni!</div>";
    }
    
    $query = $db->prepare($queryText);
    if($parameterTypes != "" && $bindParameters != ""){
        if(is_array($bindParameters)){
            $query->bind_param($parameterTypes, ...$bindParameters);
        }
        else {
            $query->bind_param($parameterTypes, $bindParameters);
        }
        try {
            $query->execute();
            $result = $query->get_result();
            if ($result->num_rows > 0) {
                return $result->fetch_all(MYSQLI_ASSOC);
            }
            else {
                return false;
            }
        }
        catch (Exception $e) {
            return "<div class='error-group'>Hiba történt a lekérdezés során!</div>";
        }
        finally {
            $query->close();
            $db->close();
        }
    }
}

function simpleGetData($query) {
    $db = getDb();
    if ($db->connect_errno) {
        return "<div class='error-group'>Az adatbázishoz nem sikerült hozzákapcsolódni!</div>";
    }
    $result = $db->query($query);

    if ($result) {
        $data = $result->fetch_all(MYSQLI_ASSOC);
        $result->free();
        return $data;
    }
    else {
        return false;
    }
}