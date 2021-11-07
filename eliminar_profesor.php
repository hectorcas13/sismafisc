<?php
require 'conexion.php';
include 'scripts.php';

session_start();
if(isset($_SESSION['u_usuario'])){
	$id = $_GET['id'];
    $sql ="DELETE FROM `profesor` WHERE `profesor`.`id_profesor` = '$id'";
	$resultado = $mysqli->query($sql);
	require 'scripts.php';

	$sql2 ="ALTER TABLE profesor AUTO_INCREMENT = 1"; //Restable el id de la tabla profesor
	$resultado2 = $mysqli->query($sql2);

?>
<html lang="es">
<head>
	<title>Eliminar registro</title>
</head>
<body>
	<div class="container-fluid">
		<div style="text-align:center">
			<?php if($resultado) { 


				echo'<script type="text/javascript">
				alert("¡BIEN! Profesor ha sido eliminado");
				window.location.href="ver_profesor.php";
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