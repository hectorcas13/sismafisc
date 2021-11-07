<?php
  session_start();

  require 'conexion.php'; // Se incluye la conexión a la base de datos.
  include 'scripts.php'; // Se importa las funciones en javascript para que funcione la página.
  require 'funciones.php'; // Se importa las funciones que validan la entrada de información.
  error_reporting(0);
    if(isset($_SESSION['u_usuario'])){

      $errors = array();
      $success ="";

      //Esta consultas es para extraer datos para el usuario
      $user_activo = $_SESSION['u_usuario'];
      $query = "SELECT * FROM usuario where usuario = '$user_activo'";
      $resultado = $mysqli->query($query);
      
      //Esta consultas es para extraer datos de la carrera en el select de asignatura
      $query2 = "SELECT * FROM carrera order by nombre_carrera ASC";
      $resultado2 = $mysqli->query($query2);
      
      //Esta consulta llama a todos los profesores para ser elegidos a dictar un curso en la sección de asignatura
      $query4 = "SELECT * FROM profesor order by nom_prof, ape_prof ASC";
      $resultado4 = $mysqli->query($query4);

      if(!empty($_POST)){
      
        $asig = $mysqli->real_escape_string($_POST['nombre_asig']);
        $abre = $mysqli->real_escape_string(isset($_POST['abre']) ? $_POST['abre'] : null);
        $lab = $mysqli->real_escape_string($_POST['lab']);
        $codasig = $mysqli->real_escape_string($_POST['cod_asig']);
        $creditos = $mysqli->real_escape_string(isset($_POST['creditos']) ? $_POST['creditos'] : null);
        $carreraElegida = $mysqli->real_escape_string(isset($_POST['carrera_en_estudiante']) ? $_POST['carrera_en_estudiante']: null);
        $profesorElegido = isset($_POST['profesor_en_estudiante']) ? $_POST['profesor_en_estudiante']: null;
        $var_count = count($profesorElegido);
      
        if(isNull3($asig, $codasig, $creditos, $carreraElegida))
        {
          $errors[] = "Debe llenar los campos con la información";
        }
        // elseif(buscaRepetidoCodigoAsignatura($codasig,$mysqli)==1){
        //   $errors[] = "El código de asignatura $codasig ya existe, verifique sus datos.";
        // }
        else{
          //Consulta para Insertar datos a la base de datos mydb
          $insertar = "INSERT INTO asignatura(nombre_asig, abre_asig, lab, cod_asig, creditos, carrera_idcarrera) 
          VALUES ('$asig','$abre','$lab','$codasig','$creditos','$carreraElegida')";

          // Ejecuta la consulta
          $resultado = mysqli_query($mysqli,$insertar);
    
          if(!$resultado){
            echo'<script type="text/javascript">
            alert("¡ERROR! Hubo un error al insertar los datos");
            window.location.href="agregar_info_asignatura.php";
            </script>';;
          }else{

            if($var_count == 0){
              $success = "<div id='error' class='alert alert-success alert-dismissible' role='alert'>
              <a href='#' class='close' onclick=\"showHide('error');\" data-dismiss='alert' aria-label='close'>[X]</a>
              <p>! ASIGNATURA INSERTADA EXITOSAMENTE, PERO SIN LOS DATOS DEL PROFESOR!</p>
              </div>";
            }else{
              $success = "<div id='error' class='alert alert-success alert-dismissible' role='alert'>
              <a href='#' class='close' onclick=\"showHide('error');\" data-dismiss='alert' aria-label='close'>[X]</a>
              <p>! ASIGNATURA INSERTADA EXITOSAMENTE !</p>
              </div>";

              //Consulta para la tabla relacionada asignatura profesor
              $ultimoID=$mysqli->insert_id; // Recogemos el ID de la asignatura 
              foreach ($profesorElegido as $valor){
              $insertarTablaRel = "INSERT INTO `asignatura_has_profesor`(`asignatura_id_asig`, `profesor_id_profesor`) 
              VALUES ($ultimoID,$valor)";
              mysqli_query($mysqli,$insertarTablaRel);}
            }

          }
        }
      }
?>
<html lang="es">
<head>
    <title>Nueva Asignatura</title>
    <link rel="stylesheet" href="css/principal.css">
    <link rel="stylesheet" href="css/arreglos.css">
</head>
<body>
    <?php include 'navbar.php'; ?>
    <div class="jumbotron container-fluid" >
      <div class="col-lg-12 col-md-12 col-sm-12 ">
         <!-- breadcrum o miga de pan -->
        <h1 class="">NUEVA ASIGNATURA</h1>
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
        <li><a href="#">Nueva Asignatura</a></li>   
      </ol>
    </div>
    <div class="col-lg-12 col-md-12 col-sm-12 " style="margin-left:20px;margin-right:20px;">
      <!-- Forma de Asignatura, Aquí se insertará una nueva asignatura-->
      <div id="AgregarAsignatura" class="tab-pane fade in " >
        <form class="form-horizontal" action="agregar_info_asignatura.php#carrera_en_estudiante" method="post">
          <div class="form-group">
                <label class="control-label col-sm-4" for=""><span id="redd"> * </span><kbd>Asignatura</kbd></label>
            <div class="col-sm-5">
                <input type="text" maxlength="42" style="width:20em;text-align" class="form-control" placeholder="Nombre de la Asignatura" name="nombre_asig" >
            </div>
          </div>
          <div class="form-group">
                <label class="control-label col-sm-4" for="" ><kbd>Abre.</kbd></label>
              <div class="col-sm-5">          
                <input type="text" maxlength="5" size="5" style="width:20em;text-align" class="form-control"  placeholder="Abreviatura" name="abre">
              </div>
          </div>
          <div class="form-group">
                <label class="control-label col-sm-4" for="" ><span id="redd"> * </span><kbd>Laboratorio</kbd></label>
              <div class="col-sm-5">          
                <input type="text" maxlength="1" size="10" style="width:20em;text-align" class="form-control"  placeholder="# de laboratorio" name="lab">
              </div>
          </div>
          <div class="form-group">
              <label class="control-label col-sm-4" for="" ><span id="redd"> * </span><kbd>Código de Asignatura</kbd></label>
            <div class="col-sm-5">          
              <input type="text" maxlength="4" style="width:20em;text-align" size="4" class="form-control"  placeholder="Cód. asignatura" name="cod_asig">
            </div>
          </div>
          <div class="form-group">
                  <label class="control-label col-sm-4" for="" ><span id="redd"> * </span><kbd>Créditos</kbd></label>
                <div class="col-sm-5">          
                  <input type="number" maxlength="1" max="9" min="1" style="width:20em;text-align"  class="form-control" id="creditos" placeholder="Créditos" name="creditos" >
                </div>
          </div>
          <!-- Se elige la carrera a la que pertence la asignatura-->
          <div class="form-group">
              <label class="control-label col-sm-4" for="" ><span id="redd"> * </span><kbd>¿A qué carrera pertenece?</kbd></label>
            <div class="col-sm-5">
              <select id="carrera_en_estudiante" name="carrera_en_estudiante" class="input-sm" style="width:20em;text-align">
                <option value="0">Seleccione la carrera</option>
                <?php while($row2 = $resultado2->fetch_assoc()){?> 
                  <option value="<?php echo $row2['idcarrera']; ?>"><?php echo $row2['nombre_carrera']; ?></option>
                  <hr />
                <?php }?>
              </select>
            </div>
          </div>
          <br/>
          <!-- Se elige el o los profesores que dictarán dicha asignatura -->
          <div class="form-group">
              <label class="control-label col-sm-4" for="" ><span id="redd"> * </span><kbd>¿Qué profesores dictarán el curso?</kbd></label>
            <div class="col-sm-5">
              <select id="profesor_en_estudiante" name="profesor_en_estudiante[]" class="input-sm" multiple="multiple" size="16" onchange="marcar(this)" style="width:20em;text-align">
                  <option value="0" disabled="disabled">Seleccione al profesor</option>
                <?php while($row4 = $resultado4->fetch_assoc()){?> 
                  <option value="<?php echo $row4['id_profesor']; ?>"><?php echo $row4['nom_prof']." ".$row4['ape_prof']; ?></option>
                  <hr />
                  <?php }?>
              </select>
            </div>
          </div>
          <div style="text-align:center;">
            <a href="home.php"><button style="width:9em;" type="button" class="btn btn-default">Atrás</button></a>
            <button type="submit" class="btn btn-dark">Ingresar datos</button>
          </div>
        </form>
      </div>
    </div>
    <div class="col-lg-12 col-md-12 col-sm-12 "  style="text-align:center;">
      <?php 
        echo $success;
        echo resultBlock($errors);
      ?>
    </div>
    </div>
<?php include_once 'footer.php';?>
  <script>
    // Limitará a dos la cantidad de materias en un estudiantes que se introducen
    var ultimoValorValido = null;
    $("#var4_reporte1").on("change", function() {
      if ($("#var4_reporte1 option:checked").length > 2) {
        $("#var4_reporte1").val(ultimoValorValido);
        ultimoValorValido = $("#selectID").val([]);      
      }else {
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
