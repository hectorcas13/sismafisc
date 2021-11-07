<?php

require 'conexion.php';

$idfacultad = $_POST['lafacultad'];

$query = $mysqli->query("SELECT * FROM carrera where facultad_id = $idfacultad ORDER BY nombre_carrera ASC");

echo '<option value="' . utf8_encode($row['nombre_carrera']). '" >Seleccione el programa</option>';

while ( $row = $query->fetch_assoc() )
{
	echo '<option required name="' . $row['idcarrera']. '" value="' . $row['idcarrera']. '">' . $row['nombre_carrera'] . '</option>' . "\n";
}
?>
