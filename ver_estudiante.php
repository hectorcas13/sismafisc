<?php
require 'conexion.php';

session_start();
if(isset($_SESSION['u_usuario'])){
  require_once 'scripts.php'; // Este importa los scripts de la página scripts.php
  $where = "";
  if(!empty($_POST))
  {
      $valor = $_POST['campo'];
      if(!empty($valor)){
          $where = "WHERE nombre_estu LIKE '%$valor%' OR apellido_estu LIKE '%$valor%' OR grupo LIKE '%$valor%' ";
          }
  }
  $sql = "SELECT * FROM estudiantes e 
  LEFT JOIN carrera c 
  on e.carrera_idcarrera = c.idcarrera 
  LEFT JOIN facultad fa 
  on c.facultad_id = fa.id
  $where GROUP BY `nombre_estu`, `apellido_estu`, `cedula_estu`, `grupo`;";

  $resultado = $mysqli->query($sql);
?>
<html lang="es">
<head> 
        <title>Estudiantes registrados</title>
        <link rel="stylesheet" href="css/ver_datos.css">           
</head>
<body>
    <!--Aquí empiezan los Navs -->
    <?php include 'navbar.php'; ?>
<!-- Aquí se acaba el nav-->

  <!-- breadcrum o miga de pan -->
  <div class="container-fluid">               
    <ol class="breadcrumb">
      <li><a href="home.php">Inicio</a></li>
      <li><a href="#">Estudiantes registrados</a></li>     
    </ol>
  </div>
  <div class="container-fluid"> <br>
    <div class="row table-resposive">
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12" style="text-align:left;padding-left:20px;">
          <form action="<?php $_SERVER['PHP_SELF']; ?>" method="POST">
              <div class="input-group">
                <input type="text" placeholder="Buscar" id="campo" name="campo" autofocus style="width:100%;" />
              </div>
          </form>
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
        </div>
            <br>
            <h3 hidden>Resultados de su busqueda"<?php echo $_POST['campo'] ;?>"</h3>
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 table-responsive">
              <table class="table table-stripped table-hover table-condensed ">
                <thead id="mayus">
                    <tr class="info">
                        <th>N° </th>
                        <th style="width:15em">Estudiante</th>
                        <th>Cédula</th>
                        <th>Teléfono</th>
                        <th>Celular</th>
                        <th>Correo</th>
                        <th>Exoneración</th>
                        <th>Grupo</th>
                        <th  style="width:20em">Carrera</th>
                        <th  style="width:20em">Facultad</th>
                        <th>Modificar</th>
                        <th>Eliminar</th>
                    </tr>
                </thead>
                <tbody>
                    <?php 
                    $i=1;
                    while($row = $resultado->fetch_array(MYSQLI_ASSOC)) { ?>
                        <tr>
                            <td><?php echo $i; $i++; ?></td>
                            <td id="mayus"><?php echo utf8_encode($row['nombre_estu']).' '.utf8_encode($row['apellido_estu']);?></td>
                            <td><?php echo $row['cedula_estu'];?></td>
                            <td><?php echo $row['tel_estu'];?></td>
                            <td><?php echo $row['cel_estu'];?></td>
                            <td><?php echo $row['correo_estu'];?></td>
                            <td >
                                <?php 
                                if($row['exoneracion'] == 1){
                                    echo 'No Exonerado';
                                }elseif ($row['exoneracion'] == 3) {
                                  echo 'Exonerado 25%';
                                }elseif ($row['exoneracion'] == 2) {
                                echo 'Exonerado 50%';
                                }
                                else{
                                    echo 'Error';
                                }
                                ?>
                            </td>
                            <td><?php echo $row['grupo'];?></td>
                            <td id="mayus"><?php echo $row['nombre_carrera'];?></td>
                            <td id="mayus"><?php echo $row['facultad'];?></td>
                            <td><a href="modificar_estudiante.php?id=<?php echo $row['id_estu']; ?>"><span class="glyphicon glyphicon-pencil"></span></a></td>
                            <td><a href="#" data-href="eliminar_estudiante.php?id=<?php echo $row['id_estu']; ?>" data-toggle="modal" data-target="#confirm-delete"><span class="glyphicon glyphicon-trash"></span></a></td>
                        </tr>
                    <?php }?>
                </tbody>
              </table>
            </div>                 
    </div>
  </div>
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
<br><br><br>

    <!-- Script para que funcione el modal de eliminar registro -->
    <script>
      $('#confirm-delete').on('show.bs.modal', function(e){
          $(this).find('.btn-ok').attr('href', $(e.relatedTarget).data(
          'href'));

          $('.debug-url').html('Delete URL: <strong>' + $(this).find(
          '.btn-ok').attr('href')+'</strong>');
      });
      </script>
        <?php
          include_once 'footer.php';
        ?>
    <script>
      $("[data-toggle=popover]")
      .popover({html:true})
    </script>
</body>
  <?php include_once 'footer.php';  ?>
</html>
<?php }

else{
  header("Location:cerrar_session.php");
}

?>
