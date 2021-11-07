<?php
require 'conexion.php';
session_start();
if(isset($_SESSION['u_usuario'])){ 
    
    //Recibe los datos de carreras
    $nombre_de_la_facultad= $_POST['facultad'];
    $id = $_POST['id_facultad'];
    $sql = "UPDATE facultad SET facultad ='$nombre_de_la_facultad', id = '$id' WHERE id = '$id'";
   
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
                alert("¡BIEN! Facultad actualizada exitosamente");
                window.location.href="ver_facultad.php";
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