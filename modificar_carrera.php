
<?php
require 'conexion.php';
session_start();
    if(isset($_SESSION['u_usuario'])){ 
            $id = $_GET['id'];
            $sql = "SELECT * FROM carrera where idcarrera = '$id'";
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
      <h1 class="">MODIFIQUE SU REGISTRO</h1>
      <p>
       Edite los datos de la carrera
      </p>
    </div>
    <div id="modificar_carrera" class="tab-pane fade in active " style="margin-right:20px;margin-left:20px;">
        <form class="form-horizontal" method="POST" action="actualizar_carrera.php" autocomplete="off">
            <div class="form-group">
                    <label class="control-label col-sm-4" for=""><kbd>Agregar el <ins>nombre</ins> de la carrera</kbd></label>
                <div class="col-sm-5">
                    <input type="text" maxlength="100" size="100" style="width:20em" class="form-control" id="nombre_carrera"  value="<?php echo $row['nombre_carrera']; ?>" name="nombre_carrera" autofocus required>
                </div>
            </div>
            <div class="form-group">
                <label class="control-label col-sm-4" for=""><span id="redd"> * </span><kbd>Agregar la <ins>facultad</ins></kbd></label>
              <div class="col-sm-5">
                <select type="text" style="width:20em" id="varfacultad" class="input-sm" maxlength="100" class="form-control" placeholder="Facultad" name="varfacultad"  required></select>
              </div>
            </div>
            <div class="form-group" id="botones" >        
                <div>
                    <a href="ver_carrera.php"><button style="width:9em;" type="button" class="btn btn-default">Atrás</button></a>
                    <button type="submit" class="btn btn-dark">Actualizar datos</button>
                </div>
            </div>      
            <div class="form-group">  
                <input type="hidden" id="idcarrera" name="idcarrera" value="<?php echo $row['idcarrera']; ?>" />
            </div>
        </form>
    </div>
</body>
<br><br><br>
<?php include_once 'footer.php';  ?>
</html>
<?php }
else{
  header("Location:cerrar_session.php");
}
?>