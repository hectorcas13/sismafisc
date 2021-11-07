<?php
require 'conexion.php';
require 'scripts.php';
session_start();
  if(isset($_SESSION['u_usuario'])){ 
          $id = $_GET['id'];
          $sql = "SELECT * FROM asignatura where id_asig = '$id'";
          $resultado = $mysqli->query($sql);
          $row = $resultado->fetch_array(MYSQLI_ASSOC);
?>
<html lang="es">
<head>
        <link rel="stylesheet" href="css/ver_datos.css">
        <link rel="stylesheet" href="css/arreglos.css">
        <title>Maestrías de sistemas</title>
</head>
<body>
    <div class="jumbotron" >
      <h1 class="">MODIFIQUE SU REGISTRO</h1>
      <p>
       Edite las asignaturas
      </p>
    </div>
    <div id="modificar_asignatura" class="tab-pane fade in active ">
      <form class="form-horizontal" action="actualizar_asignatura.php" method="post" autocomplete="off">
        <div class="form-group">
              <label class="control-label col-sm-4" for=""><kbd>Asignatura</kbd></label>
          <div class="col-sm-5">
              <input type="text" maxlength="42" style="width:20em" class="form-control" autofocus id="nombre_asig" value="<?php echo $row['nombre_asig']; ?>" name="nombre_asig" required>
          </div>
        </div>
        <div class="form-group">
              <label class="control-label col-sm-4" for="" ><kbd>Abre.</kbd></label>
            <div class="col-sm-5">          
              <input type="text" maxlength="5" size="5" style="width:20em" class="form-control" id="abre_asig"  name="abre_asig" value="<?php echo strtoupper($row['abre_asig']); ?>">
            </div>
        </div>
        <div class="form-group">
              <label class="control-label col-sm-4" for="" ><span id="redd"> * </span><kbd>Laboratorio</kbd></label>
            <div class="col-sm-5">          
              <input type="number" maxlength="1" size="10" max="9" min="0" style="width:8em" class="form-control"  value="<?php echo $row['lab']; ?>" name="lab">
            </div>
        </div>
        <div class="form-group">
                <label class="control-label col-sm-4" for="" ><kbd>Código de Asignatura</kbd></label>
              <div class="col-sm-5">          
                <input type="text" maxlength="4" size="4" style="width:20em" class="form-control" id="cod_asig" value="<?php echo strtoupper($row['cod_asig']); ?>" name="cod_asig" required>
                <input type="hidden" value="<?php echo $row['cod_asig'] ;?>" name="codigo_original">
              </div>
        </div>
        <div class="form-group">
                <label class="control-label col-sm-4" for="" ><kbd>Créditos</kbd></label>
              <div class="col-sm-5">          
                <input type="number" style="width:20em" maxlength="1" max="9" min="1" value="<?php echo $row['creditos']; ?>"  class="form-control" id="creditos"  name="creditos" required>
              </div>
        </div>
        <div class="form-group" id="botones">        
          <div class="">
            <a href="ver_asignatura.php"><button style="width:9em;" type="button" class="btn btn-default">      Atrás </button></a>
            <button type="submit" class="btn btn-dark">Actualizar datos</button>
          </div>
        </div>
            <input type="hidden" id="id_asig" name="id_asig" value="<?php echo $row['id_asig']; ?>" />
      </form>
    </div>
</body>
<br><br><br><br><br><br>
<?php include_once 'footer.php';  ?>
</html>
<?php }
  else{
    header("Location:cerrar_session.php");
}
?>