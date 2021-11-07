
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

      $nombre_de_la_facultad = $mysqli->real_escape_string($_POST['facultad']);

      if(isNull2($nombre_de_la_facultad))
      {
        $errors[] = "Debe llenar el campo con la información";
      }
      else {
        //Consulta para Insertar datos a la base de datos dbsap
        $insertar = "INSERT INTO facultad(facultad) VALUES ('$nombre_de_la_facultad')";
        // Ejecuta la consulta
        $resultado2 = mysqli_query($mysqli,$insertar);
        if(!$resultado2){

          $errors[] = "¡Hubo un error al ingresar los datos!";

        }
        else{

          $success = "<div id='error' class='alert alert-success alert-dismissible' role='alert'>
          <a href='#' class='close' onclick=\"showHide('error');\" data-dismiss='alert' aria-label='close'>[X]</a>
          <p>! FACULTAD INSERTADA EXITOSAMENTE !</p>
          </div>";
        }
      }
    }
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Nueva Facultad</title>
    <link rel="stylesheet" href="css/principal.css">
</head>
<body>
    <?php include 'navbar.php'; ?>
    <div class="jumbotron container-fluid" >
      <div class="col-lg-12 col-md-12 col-sm-3">
        <!-- breadcrum o miga de pan -->
        <h1 class="">NUEVA FACULTAD</h1>
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
          <li><a href="#">Nueva Facultad</a></li>      
        </ol>
      </div>
    <hr>
    <div class="col-lg-12 col-md-12 col-sm-12 " style="margin-left:20px;margin-right:20px;">
      <div class="tab-content" >
        <!-- Forma de Carrera, Aquí se insertará una nueva Carrera-->
        <div id="AgregarFacultad" class="tab-pane fade in active">
            <form class="form-horizontal" action="agregar_info_facultad.php" method="post" id="" >
              <div class="form-group">
                  <label class="control-label col-sm-4" for=""><span id="redd"> * </span><kbd>Agregar el <ins>nombre</ins> de la facultad</kbd></label>
                <div class="col-sm-5">
                  <input type="text" style="width:20em;text-align:center;" maxlength="100" size="100" class="form-control"  placeholder="Nombre de la facultad" name="facultad" autofocus required>
                </div>
              </div>
              <div class="col-lg-12 col-md-12 col-sm-12 "  style="text-align:center;">
                  <a href="home.php"><button style="width:9em;" type="button" class="btn btn-default">      Atrás </button></a>
                  <button type="submit" class="btn btn-dark">Ingresar Datos</button>
              </div>
            </form>
        </div>
        <p>&nbsp;</p>
        <p>&nbsp;</p>
        <center>
          <?php 
            echo $success;
            echo resultBlock($errors);
          ?>
        </center>
      </div>
    </div>
    <p>&nbsp;</p>
    <p>&nbsp;</p>
    <p>&nbsp;</p>
    <p>&nbsp;</p>
    <p>&nbsp;</p>

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
  <?php include_once 'footer.php';?>
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
