
<?php
  require 'conexion.php'; // Se incluye la conexión a la base de datos.
  include 'scripts.php'; // Se importa las funciones en javascript para que funcione la página.
  include_once 'funciones.php'; // Se importa las funciones que validan la entrada de información.
  error_reporting(0); //evitamos que envie un error por el contador de $var_count cuando este esté vacío.
  session_start();
    if(isset($_SESSION['u_usuario'])){

    $errors = array();
    $success ="";
    $warning ="";
    
    //Esta consultas es para extraer datos para el usuario
    $user_activo = $_SESSION['u_usuario'];
    $query = "SELECT * FROM usuario where usuario = '$user_activo'";
    $resultado = $mysqli->query($query);
    
    //Esta consultas es para extraer datos para el usuario en la sección de estudiantes
    $query3 = "SELECT * FROM usuario where usuario = '$user_activo'";
    $resultado3 = $mysqli->query($query3);

    //Esta consultas es para extraer datos de la carrera en el select de asignatura
    $query2 = "SELECT * FROM carrera order by nombre_carrera ASC";
    $resultado2 = $mysqli->query($query2);
    
    //Esta consulta llama a todos los profesores para ser elegidos a dictar un curso en la sección de asignatura
    $query4 = "SELECT * FROM profesor order by nom_prof, ape_prof ASC";
    $resultado4 = $mysqli->query($query4);

    if(!empty($_POST)){
      //Recibe los datos de estudiantes
      $nom = $mysqli->real_escape_string($_POST['nombre_estu']);
      $ape = $mysqli->real_escape_string($_POST['apellido_estu']);
      $ced = $mysqli->real_escape_string($_POST['cedula_estu']);
      $tel = $mysqli->real_escape_string(isset($_POST['tel_estu']) ? $_POST['tel_estu'] : null);
      $cel = $mysqli->real_escape_string($_POST['cel_estu']);
      $correo = $mysqli->real_escape_string($_POST['correo_estu']);
      $carrera = $mysqli->real_escape_string($_POST['var1_reporte1']);
      $asignatura = isset($_POST['var4_reporte1']) ? $_POST['var4_reporte1'] : null;
      $grupo = $mysqli->real_escape_string($_POST['grupo']);
      $estado = $mysqli->real_escape_string($_POST['estado']);
      $var_count = count($asignatura);

      if($var_count > 2){
        $errors[] = "El estudiante no puede estar asignado a mas de dos asignaturas.";
      }
      // elseif(isNull5($nom, $ape, $estado, $cel, $correo, $carrera)){
      //   $errors[] = "Debe llenar los campos con la información.";
      // }
      elseif($var_count == 0){
        $errors[] = "Asigne las materias que cursará el estudiante, no puede escoger la carrera sin las materias.";
      }
      elseif(buscaRepetidoCedula($ced,$mysqli)==1 ){
        $errors[] = "La cédula $ced ya existe.";
      }
      elseif (buscaRepetidoCorreo($correo,$mysqli)==1) {
        $errors[] = "El correo $correo ya existe.";
      }
      elseif(!isEmail($correo)){
        $errors[] = "$correo no es un correo válido.";
      }
      else{

        //Consulta para Insertar datos a la base de datos 
        $insertar = "INSERT INTO estudiantes(nombre_estu, apellido_estu, cedula_estu, tel_estu, cel_estu, correo_estu, grupo, exoneracion, carrera_idcarrera) 
        VALUES ('$nom','$ape','$ced','$tel','$cel', '$correo', '$grupo','$estado','$carrera')";
        // Ejecuta la consulta
        $resultado = mysqli_query($mysqli,$insertar);

        if(!$resultado){

          echo'<script type="text/javascript">
          alert("ERROR!</strong> Ha habido un error al momento de insertar los registros.");
          window.location.href="agregar_info_estudiante.php";
          </script>';

        }
        else{
          
          $ultimoID=$mysqli->insert_id;
          if(AsignaturaAsignadaAEstudiante($ultimoID,$mysqli)==1){
            $errors[] = "Ya existe un estudiante con dos asignaturas asignadas, revise sus datos.";
          }
          else{

            //Insertamos datos en la tabla asignatura_has_estudiantes para que funciones los Selects.
            //$ultimoID guarda el id del estudiante que se introduce en la consulta anterior y lo inserta
            // junto con el ID de la asignatura elegida
            foreach ($asignatura as $valor){
            $insertarTablaRel = "INSERT INTO `asignatura_has_estudiantes`(asignatura_id_asig, estudiantes_id_estu) 
            VALUES ($valor,$ultimoID)";
            $resultado2= mysqli_query($mysqli,$insertarTablaRel);
            }
        
            if(!$resultado2){            

                $warning = "<div id='error' class='alert alert-warning alert-dismissible' role='alert'>
                <a href='#' class='close' onclick=\"showHide('error');\" data-dismiss='alert' aria-label='close'>[X]</a>
                <p>! Error al introducir datos a la tabla relacionada, pero estudiante insertado correctamente !</p>
                </div>";
            }
            else{
                $success = "<div id='error' class='alert alert-success alert-dismissible' role='alert'>
                <a href='#' class='close' onclick=\"showHide('error');\" data-dismiss='alert' aria-label='close'>[X]</a>
                <p>! ESTUDIANTE AGREGADO EXITOSAMENTE !</p>
                </div>";
            }
          }
        }
      }
    }
      
?>
<html lang="es">
<head>
    <title>Agregar datos</title>
    <link rel="stylesheet" href="css/principal.css">
    <link rel="stylesheet" href="css/arreglos.css">
</head>
<body>
    <?php include 'navbar.php'; ?>
    <div class="jumbotron" >
      <div class="col-lg-12 col-md-12 col-sm-12 " style="margin-left:10px;margin-right:10px;">
        <!-- breadcrum o miga de pan -->
        <h1 class="">NUEVO ESTUDIANTE</h1>
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
          <li><a href="#">Nuevo Estudiante</a></li>      
        </ol>
    </div>
    <div class="col-lg-12 col-md-12 col-sm-12 " style="margin-left:20px;margin-right:20px;">
      <!-- Forma de Estudiante, Aquí se insertará una nueva Estudiante-->
      <div id="AgregarEstudiante" class="tab-pane fade in active">
          <form class="form-horizontal" action="agregar_info_estudiante.php#xcarrera" method="post">
          <div class="form-group">
          <label class="control-label col-sm-4" for=""><span id="redd"> * </span><kbd>Agregar <ins>nombre</ins> del estudiante</kbd></label>
              <div class="col-sm-5">
                <input type="text" maxlength="20" style="width:20em" class="form-control" id="nombre_estu"  name="nombre_estu" placeholder="Nombre del estudiante" size="10" required>
              </div>
            </div>
            <div class="form-group">
                <label class="control-label col-sm-4" for=""><span id="redd"> * </span><kbd>Agregar <ins>apellido</ins> de estudiante</kbd></label>
              <div class="col-sm-5">
                  <input type="text" maxlength="20" style="width:20em" class="form-control" id="apellido_estu" name="apellido_estu" placeholder="Apellido del estudiante" required>
              </div>
            </div>
            <div class="form-group">
                <label class="control-label col-sm-4" for=""><span id="redd"> * </span><kbd>Agregar la cédula</kbd></label>
              <div class="col-sm-5">
                  <input type="text" maxlength="20" size="20 " style="width:20em" class="form-control" id="cedula_estu" name="cedula_estu" placeholder="Cédula (Con Guiones)" required>
              </div>
            </div>
            <div class="form-group">
                <label class="control-label col-sm-4" for="" ><kbd>Teléfono</kbd></label>
              <div class="col-sm-5">          
                <input type="tel" maxlength="20" class="form-control" id="tel_estu" name="tel_estu" style="width:20em" placeholder="Teléfono (Sin Guiones)" pattern=".{7,7}" title="Ingresa solo 7 números y sin guiones">
              </div>
            </div>
            <div class="form-group">
                <label class="control-label col-sm-4" for="" ><span id="redd"> * </span><kbd>Celular</kbd></label>
              <div class="col-sm-5">          
                <input type="tel" maxlength="20" class="form-control" id="cel_estu" name="cel_estu" style="width:20em" placeholder="Celular (Sin Guiones)" name="cel_estu" pattern=".{8,8}" title="Ingresa solo 8 números y sin guiones" required>
              </div>
            </div>
            <div class="form-group">
              <label class="control-label col-sm-4" for="" ><span id="redd"> * </span><kbd>Correo</kbd></label>
            <div class="col-sm-5">          
              <input type="email" maxlength="50" class="form-control" id="correo_estu" placeholder="Correo" name="correo_estu" style="width:20em" pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,3}$" required>
            </div>
            </div>
            <div class="form-group">
              <label class="control-label col-sm-4" for="" ><span id="redd"> * </span><kbd>Grupo</kbd></label>
            <div class="col-sm-5">          
              <input type="number" maxlength="1" max="9" min="1" class="form-control" id="grupo" placeholder="Grupo" name="grupo" style="width:20em"  required>
            </div>
            </div>
            <!-- Agregar si esta exonerado -->
            <div class="form-group" required>
                  <label class="control-label col-sm-4" for="" ><span id="redd"> * </span><kbd>Exoneración</kbd></label>
                <div class="col-sm-5">
                <label class="container">
                    <input type="radio" name="estado" id="estado" value="1" checked="checked"> No Exonerado
                    <span class="checkmark"></span>
                  </label>
                  <label class="container">
                    <input type="radio" name="estado" id="estado" value="3" > Exonerado 25%<br>
                    <span class="checkmark"></span>
                  </label>
                  <label class="container">
                    <input type="radio" name="estado" id="estado" value="2"> Exonerado 50%
                    <span class="checkmark"></span>
                  </label>
                </div>
            </div>
            <!-- Se elige la facultad del estudiante-->
            <div class="form-group" id="xcarrera">
              <label class="control-label col-sm-4" for="" ><span id="redd"> * </span><kbd>¿A qué facultad pertenece?</kbd></label>
              <div class="col-sm-5">
                <select name="varfacultad" id="varfacultad" class="input-sm" style="width:25em" required> </select>
              </div>
            </div>
            <!-- Se elige la carrera del estudiante-->
            <div class="form-group" id="xcarrera">
                <label class="control-label col-sm-4" for="" ><span id="redd"> * </span><kbd>¿A qué carrera pertenece?</kbd></label>
                <div class="col-sm-5">          
                  <select  id="var1_reporte1" name="var1_reporte1" class="input-sm" style="width:25em" required ></select>
                </div>
            </div>
            <!-- Se elige la asignatura del estudiante-->
            <div class="form-group">
                <label class="control-label col-sm-4" for="" ><span id="redd"> * </span><kbd>Asignatura</kbd></label>
              <div class="col-sm-5">          
                <select name="var4_reporte1[]" id="var4_reporte1" class="input-sm" multiple="multiple" size="10" onchange="marcar(this)" style="width:25em" required> </select>
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
    </div>
    <div class="col-lg-12 col-md-12 col-sm-12 "  style="text-align:center;">
        <?php 
          echo $success;
          echo $warning;
          echo resultBlock($errors);
        ?>
    </div>
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
