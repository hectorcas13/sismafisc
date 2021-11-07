<?php
require 'conexion.php';
session_start();
if(isset($_SESSION['administrador'])){ 
  require_once 'scripts.php'; // Este importa los scripts de la página scripts.php
    $where = "";
    if(!empty($_POST))
    {
        $valor = $_POST['campo'];
        if(!empty($valor)){
            $where = "WHERE nombre LIKE '%$valor%' OR apellido LIKE '%$valor%' OR usuario LIKE '%$valor%'";
        }
    }
    $sql = "SELECT * FROM usuario $where";
    $resultado = $mysqli->query($sql);
?>
<html lang="es">
<head>
        <link rel="stylesheet" href="css/ver_datos.css">
        
        <title>Usuarios registrados</title>
</head>
<body>
<!--Aquí empiezan los Navs -->
<nav class="navbar navbar-inverse">
  <div class="container-fluid">
    <div class="navbar-header">
      <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>
        <!-- Brand/logo -->
        <a class="navbar-brand" href="#">
          <p style="margin-top:-10px"><img src="img/utp.jpg" alt="logo"  style="width:40px; height: 40px;"></p>  
        </a>
    </div>
    <div class="collapse navbar-collapse" id="myNavbar">
      <ul class="nav navbar-nav">
      <li class="nav-item" style="padding-left: 20px;">
            <a class="nav-link" href="main2.php" data-toggle="tooltip" data-placement="bottom" title="Ingresar nuevo usuario">Nuevo usuario</a>
        </li>
        <li class="nav-item" style="padding-left: 20px" data-toggle="modal" data-target="#myModal">
            <a class="nav-link" href="#" data-toggle="tooltip" data-placement="bottom" title="Salir del sistema">Salir</a>
            <!-- The Modal -->
          <div class="modal fade" id="myModal">
            <div class="modal-dialog">
              <div class="modal-content">
              
                <!-- Modal Header -->
                <div class="modal-header">
                  <h4 class="modal-title">¿Desea Salir?</h4>
                  <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                
                <!-- Modal body -->
                <div class="modal-body">
                <a href="cerrar_session.php" alt="Salir"><button type="button" class="btn btn-info">ACEPTAR</button></a>
                <a><button type="button" class="btn btn-danger">CANCELAR</button></a>
                </div>
                
                <!-- Modal footer -->
                <div class="modal-footer">
        
                </div>
                
              </div>
            </div>
          </div>
        </li>
      </ul>
      <ul class="nav navbar-nav navbar-right">
        <li class="nav-item" style="padding-left: 670px;">
          <a class="nav-link" href="#" data-toggle="tooltip" data-placement="bottom" title="Usuario activo">
            <span class="dot"></span>  Bienvenido: 
            <?php echo $_SESSION['administrador'];?>
          </a>
        </li>
      </ul>
    </div>
  </div>
</nav>
<!-- Aquí se acaba el nav-->
  <div class="container-fluid"> <br>
    <div class="row table-resposive">
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12" style="text-align:left;padding-left:20px;">
          <form action="<?php $_SERVER['PHP_SELF']; ?>" method="POST">
            <div class="input-group">
              <input type="text" id="campo" name="campo" placeholder="Buscar" autofocus style="width:100%;"/>
            </div>
            <style>

              input[type=text] {
                width: 130px;
                box-sizing: border-box;
                border: 2px solid #ccc;
                border-radius: 4px;
                font-size: 16px;
                background-color: white;
                background-image: url('img/search.png');
                background-position: 10px 10px; 
                background-repeat: no-repeat;
                padding: 12px 20px 12px 40px;
                -webkit-transition: width 0.4s ease-in-out;
                transition: width 0.4s ease-in-out;
              }

              input[type=text]:focus {
                width: 300%;
              }
                                  
            </style>
          </form>
        </div>
          <h3 hidden>Resultados de su busqueda"<?php echo $_POST['campo'] ?>"</h3>
      <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 table-responsive">
        <table class="table table-stripped table-hover table-condensed ">
          <thead id="mayus">
            <tr class="info">
              <th>Id</th>
              <th>Nombre</th>
              <th>Usuario</th>
              <th>Contraseña</th>
              <th>Modificar</th>
              <th>Eliminar</th>
            </tr>
          </thead>
          <tbody>
            <?php while($row = $resultado->fetch_array(MYSQLI_ASSOC)) { ?>
              <tr>
                <td><?php echo $row['id_user'];?></td>             
                <td id="mayus"><?php echo $row['nombre']." ".$row['apellido'];?></td>
                <td><?php echo $row['usuario'];?></td>
                <td><?php echo sha1($row['contrasena']);?></td>
                <td><a href="modificar_usuario.php?id=<?php echo $row['id_user']; ?>"><span class="glyphicon glyphicon-pencil"></span></a></td>
                <td><a href="#" data-href="eliminar_usuario.php?id=<?php echo $row['id_user']; ?>" data-toggle="modal" data-target="#confirm-delete"><span class="glyphicon glyphicon-trash"></span></a></td>
                </tr>
            <?php }?>
          </tbody>
        </table>
      </div>
    </div>
  </div>
  <!-- MODAL-->
    <div class="modal fade" id="confirm-delete" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
			<div class="modal-dialog">
				<div class="modal-content">
					
					<div class="modal-header">
                        <h4 class="modal-title" id="myModalLabel">Eliminar Registro</h4>
						<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
					</div>
					
					<div class="modal-body">
						¿Desea eliminar este registro?
					</div>
					
					<div class="modal-footer">
						<button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
						<a class="btn btn-danger btn-ok">Eliminar</a>
					</div>
				</div>
			</div>
    </div>
    <script src="js/functions.js"></script>
    <script>
      $("[data-toggle=popover]")
      .popover({html:true})
  </script>
      <p>&nbsp;</p>
      <p>&nbsp;</p>
      <p>&nbsp;</p>
      <p>&nbsp;</p>
      <p>&nbsp;</p>
      <p>&nbsp;</p>
      <p>&nbsp;</p>
      <p>&nbsp;</p>
      <p>&nbsp;</p>

</body>
  <?php  include_once 'footer.php';  ?>
</html>
<?php 
}else{
  header("Location:cerrar_session.php");
}
?>
