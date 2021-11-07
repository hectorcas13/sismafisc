
<?php
require 'conexion.php';
include 'scripts.php';
include 'funciones.php';

session_start();
if(isset($_SESSION['u_usuario'])){ 
    //Recibe los datos de carreras
    $id = $_POST['id_asig'];
    $asig = $_POST['nombre_asig'];
    $creditos = $_POST['creditos'];
    $abre = isset($_POST['abre_asig']) ? $_POST['abre_asig'] : null;
    $lab = $_POST['lab'];
    $codasig = $_POST['cod_asig'];
    $codasig2 = $_POST['codigo_original']; //Variable se ingresa para validar repetidos
    //Consulta para Insertar datos a la base de datos
    $sql = "UPDATE asignatura SET id_asig = '$id', nombre_asig ='$asig', abre_asig = '$abre', lab = '$lab', cod_asig = '$codasig', creditos = '$creditos' WHERE id_asig = '$id'";
    $resultado = $mysqli->query($sql);

    
?>
<html lang="es">
<head>
       <link rel="stylesheet" href="css/ver_carrera.css">
        <title>Actualización</title>
</head>
<body>
    <div class="container-fluid">
        <div style="text-align:center">
            <?php if($resultado) {

                    echo'<script type="text/javascript">
                    alert("¡BIEN! Asignatura actualizada exitosamente");
                    window.location.href="ver_asignatura.php";
                    </script>';
                }else { 

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