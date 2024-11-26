<?php

include_once "db_connect.php";

function insertData($queryText, $parameterTypes, $bindParameters = []) {
    $db = getDb();
    
    if ($db->connect_errno) {
        return "<div class='error-group'>Az adatbázishoz nem sikerült hozzákapcsolódni!</div>";
    }

    $query = $db->prepare($queryText);
    if(is_array($bindParameters)) {
        $query->bind_param($parameterTypes, ...$bindParameters);
    }
    else {
        $query->bind_param($parameterTypes, $bindParameters);
    }
    try {
        $query->execute();
    }
    catch (Exception $e) {
        throw new Exception($e->getMessage());
    }
    finally {
        $query->close();
        $db->close();
    }

    return true;
}