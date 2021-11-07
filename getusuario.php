<?php

require 'conexion.php';

$query = $mysqli->query("SELECT * FROM usuario");

echo '<option value="' . utf8_encode($row['nombre']. ' '.$row['apellido']). '">Seleccione la carrera</option>';

while ( $row = $query->fetch_assoc() )
{
	echo '<option required name="' . $row['id']. '" value="' . $row['id']. '">' . utf8_encode($row['nombre']. ' '.$row['apellido']) . '</option>' . "\n";
}
?>
