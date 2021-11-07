<?php
require 'conexion.php';
session_start();
if(isset($_SESSION['administrador'])){ 
    //Recibe los datos de carreras
    $id = $_POST['id_user'];
    $nombre= $_POST['nombre'];
    $apellido = $_POST['apellido'];
    $usuario = $_POST['usuario'];
    $contrasena= $_POST['contra'];
    //Consulta para Insertar datos a la base de datos dbsap
    $sql = "UPDATE usuario SET id = '$id', nombre ='$nombre',  apellido='$apellido', usuario='$usuario', contrasena='$contrasena'   WHERE id_user = '$id'";

    // Ejecuta la consulta
    $resultado = mysqli_query($mysqli,$sql);
    include 'scripts.php';
?>
<html lang="es">
<head>
        <title>Actualización</title>
</head>
<body>
    <div class="container-fluid">
        <div style="text-align:center">
            <?php if($resultado) {

                    echo'<script type="text/javascript">
                    alert("¡BIEN! Carrera actualizada exitosamente");
                    window.location.href="ver_usuario.php";
                    </script>';
                }else { 

                    echo'<script type="text/javascript">
                    alert("¡ERROR! El registro no fue actualizado, Intente cambiando su contraseña");
                    window.history.go(-1);
                    </script>';
                } ?>
        </div>
    </div>
</body>
</html>
<?php }
else{
  header("Location:cerrar_session.php");
}
?>