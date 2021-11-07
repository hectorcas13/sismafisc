<?php

  include_once 'scripts.php';
  include_once 'conexion.php';
  require 'funciones.php';
  session_start();
  if(isset($_SESSION['administrador'])){ 

    $errors = array();
    $success ="";
    
    //Se validan que los campos de nombre, apellido, usuario y contraseña no esten vacios.
    if(!empty($_POST)){
      $nom = $mysqli->real_escape_string($_POST['nombre']);
      $ape = $mysqli->real_escape_string($_POST["apellido"]);
      $usu = $mysqli->real_escape_string($_POST['usuario']);
      $con = $mysqli->real_escape_string($_POST["contra"]);

      if(isNull($nom, $ape, $usu, $con))
      {
        $errors[] = "Debe llenar todos los campos";
      }
      elseif(buscaRepetidoUsuario($usu,$mysqli)==1){
        $errors[] = "El usuario $usu que intenta ingresar ya existe!";
      }
      elseif (buscaRepetidoContrasena($con,$mysqli)==1) {
        $errors[] = "La contraseña $con ya existe!";
        }
      else{

        //Consulta para Insertar datos a la base de datos 
        $insertar = "INSERT INTO usuario(nombre, apellido, usuario, contrasena) VALUES ('$nom','$ape','$usu','$con')";
        // Ejecuta la consulta
        $resultado = mysqli_query($mysqli,$insertar);

        if(!$resultado){

          $errors[] = "¡Hubo un error al ingresar los datos!";
        
        }
        else{

          $success = "<div id='error' class='alert alert-success alert-dismissible' role='alert'>
          <a href='#' class='close' onclick=\"showHide('error');\" data-dismiss='alert' aria-label='close'>[X]</a>
          <p>!USUARIO INGRESADO EXITOSAMENTE!</p>
          </div>";
          
        }
      }
    }
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <link rel="stylesheet" href="css/index2.css">
    <title>Registro de usuario</title>
</head>
<body>
  
  <nav class="navbar navbar-inverse navbar-expand-sm bg-dark navbar-dark" >
    <div class="container-fluid">
      <div class="navbar-header">
        <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
          <span class="icon-bar"></span>
          <span class="icon-bar"></span>
          <span class="icon-bar"></span>                        
        </button>
          
      </div>
      </div>
      <div class="collapse navbar-collapse" id="myNavbar">
        <ul class="nav navbar-nav">
        <li class="nav-item" style="margin:auto;" >
            <p><img src="img/utp.jpg" alt="logo"  style="width:45px; height:45px;padding-top:10px;"></p> 
        </li>
        <li class="nav-item">
          <a class="nav-link" href="ver_usuario.php" data-toggle="tooltip" data-placement="bottom" title=" Ver usuarios">Ver usuarios</a>
        </li>
        <li class="nav-item" style="margin:auto;" data-toggle="modal" data-target="#myModal" >
          <a class="nav-link" href="#" >Salir</a>
          <div class="modal fade" id="myModal">
            <div class="modal-dialog">
              <div class="modal-content">
              
                
                <div class="modal-header">
                  <h4 class="modal-title">¿Desea Salir?</h4>
                  <button type="button" class="hidden, modal fade" data-dismiss="modal">&times;</button>
                </div>
                
                
                  <!-- Modal body -->
                  <div class="modal-body">
                  <a href="cerrar_session.php" alt="Salir"><button type="button" class="btn btn-info">ACEPTAR</button></a>
                  <a><button type="button" class="btn btn-danger">CANCELAR</button></a>
                  </div>
                
                
                <div class="modal-footer">          
                </div>
              </div>
            </div>
          </div>
        </li>
        </ul>
        <ul class="nav navbar-nav navbar-right">
        <li class="nav-item" style="padding-left: 700px;">
            <a class="nav-link" href="#" data-toggle="tooltip" data-placement="bottom" title="Usuario activo">
              <span class="dot"></span>  Bienvenido: 
              <?php echo $_SESSION['administrador'];?>
            </a>
          </li>
      </ul>
      </div>
    </div>
  </nav>
  <div class="jumbotron" style="text-align:center;">
      <h2>&#x2655; INGRESE EL NUEVO USUARIO A LA APLICACIÓN &#x2655;</h2>
      <br>
  </div>
  <br>
  <div style="text-align:center">
    <p id="text">ATENCIÓN!  Mayúscula activada.</p>
    <div class="container-fluid" id="todobody">
      <div class="row">
        <div class="col-xs-12 col-sm-12 col-ms-12 col-lg-12">.
          <form class="form-horizontal" action="<?php $_SERVER['PHP_SELF'] ?>" method="POST" autocomplete="off"> 
            <div class="form-group">
              <!--Aquí se ingresa nombre y apellido-->
            <div class="col-sm-5">
              <input type="text" class="form-control"  placeholder="Ingrese su nombre" name="nombre" autofocus ><br>
            </div>
            <div class="col-sm-5">
                <input type="text" class="form-control"  placeholder="Ingrese su apellido" name="apellido" ><br>
            </div>
              <!-- Aquí se ingresará un usuario y contraseña -->
            <div class="col-sm-5">
              <input type="text" class="form-control"  placeholder="Ingrese su usuario" name="usuario" maxlength="15" ><br>
            </div>
            <div class="col-sm-5" >
              <input type="password" id="myInput" class="form-control"  placeholder="Ingrese su contraseña" name="contra" maxlength="15" pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}" title="Por lo menos un número, una mayúscula, una minúscula y por lo menos 8 carácteres" ><br>
            </div>
            <p id="text">ATENCIÓN!  Mayúscula activada.</p>
            <p>&nbsp;</p>

            <div class="col-md-offset-8" style="margin-left:auto;">
                <button type="submit" class="btn btn-default" id="registrarNuevo" data-toggle="tooltip" data-placement="top" title="Presione para registrar el nuevo usuario">Registrar nuevo usuario</button>
            </div> 
          </form>
        </div>
          <?php 
              echo resultBlock($errors);
              echo $success;
          ?>
      </div>
    </div>
  </div>
  <p id="text">ATENCIÓN!  Mayúscula activada.</p>
  <p>&nbsp;</p>
      <p>&nbsp;</p>
      <p>&nbsp;</p>
      <p>&nbsp;</p>
      <p>&nbsp;</p>
      <?php
        include_once 'footer.php';
      ?>
  <script>
    $("[data-toggle=popover]")
    .popover({html:true})
  </script>
  <script>
      var input = document.getElementById("myInput");
      var text = document.getElementById("text");
      input.addEventListener("keyup", function(event) {

      if (event.getModifierState("CapsLock")) {
          text.style.display = "block";
        } else {
          text.style.display = "none"
        }
      });
  </script>
  <style>
    #text {display:none;color:red}
</style>
</body>
</html>

<?php
}

else{
  session_start();
  session_destroy();

}
?>