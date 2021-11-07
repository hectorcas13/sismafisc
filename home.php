<?php

session_start();

if(isset($_SESSION['u_usuario'])){ 
  require_once 'scripts.php'; // Este importa los scripts de la página scripts.php
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <title>Página Principal</title>
    <link rel="stylesheet" href="css/principal.css">
    <?php include 'navbar.php'; ?>
</head>
<body>
<div class="col-sm-12 col-md-6 col-lg-12">             
  <ol class="breadcrumb">
    <li><a href="home.php">Inicio</a></li> 
  </ol> 
  <div id="texto">
    <br>  
    <h2><b>¿Escoja una opción?</b></h2>
  </div>
  <div class="row" style="">
    <div class="col-sm-12 col-md-4 col-lg-4 col-xs-12" style="text-align: center;">
      <a href="#" data-toggle="popover" title="<center>Agregar registros</center>" data-content="
          <div>
            <a  href='agregar_info_asignatura.php'>Agregar una nueva asignatura</a><hr>
            <a  href='agregar_info_carrera.php'>Agregar una carrera nueva</a><hr>
            <a  href='agregar_info_estudiante.php'>Agregar un estudiante al sistema</a><hr>
            <a  href='agregar_info_profesor.php'>Agregar un profesor nuevo</a><hr />
            <a  href='agregar_info_facultad.php'>Agregar una nueva facultad</a><br />
          </div>" 
        data-placement="top" data-trigger="focus">
        <img src="img/nuevo-registro.png" alt="" id="sizereporte">
      </a>
    </div>  
    <div class="col-sm-12 col-md-4 col-lg-4 col-xs-12" style="text-align: center;">
      <a href="#" data-toggle="popover" title="<center>Lista de opciones</center>" data-content="
          <div>
            <a  href='ver_asignatura.php'>Lista de asignaturas</a><hr>
            <a  href='ver_carrera.php'>Lista de carreras</a><hr>
            <a  href='ver_estudiante.php'>Lista de estudiantes de maestrías</a><hr>
            <a  href='ver_profesor.php'>Lista Profesores de maestrías de la UTP</a><hr />
            <a  href='ver_facultad.php'>Facultades de la UTP</a><br />
          </div>" 
        data-placement="top" data-trigger="focus">
        <img src="img/icono-busqueda.png" alt="" id="sizereporte">
      </a>
    </div>
    <div class="col-sm-12 col-md-4 col-lg-4 col-xs-12" style="text-align: center;">
      <a href="#" data-toggle="popover" title="<center>Lista de reportes</center>" data-content="
          <div>
            <a  href='reporteA.php'>Calendario de Pago</a><hr>
            <a  href='reporteB.php'>Lista de Estudiantes</a><hr>
            <a href='reporteC.php'>Horario de Clases</a><hr>
            <a  href='reporteD.php'>Cuadro de Ingresos y Egresos</a><br />
          </div>" 
        data-placement="top" data-trigger="focus">
        <img src="img/reportes.png" alt="" id="sizereporte">
      </a>
    </div>
  </div>
</div>

</body>
<?php   require 'footer.php';  ?>
<script>
    $("[data-toggle=popover]")
    .popover({html:true})
</script>
</html>
<?php }
else{
  header("Location:cerrar_session.php");
}
?>
