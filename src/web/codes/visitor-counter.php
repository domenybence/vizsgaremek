<?php
$fajl = "latogatok.txt";

if (file_exists($fajl)) {
    $szam = (int)file_get_contents($fajl);
    $szam++;
} else {
    $szam = 1;
}

file_put_contents($fajl, $szam);
echo "Ezt az oldalt eddig $szam alkalommal látogatták meg.";
?>
