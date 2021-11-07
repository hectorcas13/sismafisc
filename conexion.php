<?php

$mysqli = mysqli_connect("localhost","root","","sismafisc");
if($mysqli->connect_errno){
    die(''.$mysqli->connect-error);
echo "Error al conectarse con MySQL debido al error".$mysqli->connect_error;}

?>