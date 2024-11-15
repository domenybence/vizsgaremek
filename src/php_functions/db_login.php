<?php

function login($username, $hashedPassword) {
    include_once "db_connect.php";
    $db = getDb();
    
    if ($db->connect_errno) {
        return "<div class='error-group'>Az adatbázishoz nem sikerült hozzákapcsolódni!</div>";
    }
}