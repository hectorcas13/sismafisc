<?php

require 'conexion.php';



$query = $mysqli->query("SELECT * FROM facultad");

echo '<option value="' . utf8_encode($row['facultad']). '" >Seleccione la facultad</option>';

while ( $row = $query->fetch_assoc() )
{
	echo '<option required name="' . $row['id']. '" value="' . $row['id']. '">' . $row['facultad'] . '</option>' . "\n";
}
?>
