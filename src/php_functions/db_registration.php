<?php

include_once "db_connect.php";
include_once "db_insert.php";

function registration($username, $email, $hashedPassword) {

    try {
        insertData("INSERT INTO felhasznalo (`nev`, `email`, `jelszo`, `pontok`, `letrehozasi_ido`, `utolso_valt_ido`) VALUES (?, ?, ?, NULL, current_timestamp(), current_timestamp());", "sss", [$username, $email, $hashedPassword]);
        return '<div class="registration-wrapper">
                    <div class="registration-popup">
                        <div class="title-container">
                            <h3>Sikeres regisztráció!</h3>
                            <svg xmlns="http://www.w3.org/2000/svg" id="svg_x" width="35" height="35" fill="currentColor" class="bi bi-x" viewBox="0 0 16 16">
                            <path d="M4.646 4.646a.5.5 0 0 1 .708 0L8 7.293l2.646-2.647a.5.5 0 0 1 .708.708L8.707 8l2.647 2.646a.5.5 0 0 1-.708.708L8 8.707l-2.646 2.647a.5.5 0 0 1-.708-.708L7.293 8 4.646 5.354a.5.5 0 0 1 0-.708"/>
                            </svg>
                        </div>
                        <hr>
                        <div class="content">
                            <p>Kellemes időtöltést és jó kódolást kívánunk!</p>
                        </div>
                        <hr>
                        <div class="button-container">
                            <a id="button_login" href="./login.php">Bejelentkezés</a>
                        </div>
                    </div>
                </div>';
    }
    catch (Exception $e) {
        $errorMessage = $e->getMessage();
        if (strpos($errorMessage, "nev") !== false) {
                return '<div class="registration-wrapper">
                            <div class="failed-registration-popup">
                                <div class="failed-title-container">
                                    <h3>Foglalt felhasználónév!</h3>
                                    <svg xmlns="http://www.w3.org/2000/svg" id="svg_x" width="35" height="35" fill="currentColor" class="bi bi-x" viewBox="0 0 16 16">
                                        <path d="M4.646 4.646a.5.5 0 0 1 .708 0L8 7.293l2.646-2.647a.5.5 0 0 1 .708.708L8.707 8l2.647 2.646a.5.5 0 0 1-.708.708L8 8.707l-2.646 2.647a.5.5 0 0 1-.708-.708L7.293 8 4.646 5.354a.5.5 0 0 1 0-.708"/>
                                    </svg>
                                </div>
                                <hr>
                                <div class="content">
                                    <p>Kérjük válasszon másik felhasználónevet.</p>
                                </div>
                                <hr>
                                <div class="button-container">
                                    <button id="button_okay">Rendben</button>
                                </div>
                            </div>
                        </div>';
            }
            else if (strpos($errorMessage, "email") !== false) {
                return '<div class="registration-wrapper">
                            <div class="failed-registration-popup">
                                <div class="failed-title-container">
                                    <h3>Foglalt email cím!</h3>
                                    <svg xmlns="http://www.w3.org/2000/svg" id="svg_x" width="35" height="35" fill="currentColor" class="bi bi-x" viewBox="0 0 16 16">
                                        <path d="M4.646 4.646a.5.5 0 0 1 .708 0L8 7.293l2.646-2.647a.5.5 0 0 1 .708.708L8.707 8l2.647 2.646a.5.5 0 0 1-.708.708L8 8.707l-2.646 2.647a.5.5 0 0 1-.708-.708L7.293 8 4.646 5.354a.5.5 0 0 1 0-.708"/>
                                    </svg>
                                </div>
                                <hr>
                                <div class="content">
                                    <p>Kérjük válasszon másik emailt.</p>
                                </div>
                                <hr>
                                <div class="button-container">
                                    <button id="button_okay">Rendben</button>
                                </div>
                            </div>
                        </div>';
            }
    }
}