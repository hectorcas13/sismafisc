<?php 


$ñ = "ñ";
$print = htmlentities($ñ, ENT_QUOTES, "UTF-8");
echo $print;
echo "<br />";
echo $ñ;

?>