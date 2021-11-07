<?php
require 'conexion.php';
session_start();

if(isset($_SESSION['administrador'])){ 
    $id = $_GET['id'];
    $sql = "SELECT * FROM usuario where id_user = '$id'";
    $resultado = $mysqli->query($sql);
    $row = $resultado->fetch_array(MYSQLI_ASSOC);
    require 'scripts.php';
?>
<html lang="es">
<head>
    <link rel="stylesheet" href="css/ver_carrera.css">
    <title>Modificar</title>
</head>
<body>
    <div class="jumbotron" >
      <h1 class="">MODIFIQUE SU REGISTRO</h1>
      <p>
       Si va editar el usuario debe editar la contraseña también. 
      </p>
    </div>
    <div class="container-fluid">
      <center>
        <form class="form-horizontal" action="actualizar_usuario.php" method="post">
          <div class="form-group">
            <!--Empieza el form -->
            <!--Aquí se ingresa nombre y apellido-->            
            <div class="col-sm-5">
              <label for="">Nombre</label>
              <input type="text" class="form-control"  value="<?php echo $row['nombre']; ?>" name="nombre" autofocus><br>
            </div>
            
            <div class="col-sm-5">
                <label for="">Apellido</label>
                <input type="text" class="form-control"  value="<?php echo $row['apellido']; ?>" name="apellido"><br>
            </div>
              <!-- Aquí se ingresará un usuario y contraseña -->
              
            <div class="col-sm-5">
              <label for="">Usuario</label>
              <input type="text" class="form-control"  value="<?php echo $row['usuario']; ?>" name="usuario" maxlength="15"><br>
            </div>
            
            <div class="col-sm-5" >
              <label for="">Contraseña</label>
              <input type="password" class="form-control" value="<?php echo $row['contrasena']; ?>" name="contra" maxlength="15" pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}" title="Por lo menos un número, una mayúscula, una minúscula y por lo menos 8 carácteres"><br>
            </div>                 
          </div>
          <div class="col-md-offset-8" style="margin-left:50px;margin-right:50px;">
            <a href="ver_usuario.php"><button style="" type="button" class="btn btn-default btn-block">      Atrás </button></a><br>
            <button type="submit" class="btn btn-primary btn-block" id="registrarNuevo" data-toggle="tooltip" data-placement="top" title="Presione para registrar el nuevo usuario">Actualizar Datos</button>
          </div> 
          <input type="hidden" id="id_user" name="id_user" value="<?php echo $row['id_user']; ?>" /> 
        </form>
      </center>
  </div>
</body>
</html>
<?php }
else{
  header("Location:cerrar_session.php");
}
?>