<?php

require 'conexion.php';

$idcarrera = $_POST['lacarrera'];

//select 1 de asignaturas
$query = $mysqli->query("SELECT * FROM asignatura where carrera_idcarrera = $idcarrera ORDER BY nombre_asig ASC");

echo '<option  value="0" selected>Seleccione la asignatura</option>';

while ( $row = $query->fetch_assoc() )
{
	echo '<option name="' . $row['nombre_asig']. '" value="' . $row['id_asig']. '">' . $row['nombre_asig'].'</option>' . "\n";
	
}