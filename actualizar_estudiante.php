<?php

//REQUIERE MODIFICACION
require 'conexion.php';
include 'scripts.php';
require 'funciones.php';
session_start();

    if(isset($_SESSION['u_usuario'])){ 
        //Recibe los datos de carreras
        $id = $_POST['id_estudiante'];
        $nombre= $_POST['nombre_estu'];
        $apellido = $_POST['apellido_estu'];
        $cedula = $_POST['cedula_estu'];
        $cedula2 = $_POST['cedula_original']; //Variable se utiliza para validar repetidos
        $tel = isset($_POST['tel_estu']) ? $_POST['tel_estu'] : null;
        $cel = isset($_POST['cel_estu']) ? $_POST['cel_estu'] : null;
        $estado = $_POST['estado'];
        $correo = $_POST['correo_estu'];
        $grupo = $_POST['grupo'];
        $correo2 = $_POST['correo_original']; //Variable se utiliza para validar repetidos
        $carrera = $mysqli->real_escape_string($_POST['var1_reporte1']); //Carrera nueva escogida del dropdown menu
        $carrera2 = $mysqli->real_escape_string($_POST['id_carrera']); // variable para ver si se modificó la carrera

        if((($cedula != $cedula2) && (buscaRepetidoCedula($cedula,$mysqli)==1)) && (($correo != $correo2) && (buscaRepetidoCorreo($correo,$mysqli)== 1))){

        echo'<script type="text/javascript">
        alert("ERROR, La cédula y el correo ya están asignados a otro estudiante, revise sus datos e intente nuevamente.");
        window.history.go(-1);
        </script>';

        }
        elseif((($cedula != $cedula2) && (buscaRepetidoCedula($cedula,$mysqli)==1)) && (($correo != $correo2) && (buscaRepetidoCorreo($correo,$mysqli)== 0))){

        echo'<script type="text/javascript">
        alert("ERROR, La cédula que intenta ingresar ya existe, revise sus datos e intente nuevamente.");
        window.history.go(-1);
        </script>';
    
        }
        elseif((($cedula != $cedula2) && (buscaRepetidoCedula($cedula,$mysqli)==0)) && (($correo != $correo2) && (buscaRepetidoCorreo($correo,$mysqli)== 1))){

        echo'<script type="text/javascript">
        alert("ERROR, El correo que intenta ingresar ya existe, revise sus datos e intente nuevamente.");
        window.history.go(-1);
        </script>';

        }
        elseif((($cedula == $cedula2) && (buscaRepetidoCedula($cedula,$mysqli)==1)) && (($correo == $correo2) && (buscaRepetidoCorreo($correo,$mysqli)== 1))){
        
        //Valida si cambio la carrera del estudiante para borrar las asignaturas asignadas al estudiante
        if($carrera <> $carrera2){
          $sql2 = "DELETE FROM `asignatura_has_estudiantes` WHERE `estudiantes_id_estu` = $id; ";
          $resultado2 = mysqli_query($mysqli,$sql2);
        }else{}

        //Consulta para actualizar la base de datos mydb con la información del estudiante y su carrera
        $sql = "UPDATE estudiantes SET id_estu = '$id', nombre_estu ='$nombre', apellido_estu='$apellido', 
        tel_estu = '$tel', cel_estu = '$cel', cedula_estu ='$cedula', correo_estu='$correo', grupo ='$grupo', exoneracion ='$estado', carrera_idcarrera ='$carrera'    
        WHERE id_estu = '$id';";
        $resultado = mysqli_query($mysqli,$sql);

        echo'<script type="text/javascript">
        alert("!BIEN¡ Los datos del estudiante fueron actualizados correctamente");
        window.location.href="ver_estudiante.php";
        </script>';
            
        }
        elseif((($cedula == $cedula2) && (buscaRepetidoCedula($cedula,$mysqli)==1)) && (($correo != $correo2) && (buscaRepetidoCorreo($correo,$mysqli)== 0))){
        
          //Valida si cambio la carrera del estudiante para borrar las asignaturas asignadas al estudiante
        if($carrera <> $carrera2){
          $sql2 = "DELETE FROM `asignatura_has_estudiantes` WHERE `estudiantes_id_estu` = $id; ";
          $resultado2 = mysqli_query($mysqli,$sql2);
        }else{}

        //Consulta para actualizar la base de datos mydb con la información del estudiante y su carrera
        $sql = "UPDATE estudiantes SET id_estu = '$id', nombre_estu ='$nombre', apellido_estu='$apellido', 
        tel_estu = '$tel', cel_estu = '$cel', cedula_estu ='$cedula', correo_estu='$correo', grupo ='$grupo', exoneracion ='$estado', carrera_idcarrera ='$carrera'      
        WHERE id_estu = '$id'";

        $resultado = mysqli_query($mysqli,$sql);

        echo'<script type="text/javascript">
        alert("!BIEN¡ Los datos del estudiante fueron actualizados correctamente");
        window.location.href="ver_estudiante.php";
        </script>';
            
        }
        elseif((($cedula != $cedula2) && (buscaRepetidoCedula($cedula,$mysqli)==0)) && (($correo == $correo2) && (buscaRepetidoCorreo($correo,$mysqli)== 1))){
        //Valida si cambio la carrera del estudiante para borrar las asignaturas asignadas al estudiante
        if($carrera <> $carrera2){
          $sql2 = "DELETE FROM `asignatura_has_estudiantes` WHERE `estudiantes_id_estu` = $id; ";
          $resultado2 = mysqli_query($mysqli,$sql2);
        }else{}

        //Consulta para actualizar la base de datos mydb con la información del estudiante y su carrera
        $sql = "UPDATE estudiantes SET id_estu = '$id', nombre_estu ='$nombre', apellido_estu='$apellido', 
        tel_estu = '$tel', cel_estu = '$cel', cedula_estu ='$cedula', correo_estu='$correo', grupo ='$grupo', exoneracion ='$estado', carrera_idcarrera ='$carrera'  
        WHERE id_estu = '$id'";

        $resultado = mysqli_query($mysqli,$sql);

        echo'<script type="text/javascript">
        alert("!BIEN¡ Los datos del estudiante fueron actualizados correctamente.");
        window.location.href="ver_estudiante.php";
        </script>';
            
        }
        elseif((($cedula != $cedula2) && (buscaRepetidoCedula($cedula,$mysqli)==1)) && (($correo == $correo2) && (buscaRepetidoCorreo($correo,$mysqli)== 1))){

        echo'<script type="text/javascript">
        alert("ERROR, La cédula que intenta ingresar ya existe, revise sus datos e intente nuevamente.");
        window.history.go(-1);
        </script>';
                
        }
        elseif((($cedula == $cedula2) && (buscaRepetidoCedula($cedula,$mysqli)==1)) && (($correo != $correo2) && (buscaRepetidoCorreo($correo,$mysqli)== 1))){

        echo'<script type="text/javascript">
        alert("ERROR, El correo que intenta ingresar ya existe, revise sus datos e intente nuevamente.");
        window.history.go(-1);
        </script>';    
                
        }
        elseif((($cedula != $cedula2) && (buscaRepetidoCedula($cedula,$mysqli)==0)) && (($correo != $correo2) && (buscaRepetidoCorreo($correo,$mysqli)== 0))){
        //Valida si cambio la carrera del estudiante para borrar las asignaturas asignadas al estudiante
        if($carrera <> $carrera2){
          $sql2 = "DELETE FROM `asignatura_has_estudiantes` WHERE `estudiantes_id_estu` = $id; ";
          $resultado2 = mysqli_query($mysqli,$sql2);
        }else{}

        //Consulta para actualizar la base de datos mydb con la información del estudiante y su carrera
        $sql = "UPDATE estudiantes SET id_estu = '$id', nombre_estu ='$nombre', apellido_estu='$apellido', 
        tel_estu = '$tel', cel_estu = '$cel', cedula_estu ='$cedula', correo_estu='$correo', grupo ='$grupo', exoneracion ='$estado', carrera_idcarrera ='$carrera'   
        WHERE id_estu = '$id'";

        $resultado = mysqli_query($mysqli,$sql);

        echo'<script type="text/javascript">
        alert("!BIEN¡ Los datos del estudiante fueron actualizados correctamente.");
        window.location.href="ver_estudiante.php";
        </script>';
            
        }
        else {
            
        echo'<script type="text/javascript">
        alert("!ERROR¡ Ha habido un error al modificar sus datos, intente nuevamente.");
        window.location.href="ver_estudiante.php";
        </script>';

        }
}
else{
  header("Location:cerrar_session.php");
}
?>