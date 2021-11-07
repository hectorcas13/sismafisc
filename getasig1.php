<?php

require 'conexion.php';

$idcarrera1 = $_POST['lacarrera1'];

//select 2 de asignaturas
$query1 = $mysqli->query("SELECT * FROM asignatura where carrera_idcarrera = $idcarrera1 ORDER BY nombre_asig ASC");

echo '<option value="0" selected>Seleccione la asignatura</option>';

while ( $row1 = $query1->fetch_assoc() )
{
	
	echo '<option name="' . $row1['nombre_asig']. '" value="' . $row1['id_asig']. '">'.$row1['nombre_asig']. '</option>' . "\n";
}
?>