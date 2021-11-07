<?php
require 'conexion.php';
require 'scripts.php';
include_once 'funciones.php';
setlocale(LC_TIME, 'es_ES'); //convierte las fechas a español
session_start();
if(isset($_SESSION['u_usuario'])){ 
        $id = $_GET['id'];
        $sql = "SELECT * from settingdate where id = '$id';";

        $resultado = $mysqli->query($sql);
        $row = $resultado->fetch_array(MYSQLI_ASSOC);
?>
<html lang="es">
<head>
    <link rel="stylesheet" href="css/ver_datos.css">
    <link rel="stylesheet" href="css/arreglos.css">
    <title>Modifique Estudiante</title>
</head>
<body>
    <div class="jumbotron" >
      <h1 class="">MODIFIQUE SU REGISTRO</h1>
      <p>
       EDITE LOS DATOS DEL CALENDARIO DE PAGO
      </p>
    </div>
    <div id="AgregarCalendario" >
      <form class="form-horizontal" action="actualizar_calendario.php" method="post" id="" accept-charset="ISO-8859-1">
        <div class="form-group">
            <label class="control-label col-sm-4" for=""><kbd>Modifique la <ins>fecha</ins> de inicio</kbd></label>
          <div class="col-sm-5">
            <input type="date" style="width:20em" maxlength="20" class="form-control" autofocus id="fa" name="fa" value="<?php echo $row['fa'];?>"  required>
          </div>
        </div>
        <div class="form-group">
            <label class="control-label col-sm-4" for=""><kbd>Modifique la <ins>fecha</ins> de finalizar</kbd></label>
          <div class="col-sm-5">
              <input type="date" maxlength="20" style="width:20em" class="form-control" id="fb" name="fb" value="<?php echo $row['fb'];?>" required>
          </div>
        </div>
        <div class="form-group" id="botones" >        
          <div>
            <input type="hidden" id="idcal" name="idcal" value="<?php echo $row['id']; ?>" />
            <a href="edicion.php#cal"><button style="width:9em;" type="button" class="btn btn-default">      Atrás </button></a>
            <button type="submit" class="btn btn-dark">Actualizar datos</button>
          </div>
        </div>
      </form>
    </div>
    <script src="js/function.js"></script>

</body>
</html>
<?php }
  else{
    header("Location:cerrar_session.php");
  }
?>