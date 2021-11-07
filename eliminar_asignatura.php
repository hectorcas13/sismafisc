<?php
require 'conexion.php';
include 'scripts.php';

session_start();
if(isset($_SESSION['u_usuario'])){
	$id = $_GET['id'];
    $sql ="DELETE FROM `asignatura` WHERE `id_asig` = '$id'";
	$resultado = $mysqli->query($sql);
	require 'scripts.php';

	$sql2 ="ALTER TABLE asignatura AUTO_INCREMENT = 1"; //Restable el id de la tabla carrera
	$resultado2 = $mysqli->query($sql2);
?>
<html lang="es">
<head>
	<title>Eliminar registro</title>
</head>
<body>
	<div class="container-fluid">
		<div style="text-align:center">
			<?php if($resultado) { ?>
			<div class="alert alert-success">
				<strong>BIEN!</strong> LA ASIGNATURA HA SIDO ELIMINADA.
			</div>
			<a href="ver_asignatura.php">
				<button type="button" class="btn btn-lg">Volver</button>
			</a>
			<?php } else { ?>
			<div class="alert alert-warning">
				<strong>ERROR!</strong> EL REGISTRO NO FUE ELIMINADO
			</div>
			<br />
			<a href="ver_asignatura.php">
				<button type="button" class="btn btn-lg">Volver</button>
			</a>
			<?php } ?>
		</div>
	</div>
</body>
</html>
<?php
}else{
  header("Location:cerrar_session.php");
}
?>