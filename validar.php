<?php

session_start();
include 'scripts.php';

//conectar a la base de datos
require "conexion.php";
//Recibe los datos desde main.html para conectarse al servicio web
$usuario=mysqli_real_escape_string($mysqli,$_POST['usr']);
$password=mysqli_real_escape_string($mysqli,$_POST['pwd']);
$consulta="SELECT * FROM usuario where usuario='$usuario' and contrasena='$password'";

$resultado=mysqli_query($mysqli,$consulta);
$filas=mysqli_num_rows($resultado);

    if($usuario =="administrador" and $password =="12345Contra&"){
        $_SESSION['administrador'] = $usuario;
        header("location:main2.php");
    }
    elseif($filas > 0){
        $_SESSION['u_usuario'] = $usuario;
        header("location:home.php");
    }
    elseif($filas <= 0){
        echo '<script type="text/javascript">
        alert("¡ERROR! Contraseña Incorrecta");
        window.history.go(-1);
        </script>';
    }
    else{
        echo 'error';
    }
    
mysqli_set_charset($mysqli,"utf8");
mysqli_free_result($resultado);
mysqli_close($mysqli);

?>


