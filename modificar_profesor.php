<?php
require 'conexion.php';
session_start();
if(isset($_SESSION['u_usuario'])){ 
        $id = $_GET['id'];
        $sql = "SELECT * FROM profesor where id_profesor = '$id'";
        $resultado = $mysqli->query($sql);
        $row = $resultado->fetch_array(MYSQLI_ASSOC);
        require 'scripts.php';
    ?>
<html lang="es">
<head>
    <link rel="stylesheet" href="css/ver_datos.css">
    <title>Modificar</title>
</head>
<body>
    <div class="jumbotron" >
      <h1 class="">MODIFIQUE LA TABLA PROFESORES</h1>
      <p>
       Edite los datos del profesor
      </p>
    </div>
    <div id="modificar_profesor" class="tab-pane fade in active" style="margin-left:20px;margin-right:20px;">
      <form class="form-horizontal" action="actualizar_profesor.php" method="post" autocomplete="off">
        <div class="form-group">
            <label class="control-label col-sm-4" for=""><kbd>Nombre</kbd></label>
          <div class="col-sm-5">
            <input type="text" maxlength="20" style="width:20em" class="form-control" autofocus id="" placeholder="Nombre" name="nprofesor" value="<?php echo $row['nom_prof']; ?>" >
          </div>
        </div>
        <div class="form-group">
            <label class="control-label col-sm-4" for=""><kbd>Apellido</kbd></label>
          <div class="col-sm-5">
              <input type="text" maxlength="20" style="width:20em" class="form-control" id="" value="<?php echo $row['ape_prof']; ?>" placeholder="Apellido" name="aprofesor" >
          </div>
        </div>
        <div class="form-group">
            <label class="control-label col-sm-4" for=""><kbd>Correo</kbd></label>
          <div class="col-sm-5">
              <input type="text" maxlength="100" style="width:20em" size="100" class="form-control" id="" placeholder="Correo" name="correoprofesor" value="<?php echo $row['correo_prof']; ?>" >
              <input type="hidden" value="<?php echo $row['ced_prof'] ;?>" name="cedula_original">
              <input type="hidden" value="<?php echo $row['correo_prof'] ;?>" name="correo_original">
          </div>
        </div>
        <div class="form-group" id="botones">        
            <div class="">
            <a href="ver_profesor.php"><button style="width:9em;" type="button" class="btn btn-default">      Atrás </button></a>
            <button type="submit" class="btn btn-dark">Actualizar datos</button>
            </div>
        </div>
          <input type="hidden" id="id_profesor" name="id_profesor" value="<?php echo $row['id_profesor']; ?>" />
      </form>
    </div>
</body>
<br><br><br><br>
<?php include_once 'footer.php';  ?>
</html>
<?php }
else{
  header("Location:cerrar_session.php");
}
?>