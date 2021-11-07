<?php
require 'conexion.php';
session_start();
if(isset($_SESSION['u_usuario'])){ 
    
    //Recibe los datos de carreras
    $nombre_de_la_carrera = $_POST['nombre_carrera'];
    $facultad_de_la_carrera = $_POST['varfacultad']; 
    $id = $_POST['idcarrera'];
    $sql = "UPDATE carrera SET nombre_carrera ='$nombre_de_la_carrera', facultad_id ='$facultad_de_la_carrera',idcarrera = '$id' WHERE idcarrera = '$id'";
   
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
                window.location.href="ver_carrera.php";
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
<?php }
else{
  header("Location:cerrar_session.php");
}
?>