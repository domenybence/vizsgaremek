<?php
include_once "../php_functions/php_functions.php";
startSession();
unsetCookie();
session_unset();
session_destroy();
header("Location: home.php");
exit();