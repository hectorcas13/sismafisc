<?php

require 'conexion.php'; // Se incluye la conexión a la base de datos.
include 'scripts.php'; // Se importa las funciones en javascript para que funcione la página.

session_start();
if(isset($_SESSION['u_usuario'])){

  $new_costo_asig = $_POST['costo_asig'];
  if(empty($new_costo_asig)){

  }else{
    $sql1 = "UPDATE `costo_asig` SET `costo_materia` = '$new_costo_asig' WHERE `costo_asig`.`id_materia` = 1;";
    $resultado1 = $mysqli->query($sql1);
    // Ejecuta la consulta
    $resultado1 = mysqli_query($mysqli,$sql1);
      if(!$resultado1){

        echo'<script type="text/javascript">
        alert("¡ERROR! El costo no fue actualizado");
        window.history.go(-1);
        </script>';
      }
      else{
        echo'<script type="text/javascript">
        alert("¡BIEN! EL NUEVO MULTIPLICADOR DE LA MATERIA ES '.$new_costo_asig.'");
        window.location.href="edicion.php#costoasig";
        </script>';
        }
  }
?>
<?php
}else{
  header("Location:cerrar_session.php");
}
?>
