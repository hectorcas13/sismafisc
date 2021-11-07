<?php
session_start();

require 'conexion.php'; // Se incluye la conexión a la base de datos.
include 'scripts.php'; // Se importa las funciones en javascript para que funcione la página.

  if(isset($_SESSION['u_usuario'])){

?>

<html lang="es">
<head>
    <title>Reportes</title>
    <link rel="stylesheet" href="css/principal.css">

    <script type="text/javascript">

    // $(document).ready(function()){
    //             $('.delete').click(function(){
    //                 var parent = $(this).parent().attr()
    //             }
    //         }

    </script>
</head>
<body>
<?php include 'navbar.php'; ?>   
    <div class="container-fluid">               
        <ol class="breadcrumb">
          <li><a href="home.php">Inicio</a></li>
          <li><a href="#">Reportes</a></li>   
        </ol>
    </div>
    <div class="container" style="margin-left:20px;margin-right:20px;">
        <div class="row">
            <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12" >
                <h3>Subir Reporte</h3>
            </div>
            <div id="subir_reporte" class="row tab-pane fade in ">
                <div class="col-lg-8 col-md-8 col-sm-12">
                    <form class="form-horizontal" action="guardar.php" method="post" enctype="multipart/form-data" autocomplete="off">
                        <div class="row" style="inline-flex">
                            <input type="file" class="btn btn-dark" id="archivo" name="archivo"  accept="application/pdf" >
                            <button type="submit" class="btn btn-info" style="margin-left:50px;">Guardar</button>
                        </div>
                            <br>
                </div>
                    
                <div  class="col-lg-12 col-md-12 col-sm-12 col-xs-12" style="inline-block">
                <h4>Reportes existentes</h4>
                    <?php
                        $i=1;
                        $path ='files/';
                        
                        if(file_exists($path)){
                            $directorio = opendir($path);
                            while ($archivo = readdir($directorio))
                            {
                                if(!is_dir($archivo)){
                                    
                                    $acumulador = $i;$i++;


                                    echo   "<div data='".$path."/".$archivo."'>   <h4>$acumulador</h4>                                         
                                            <a href='".$path."/".$archivo."' target='_blank' title='Ver Archivo Adjunto'>
                                            <span class='glyphicon glyphicon-download-alt'></span>
                                            </a>";

                                    echo "$archivo 
                                            <a href='delete_file.php?file=".$archivo."' type='submit' class='delete' title='Ver Archivo Adjunto'>
                                            <span class='glyphicon glyphicon-trash' aria-hidden='true'></span>
                                            </a> 
                                            </div>";                                   
                                }
                            }
                        }
                    ?>
                </div>
                    </form>
            </div>
        </div>
    </div>

</body>
<br><br><br><br><br><br>
<?php include_once 'footer.php';  ?>
</html>
<?php 
//Cerrar conexión
mysqli_close($mysqli);
}
else{
  header("Location:cerrar_session.php");
}
?>
