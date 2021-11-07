<?php

//REQUIERE MODIFICACION
require 'conexion.php'; // Se incluye la conexión a la base de datos.
include 'scripts.php'; // Se importa las funciones en javascript para que funcione la página.
session_start();

  if(isset($_SESSION['u_usuario'])){ 
    //Recibe los datos de carreras
    $id = $_POST['idcal'];
    $fa = $_POST['fa'];
    $fb= $_POST['fb'];
     

    //Consulta para actualizar la base de datos mydb con la información del estudiante y su carrera
    $sql = "UPDATE settingdate SET fa = '$fa', fb ='$fb' WHERE id = '$id'";
    $resultado = mysqli_query($mysqli,$sql);
    
  ?>

        <body>
        <div class="container-fluid">
            <div style="text-align:center">
                <?php if($resultado) {
    
                        echo'<script type="text/javascript">
                        alert("¡BIEN! actualizado exitosamente");
                        window.location.href="edicion.php#cal";
                        </script>';
                    }else { 
    
                        echo'<script type="text/javascript">
                        alert("¡ERROR! No fue actualizado");
                        window.history.go(-1);
                        </script>';
                    } ?>
            </div>
        </div>
    </body>
<?php

}else{
  header("Location:cerrar_session.php");
}
?>