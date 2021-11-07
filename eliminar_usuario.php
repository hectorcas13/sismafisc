<?php
require 'conexion.php';
include 'scripts.php';

session_start();
if(isset($_SESSION['administrador'])){ 
	$id = $_GET['id'];
    $sql ="DELETE FROM `usuario` WHERE `id` = '$id'"; //Elimina al usuario
	$resultado = $mysqli->query($sql);

	$sql2 ="ALTER TABLE usuario AUTO_INCREMENT = 1"; //Restable el id de la tabla usuario
	$resultado2 = $mysqli->query($sql2);

?>
<html lang="es">
<head>
	<title>Eliminar registro</title>
</head>
<body>
	<div class="container-fluid" style="margin:0px;">
		<div style="text-align:center">
			<?php if($resultado){
		
			echo'<script type="text/javascript">
			alert("¡BIEN! Usuario Eliminado");
			window.location.href="ver_usuario.php";
			</script>';

			} else {
				
			echo'<script type="text/javascript">
			alert("¡ERROR! El registro no fue actualizado");
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