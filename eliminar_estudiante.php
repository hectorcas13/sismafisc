<?php
require 'conexion.php';
include 'scripts.php';

session_start();
if(isset($_SESSION['u_usuario'])){
	$id = $_GET['id'];
    $sql ="DELETE FROM `estudiantes` WHERE `id_estu` = '$id'";
	$resultado = $mysqli->query($sql);
	

	$sql2 ="ALTER TABLE estudiantes AUTO_INCREMENT = 1"; //Restable el id de la tabla carrera
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
					<strong>BIEN!</strong> REGISTRO DEL ESTUDIANTE HA SIDO ELIMINADO.
				</div>
				<br />
				<a href="ver_estudiante.php">
					<button type="button" class="btn btn-lg">Volver</button>
				</a>
				<?php } else { ?>
				<div class="alert alert-warning">
					<strong>ERROR!</strong> EL REGISTRO NO FUE ELIMINADO
				</div>
				<br />
				<a href="ver_estudiante.php">
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