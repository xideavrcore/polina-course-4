<?php
$a = 10;
$b = 20;
echo "1) a = $a, b = $b<br>";

$c = $a + $b;
echo "2) c = $c<br>";

$c = $c * 3;
echo "3) c * 3 = $c<br>";

echo "4) c / (b - a) = " . ($c / ($b - $a)) . "<br>";

$p = "Программа";
$b = "работает";
echo "5) p = $p, b = $b<br>";

$result = $p . " " . $b;
echo "6) result = $result<br>";

$result .= " хорошо";
echo "7) result = $result<br>";

$q = 5;
$w = 7;
echo "8) до обмена: q = $q, w = $w<br>";
$q = $q + $w;
$w = $q - $w;
$q = $q - $w;
echo "8) после обмена: q = $q, w = $w<br>";
?>
