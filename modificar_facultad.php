
<?php
require 'conexion.php';
session_start();
    if(isset($_SESSION['u_usuario'])){ 
            $id = $_GET['id'];
            $sql = "SELECT * FROM facultad where id = '$id'";
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
    <div id="modificar_facultad" class="tab-pane fade in active" style="margin-right:20px;margin-left:20px;">
        <form class="form-horizontal" method="POST" action="actualizar_facultad.php" autocomplete="off">
            <div class="form-group">
                    <label class="control-label col-sm-4" for=""><kbd>Agregar el <ins>nombre</ins> de la carrera</kbd></label>
                <div class="col-sm-5" style="text-align:center;">
                    <input type="text" maxlength="100" size="100" style="width:20em" class="form-control" id="facultad"  value="<?php echo $row['facultad']; ?>" name="facultad" autofocus required>
                </div>
            </div>
            <div class="form-group" id="botones" >        
                <div>
                    <a href="ver_facultad.php"><button style="width:9em;" type="button" class="btn btn-default">Atrás</button></a>
                    <button type="submit" class="btn btn-dark">Actualizar datos</button>
                </div>
            </div>      
            <div class="form-group">  
                <input type="hidden" id="id_facultad" name="id_facultad" value="<?php echo $row['id']; ?>" />
            </div>
        </form>
    </div>
    <br><br><br><br><br><br>
</body>
<?php include_once 'footer.php';  ?>
</html>
<?php }
else{
  header("Location:cerrar_session.php");
}
?>