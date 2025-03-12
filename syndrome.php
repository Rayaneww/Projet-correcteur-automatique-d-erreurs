<?php

$bits = "1110111";   
$masques1 = "1010101";
$masques2 = "0110110";
$masques3 = "0001111";

$syndrome1 = $bits & $masques1;
$syndrome1 = (int) $bits[0] ^ (int) $bits[1] ^ (int) $bits[2] ^ (int) $bits[3] ^ (int) $bits[4] ^ (int) $bits[5] ^ (int) $bits[6];
echo($syndrome1);

$syndrome2 = $bits & $masques2;
$syndrome2 = (int) $bits[0] ^ (int) $bits[1] ^ (int) $bits[2] ^ (int) $bits[3] ^ (int) $bits[4] ^ (int) $bits[5] ^ (int) $bits[6];
echo($syndrome2);

$syndrome3 = $bits & $masques3;
$syndrome3 = (int) $bits[0] ^ (int) $bits[1] ^ (int) $bits[2] ^ (int) $bits[3] ^ (int) $bits[4] ^ (int) $bits[5] ^ (int) $bits[6];
echo($syndrome3);

?>

