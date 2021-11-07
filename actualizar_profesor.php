<?php
require 'conexion.php';
include 'scripts.php';
require_once 'funciones.php'; // Se importa las funciones que validan la entrada de información.
session_start();
if(isset($_SESSION['u_usuario'])){ 
    //Recibe los datos de carreras
    $id = $_POST['id_profesor'];
    $nombre= $_POST['nprofesor'];
    $apellido = $_POST['aprofesor'];
    $correo = $_POST['correoprofesor'];
    $correo2 = $_POST['correo_original'];


  
    if ((($correo2 == $correo)  && (buscaRepetidoCorreoProf($correo,$mysqli)==1))){

   
        //Consulta para Insertar datos a la base de datos dbsap
        $sql = "UPDATE profesor SET id_profesor = '$id', nom_prof ='$nombre',  ape_prof='$apellido', correo_prof='$correo'  WHERE id_profesor = '$id'";
        $resultado = $mysqli->query($sql);
        // Ejecuta la consulta
        $resultado = mysqli_query($mysqli,$sql);

        echo'<script type="text/javascript">
        alert("¡BIEN! Datos del profesor actualizados");
        window.location.href="ver_profesor.php";
        </script>';

    }
    elseif (($correo2 != $correo) && (buscaRepetidoCorreoProf($correo,$mysqli)==1)) {
        
        echo'<script type="text/javascript">
        alert("¡OJO! Existe otro profesor el mismo correo, revise sus datos e intente nuevamente ");
        window.history.go(-1);
        </script>';
    }
    elseif(($correo2 != $correo) && (buscaRepetidoCorreoProf($correo,$mysqli)==0)){

        //Consulta para Insertar datos a la base de datos dbsap
        $sql = "UPDATE profesor SET id_profesor = '$id', nom_prof ='$nombre',  ape_prof='$apellido', correo_prof='$correo'  WHERE id_profesor = '$id'";
        $resultado = $mysqli->query($sql);
        // Ejecuta la consulta
        $resultado = mysqli_query($mysqli,$sql);

        echo'<script type="text/javascript">
        alert("¡BIEN! Datos del profesor actualizados");
        window.location.href="ver_profesor.php";
        </script>';

    }
    else{
        /* Si deseas ingresar nueva cedula pero ya existe en la base de datos se ejecutará esto y enviará error */
        echo'<script type="text/javascript">
        alert("¡OJO! Hubo un error al modificar los datos, intente nuevamente.");
        window.location.href="ver_profesor.php";
        </script>';
    }
}
else{
  header("Location:cerrar_session.php");
}
?>