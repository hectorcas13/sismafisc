
<?php
include 'conexion.php';
include 'scripts.php';
include 'funciones.php';

session_start();
  if(isset($_SESSION['u_usuario'])){
        $errors = array();
        $success ="";
        //Esta consultas es para extraer datos para el usuario
        $user_activo = $_SESSION['u_usuario'];
        
        $query = "SELECT * FROM usuario where usuario = '$user_activo'";
        $resultado = $mysqli->query($query);

    if(!empty($_POST))
    {

      $nombre_de_la_carrera = $mysqli->real_escape_string($_POST['nombre_carrera']);
      $facultad_de_la_carrera = $mysqli->real_escape_string($_POST['varfacultad']);

      if(isNull2($nombre_de_la_carrera))
      {
        $errors[] = "Debe llenar el campo con la información";
      }
      else {
        //Consulta para Insertar datos a la base de datos dbsap
        $insertar = "INSERT INTO carrera(nombre_carrera,facultad_id) VALUES ('$nombre_de_la_carrera','$facultad_de_la_carrera')";
        // Ejecuta la consulta
        $resultado2 = mysqli_query($mysqli,$insertar);
        if(!$resultado2){

          $errors[] = "¡Hubo un error al ingresar los datos!";

        }
        else{

          $success = "<div id='error' class='alert alert-success alert-dismissible' role='alert'>
          <a href='#' class='close' onclick=\"showHide('error');\" data-dismiss='alert' aria-label='close'>[X]</a>
          <p>! CARRERA INSERTADA EXITOSAMENTE !</p>
          </div>";
        }
      }
    }
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Nueva carrera</title>
    <link rel="stylesheet" href="css/principal.css">
</head>
<body>
    <?php include 'navbar.php'; ?>
    <div class="jumbotron" >
      <div class="col-lg-12 col-md-12 col-sm-12 " style="margin-left:10px;margin-right:10px;">
        <!-- breadcrum o miga de pan -->
        <h1 class="">NUEVA CARRERA</h1>
        <p style="text-align:justify;">
          Elija una opción dependiendo de lo que necesite.
          Reporte pueden ser generados en <abbr title="Portable Document Format">PDF</abbr>
          <br />
          La <span id="redd"> * </span>significa que el dato debe ser ingresado.
        </p>
      </div>
    </div>
    <div class="container-fluid">               
        <ol class="breadcrumb">
          <li><a href="home.php">Inicio</a></li>
          <li><a href="#">Nueva Carrera</a></li>      
        </ol>
      </div>
    <hr>
    <div class="tab-content" >
    <div class="col-lg-12 col-md-12 col-sm-12 " style="margin-left:20px;margin-right:20px;">
      <!-- Forma de Carrera, Aquí se insertará una nueva Carrera-->
      <div id="AgregarCarrera" class="tab-pane fade in active">
          <form class="form-horizontal" action="agregar_info_carrera.php" method="post" id="" >
            <div class="form-group">
                <label class="control-label col-sm-4" for=""><span id="redd"> * </span><kbd>Agregar el <ins>nombre</ins> de la carrera</kbd></label>
              <div class="col-sm-5">
                <input type="text" style="width:20em" maxlength="100" size="100" class="form-control" autofocus placeholder="Nombre de la carrera" name="nombre_carrera" required>
              </div>
            </div>
            <div class="form-group">
                <label class="control-label col-sm-4" for=""><span id="redd"> * </span><kbd>Agregar la <ins>facultad</ins></kbd></label>
              <div class="col-sm-5">
                <select type="text" style="width:25em" id="varfacultad" class="input-sm" maxlength="100" class="form-control" placeholder="Facultad" name="varfacultad"  required></select>
              </div>
            </div>    
        <div class="col-lg-12 col-md-12 col-sm-12 "  style="text-align:center;">
          <div class="form-group"> 
            <a href="home.php"><button style="width:9em;" type="button" class="btn btn-default">      Atrás </button></a>
            <button type="submit" class="btn btn-dark">Ingresar Datos</button>
          </div>
        </div>
          </form>
      </div>
      <p>&nbsp;</p>
      <p>&nbsp;</p>
    </div>
    <div class="col-lg-12 col-md-12 col-sm-12 "  style="text-align:center;">
      <?php 
        echo $success;
        echo resultBlock($errors);
      ?>
    </div>
    </div>
    <p>&nbsp;</p>
      <p>&nbsp;</p>
      <p>&nbsp;</p>
      <p>&nbsp;</p>
      <p>&nbsp;</p>
      <?php include_once 'footer.php';?>
  <script>
  	// Limitará a dos la cantidad de materias en un estudiantes que se introducen
      var ultimoValorValido = null;
      $("#var4_reporte1").on("change", function() {
        if ($("#var4_reporte1 option:checked").length > 2) {
          $("#var4_reporte1").val(ultimoValorValido);
          ultimoValorValido = $("#selectID").val([]);      
        } else {
          ultimoValorValido = $("#var4_reporte1").val();
        }
    });


  </script>
  <script>
  $("[data-toggle=popover]")
  .popover({html:true})
  </script>
</body>
</html>

<?php 
//Cerrar conexión
mysqli_close($mysqli);
}
else{
  header("Location:cerrar_session.php");
}
?>
