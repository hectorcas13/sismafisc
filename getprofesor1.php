<?php

require 'conexion.php';

$idprofesor1 = $_POST['el_profesor1'];

//select 1 de asignaturas
$query4 = $mysqli->query("SELECT DISTINCT nom_prof, ape_prof, id_profesor, profesor_id_profesor from profesor P inner join asignatura_has_profesor AA ON P.id_profesor = AA.profesor_id_profesor AND AA.asignatura_id_asig = $idprofesor1;");

echo '<option value="0" >Seleccione el docente </option>';

while ( $row4 = $query4->fetch_assoc() )
{
	echo '<option value="' . $row4['id_profesor']. '">' . $row4['nom_prof'].' '.$row4['ape_prof'] . '</option>' . "\n";
}
