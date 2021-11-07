<?php
require 'conexion.php';
include 'scripts.php';

session_start();
if(isset($_SESSION['u_usuario'])){

	$id = $_GET['id'];
    $sql ="DELETE FROM `facultad` WHERE `facultad`.`id` = '$id'";
	$resultado = $mysqli->query($sql);
	
	$sql2 ="ALTER TABLE facultad AUTO_INCREMENT = 1"; //Restable el id de la tabla carrera
	$resultado2 = $mysqli->query($sql2);

?>
<html lang="es">
	<head>
		<title>Eliminar registro</title>
		<link rel="short icon" href="img/prof.ico">
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
	</head>
	<body>
		<div class="container">
			<div class="row" style="text-align:center">
				<?php if($resultado) { 

				echo'<script type="text/javascript">
				alert("¡BIEN! Facultad Eliminada");
				window.location.href="ver_facultad.php";
				</script>';
				
				 } else { 

				echo'<script type="text/javascript">
				alert("¡ERROR! Al parecer hubo un error al actualizar el registro");
				window.history.go(-1);
				</script>';

				} ?>
			</div>
		</div>
	</body>
</html>
<?php
}else{
  header("Location:cerrar_session.php");
}
?>