<?php

require 'conexion.php';

$idprofesor = $_POST['el_profesor'];

//select 1 de asignaturas
$query3 = $mysqli->query("SELECT DISTINCT nom_prof, ape_prof, id_profesor, profesor_id_profesor from profesor P inner join asignatura_has_profesor AA ON P.id_profesor = AA.profesor_id_profesor AND AA.asignatura_id_asig = $idprofesor;");

echo '<option value="0" >Seleccione el docente</option>';

while ( $row3 = $query3->fetch_assoc() )
{
	echo '<option value="' . $row3['id_profesor']. '">' . $row3['nom_prof'].' '.$row3['ape_prof'] . '</option>' . "\n";
}
