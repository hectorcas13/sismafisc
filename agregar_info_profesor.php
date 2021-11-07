
<?php
  session_start();
        
  require 'conexion.php'; // Se incluye la conexión a la base de datos.
  include 'scripts.php'; // Se importa las funciones en javascript para que funcione la página.
  require 'funciones.php'; // Se importa las funciones que validan la entrada de información.

    if(isset($_SESSION['u_usuario'])){
      $errors = array();
      $success ="";
      //Esta consultas es para extraer datos para el usuario
      $user_activo = $_SESSION['u_usuario'];
      $query = "SELECT * FROM usuario where usuario = '$user_activo'";
      $resultado = $mysqli->query($query);   
      
      if(!empty($_POST))
      {
        //Recibe los datos de profesores
        $nom_profesor = $_POST['nom_prof'];
        $ape_profesor = $_POST['ape_prof'];
        $correo_profesor = $_POST['correo_prof'];

        if(isNullprof($nom_profesor, $ape_profesor, $correo_profesor))
        {
          $errors[] = "Debe llenar el campo con la información";
        }
        elseif(buscaRepetidoCorreoProf($correo_profesor,$mysqli)==1){
          $errors[] = "El correo $correo_profesor está repetido ";
        }
        elseif(!isEmail($correo_profesor)){
          $errors[] = "$correo_profesor no es un correo válido.";
        }
        else {
          //Consulta para Insertar datos a la base de datos dbsap
          $insertar = "INSERT INTO profesor(nom_prof, ape_prof, correo_prof) 
          VALUES ('$nom_profesor','$ape_profesor','$correo_profesor')";
          // Ejecuta la consulta
          $resultado2 = mysqli_query($mysqli,$insertar);

          if(!$resultado2){

            $errors[] = "¡Hubo un error al ingresar los datos!";

          }
          else{

            $success = "<div id='error' class='alert alert-success alert-dismissible' role='alert'>
            <a href='#' class='close' onclick=\"showHide('error');\" data-dismiss='alert' aria-label='close'>[X]</a>
            <p>! EL PROFESOR FUE AGREGADO EXITOSAMENTE !</p>
            </div>";
          }
        }
      }

?>
<html lang="es">
<head>
    <title>Nuevo Profesor</title>
    <link rel="stylesheet" href="css/principal.css">
</head>
<body>
    <?php include 'navbar.php'; ?>
    <div class="jumbotron container-fluid" >
      <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12" >
        <!-- breadcrum o miga de pan -->
        <h1 class="">NUEVO PROFESOR</h1>
        <p style="text-align:justify;">
          Elija una opción dependiendo de lo que necesite.
          Reporte pueden ser generados en <abbr title="Portable Document Format">PDF</abbr>
          <br />
          La <span id="redd"> * </span>significa que el dato debe ser ingresado.
        </p>
      </div>
    </div>
    <div class="container-fluid col-lg-12 col-md-12 col-sm-12 col-xs-12" > 
      <ol class="breadcrumb">
        <li><a href="home.php">Inicio</a></li>
        <li><a href="#">Nuevo profesor</a></li>    
      </ol>
    </div>
  <div class="container-fluid col-lg-12 col-md-12 col-sm-12 col-xs-12" style="margin-left:20px;margin-right:20px;">
    <div class="tab-content"  >
      <div id="AgregarProfesor" class="tab-pane fade in active" >
        <form class="form-horizontal" action="agregar_info_profesor.php#nom_prof" method="post" >
            <div class="form-group">
                <label class="control-label col-sm-4" for=""><span id="redd"> * </span><kbd>Agregar <ins>nombre</ins> del profesor</kbd></label>
              <div class="col-sm-5">
                <input type="text" maxlength="20" style="width:15em;" class="form-control" autofocus  placeholder="Nombre" name="nom_prof" id="nom_prof" required >
              </div>
            </div>
            <div class="form-group">
                <label class="control-label col-sm-4" for=""><span id="redd"> * </span><kbd>Agregar <ins>apellido</ins> del profesor</kbd></label>
              <div class="col-sm-5">
                  <input type="text" maxlength="20" style="width:15em;" class="form-control" placeholder="Apellido" name="ape_prof" required >
              </div>
            </div>
            <div class="form-group">
                <label class="control-label col-sm-4" for=""><span id="redd"> * </span><kbd>Agregar correo del profesor</kbd></label>
              <div class="col-sm-5">
                  <input type="email" maxlength="30" size="100" class="form-control" style="width:15em;" placeholder="Correo" name="correo_prof" required>
              </div>
            </div>
            <!-- Usuario_id_user -->
              <select name="user_activo" id="user_activo" class="hidden" class="form-group">
                <?php while($row = $resultado->fetch_assoc()){?>
                  <option value="<?php echo $row['id_user']; ?>"><?php echo $row['nombre'].' '.$row['apellido']; ?></option>
                <?php }?>
              </select>
            <div>        
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12"  style="text-align:center;">
                <a href="home.php"><button style="width:9em;" type="button" class="btn btn-default">Atrás</button></a>
                <button type="submit" class="btn btn-dark">Ingresar Datos</button>
              </div>
            </div>
        </form>
      </div>
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

    <p>&nbsp;</p>
    <p>&nbsp;</p>
    <p>&nbsp;</p>
    <p>&nbsp;</p>
    
  <script>
  
  	// Limitará a dos la cantidad de materias en un estudiantes
	  // que se introducen
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
