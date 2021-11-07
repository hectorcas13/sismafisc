<?php

require 'conexion.php'; // Se incluye la conexión a la base de datos.
include 'scripts.php'; // Se importa las funciones en javascript para que funcione la página.
include 'funciones.php';
setlocale(LC_TIME, 'es_ES'); //convierte las fechas a español 
error_reporting(0);
session_start();

if(isset($_SESSION['u_usuario'])){

    list($row7['id_estu'],$row7['carrera_idcarrera']) = explode('-',$_POST['estudiante']); // Separa las dos variables que se envian en la consulta 7
    $carrera = $row7['carrera_idcarrera']; //variable de la consula 7 separada
    $success = "";
    $error = "";
    $success_2 = "";
    $error_2 = "";
    $profesor= isset($_POST['profesor']) ? $_POST['profesor'] : 0;
    $estudiante= isset($row7['id_estu']) ? $row7['id_estu'] : 0; //variable de la consulta 7 separada

    $sql = "SELECT * FROM costo_lab WHERE id_lab = 1;";
    $resultado = $mysqli->query($sql);
    $row = mysqli_fetch_array($resultado);
    $costo_lab = $row['costo_lab'];

    $sql1 = "SELECT * FROM costo_asig WHERE id_materia = 1;";
    $resultado1 = $mysqli->query($sql1);
    $row1 = mysqli_fetch_array($resultado1);
    $costo_asig = $row1['costo_materia'];

    if(empty($profesor)){
        $sql2 = "SELECT `id_asig`,`cod_asig`,`nombre_asig` FROM asignatura ORDER BY nombre_asig ASC;";
        $resultado2 = $mysqli->query($sql2);
    }else{
        $sql2 = "SELECT `id_asig`,`cod_asig`,`nombre_asig` FROM asignatura A
        INNER JOIN asignatura_has_profesor AP
        ON A.id_asig = AP.asignatura_id_asig 
        WHERE profesor_id_profesor = '$profesor' ORDER BY nombre_asig ASC;";
        $resultado2 = $mysqli->query($sql2);
    }

    $sql3 = "SELECT id_asig, cod_asig, nombre_asig FROM asignatura ORDER BY nombre_asig ASC;";
    $resultado3 = $mysqli->query($sql3);
    //$row3 = mysqli_fetch_array($resultado3);

    $sql4 = "SELECT id_profesor, nom_prof,ape_prof FROM profesor;";
    $resultado4 = $mysqli->query($sql4);
    //$row4 = mysqli_fetch_array($resultado4);

    $sql5 = "SELECT id_profesor, nom_prof, ape_prof FROM profesor WHERE id_profesor = '$profesor';";
    $resultado5 = $mysqli->query($sql5);
    $row5 = mysqli_fetch_array($resultado5);
    
    /* algoritmo para introducir materia con PHP*/
    $profesor2 = isset($_POST['idprofe']) ? $_POST['idprofe'] : null;
    $materia = isset($_POST['materia']) ? $_POST['materia'] : null;
    if(empty($materia) || empty($profesor2)){

    }
    else{ 
        foreach ($materia as $valor){
        $insertarTablaRel = "INSERT INTO `asignatura_has_profesor`(`asignatura_id_asig`, `profesor_id_profesor`) 
        VALUES ($valor,$profesor2)";
        $resultado1 = mysqli_query($mysqli,$insertarTablaRel);}

            if(!$resultado1){

            $error = "<div id='error' class='alert alert-warning alert-dismissible' role='alert'>
            <a href='#' class='close' onclick=\"showHide('error');\" data-dismiss='alert' aria-label='close'>[X]</a>
            <h3>¡ERROR! El profesor ya tiene asignada una de las asignaturas escogidas.</h3>
            </div>";
            }
            else{

            $sql2 = "SELECT `id_asig`,`cod_asig`,`nombre_asig` FROM asignatura A
            INNER JOIN asignatura_has_profesor AP
            ON A.id_asig = AP.asignatura_id_asig
            INNER JOIN profesor P
            ON profesor_id_profesor = id_profesor
            WHERE profesor_id_profesor = '$profesor2' ORDER BY nombre_asig ASC;";
            $resultado2 = $mysqli->query($sql2);

            $sql6 = "SELECT nom_prof, ape_prof FROM profesor WHERE id_profesor = '$profesor2';";
            $resultado6 = $mysqli->query($sql6);
            $row6 = mysqli_fetch_array($resultado6);
            $nombre =$row6['nom_prof'];
            $apellido = $row6['ape_prof'];

            $success = "<div id='error' class='alert alert-success alert-dismissible' role='alert'>
            <a href='#' class='close' onclick=\"showHide('error');\" data-dismiss='alert' aria-label='close'>[X]</a>
            <h3>¡BIEN! Asignaturas agregadas para <b>$nombre $apellido</b>.</h3>
            </div>";
            }
    }
    /* Se elimina las materias del profesor */
    $materia2 = isset($_POST['materia2']) ? $_POST['materia2'] : 0;

    if(empty($materia2)){

    }else{

        foreach ($materia2 as $valor2){
            $borraTablaRel2 = "DELETE FROM `asignatura_has_profesor` WHERE `asignatura_id_asig` = '$valor2'
            AND `profesor_id_profesor` = '$profesor2';";
            $resultadox = mysqli_query($mysqli,$borraTablaRel2);

            $sql2 = "SELECT `id_asig`,`cod_asig`,`nombre_asig` FROM asignatura A
            INNER JOIN asignatura_has_profesor AP
            ON A.id_asig = AP.asignatura_id_asig
            INNER JOIN profesor P
            ON profesor_id_profesor = id_profesor
            WHERE profesor_id_profesor = '$profesor2' ORDER BY nombre_asig ASC;";
            $resultado2 = $mysqli->query($sql2);
        }
        $sql6 = "SELECT nom_prof, ape_prof FROM profesor WHERE id_profesor = '$profesor2';";
        $resultado6 = $mysqli->query($sql6);
        $row6 = mysqli_fetch_array($resultado6);
        $nombre =$row6['nom_prof'];
        $apellido = $row6['ape_prof'];
        $success = "<div id='error' class='alert alert-success alert-dismissible' role='alert'>
        <a href='#' class='close' onclick=\"showHide('error');\" data-dismiss='alert' aria-label='close'>[X]</a>
        <h3>¡BIEN! Asignaturas Eliminadas para <b>$nombre $apellido</b>.</h3>
        </div>";
    }
    $sql7 = "SELECT * FROM estudiantes ORDER BY nombre_estu ASC;";
    $resultado7 = $mysqli->query($sql7);
    
    if(!empty($estudiante)){
        $sql8 = "SELECT id_asig, cod_asig, nombre_asig FROM asignatura WHERE carrera_idcarrera = '$carrera' ORDER BY nombre_asig ASC;";
        $resultado8 = $mysqli->query($sql8);

    }else{
        $sql8 = "SELECT id_asig, cod_asig, nombre_asig FROM asignatura ORDER BY nombre_asig ASC;";
        $resultado8 = $mysqli->query($sql8);

    }
    if(empty($estudiante)){
        $sql9 = "SELECT `id_asig`,`cod_asig`,`nombre_asig` FROM asignatura ORDER BY nombre_asig ASC;";
        $resultado9 = $mysqli->query($sql9);
    }else{
        $sql9 = "SELECT `id_asig`,`cod_asig`,`nombre_asig` FROM asignatura A
        INNER JOIN asignatura_has_estudiantes AE
        ON A.id_asig = AE.asignatura_id_asig 
        WHERE estudiantes_id_estu = '$estudiante' ORDER BY nombre_asig ASC;";
        $resultado9 = $mysqli->query($sql9);
    }
    $sql10 = "SELECT id_estu, nombre_estu, apellido_estu FROM estudiantes WHERE id_estu = '$estudiante';";
    $resultado10 = $mysqli->query($sql10);
    $row10= mysqli_fetch_array($resultado10);

    //******************************************************************************************** */
    $estudiante2 = isset($_POST['idestu']) ? $_POST['idestu'] : null;
    $materia3 = isset($_POST['materia3']) ? $_POST['materia3'] : null;
    $ejm = count($materia3);

    if(empty($materia3) || empty($estudiante2)){

    }
    else{ 
        if(($ejm > 1) && (AsignaturaAsignadaAEstudianteX($estudiante2,$mysqli)== 1) ){
            $error_2 = "<div id='error' class='alert alert-warning alert-dismissible' role='alert'>
                        <a href='#' class='close' onclick=\"showHide('error');\" data-dismiss='alert' aria-label='close'>[X]</a>
                        <h3>¡ERROR! El estudiante no puede tener mas de dos asignaturas asignadas.</h3>
                        </div>";

        }elseif(AsignaturaAsignadaAEstudiante2($estudiante2,$mysqli)== 1){
            $error_2 = "<div id='error' class='alert alert-warning alert-dismissible' role='alert'>
                        <a href='#' class='close' onclick=\"showHide('error');\" data-dismiss='alert' aria-label='close'>[X]</a>
                        <h3>¡ERROR! El estudiante no puede tener mas de dos asignaturas asignadas.</h3>
                        </div>";
        }else{
            foreach ($materia3 as $valor){
            $insertarTablaRel2 = "INSERT INTO `asignatura_has_estudiantes`(`asignatura_id_asig`, `estudiantes_id_estu`) 
            VALUES ($valor,$estudiante2)";
            $resultado_2 = mysqli_query($mysqli,$insertarTablaRel2);}
        

            if(!$resultado_2){
    
            $error_2 = "<div id='error' class='alert alert-warning alert-dismissible' role='alert'>
            <a href='#' class='close' onclick=\"showHide('error');\" data-dismiss='alert' aria-label='close'>[X]</a>
            <h3>¡ERROR! No se asignaron las asignaturas al estudiante, verifique que no haya asignaturas repetidas.</h3>
            </div>";
            }
            else{

            $sql9 = "SELECT `id_asig`,`cod_asig`,`nombre_asig` FROM asignatura A
            INNER JOIN asignatura_has_estudiantes AE
            ON A.id_asig = AE.asignatura_id_asig
            INNER JOIN estudiantes E
            ON estudiantes_id_estu = id_estu
            WHERE estudiantes_id_estu = '$estudiante2' ORDER BY nombre_asig ASC;";
            $resultado9 = $mysqli->query($sql9);

            $sql11 = "SELECT nombre_estu, apellido_estu FROM estudiantes WHERE id_estu = '$estudiante2';";
            $resultado11 = $mysqli->query($sql11);
            $row11 = mysqli_fetch_array($resultado11);
            $nombre1 =$row11['nombre_estu'];
            $apellido1 = $row11['apellido_estu'];

            $success_2 = "<div id='error' class='alert alert-success alert-dismissible' role='alert'>
            <a href='#' class='close' onclick=\"showHide('error');\" data-dismiss='alert' aria-label='close'>[X]</a>
            <h3>¡BIEN! Asignaturas agregadas para <b>$nombre1 $apellido1</b>.</h3>
            </div>";
            }
        }
    }
    /* Se elimina las materias del profesor */
    $materia4 = isset($_POST['materia4']) ? $_POST['materia4'] : 0;

    if(empty($materia4)){

    }else{

        foreach ($materia4 as $valor_2){
            $borraTablaRel_2 = "DELETE FROM `asignatura_has_estudiantes` WHERE `asignatura_id_asig` = '$valor_2'
            AND `estudiantes_id_estu` = '$estudiante2';";
            $resultado_x = mysqli_query($mysqli,$borraTablaRel_2);

            $sql9 = "SELECT`id_asig`,`cod_asig`,`nombre_asig` FROM asignatura A
            INNER JOIN asignatura_has_estudiantes AE
            ON A.id_asig = AE.asignatura_id_asig
            INNER JOIN estudiantes E
            ON estudiantes_id_estu = id_estu
            WHERE estudiantes_id_estu = '$estudiante2' ORDER BY nombre_asig ASC;";
            $resultado9 = $mysqli->query($sql9);
       }
       $sql12 = "SELECT nombre_estu, apellido_estu FROM estudiantes WHERE id_estu = '$estudiante2';";
       $resultado12 = $mysqli->query($sql12);
       $row12 = mysqli_fetch_array($resultado12);
       $nombre_2 =$row12['nombre_estu'];
       $apellido_2 = $row12['apellido_estu'];
       $success_2 = "<div id='error' class='alert alert-success alert-dismissible' role='alert'>
       <a href='#' class='close' onclick=\"showHide('error');\" data-dismiss='alert' aria-label='close'>[X]</a>
       <h3>¡BIEN! Asignaturas Eliminadas para <b>$nombre_2 $apellido_2</b>.</h3>
       </div>";
    }

    $sql13 = "SELECT * FROM settingdate GROUP BY id ASC;";
    $resultado13 = $mysqli->query($sql13);
?>
<html lang="es">
<head> 
        <title>Edición de variables</title>
        <link rel="stylesheet" href="css/edicion.css">
</head>
<body>
<?php include 'navbar.php'; ?>

    <div class="jumbotron container-fluid" style="margin-top:-20px;">
        <div class="col-lg-12 col-md-12 col-sm-3">
            <h1 class="">EDITE LAS VARIABLES EN LA BASE DE DATOS</h1>
            <p>
                Elija una opción dependiendo de lo que necesite.
                Puede elegir la opción crear nuevo reporte en <abbr title="Portable Document Format">PDF</abbr> usando FPDF.
                <br />
            </p>
        </div>
    </div>
      <!-- breadcrum o miga de pan -->
    <div class="container-fluid">               
        <ol class="breadcrumb">
        <li><a href="home.php">Inicio</a></li>
        <li><a href="#">Edición de los datos</a></li>     
        </ol>
    </div>
    <div class="container-fluid" style="">
        <div class="row">
            <div class="alert alert-info" >
                <strong>EDITE EL COSTO DEL LABORATORIO</strong><h4>El costo actual es B/. <?php echo $costo_lab;?></h4>
            </div>
            <div id="costolab" class="col-lg-6 col-md-6 col-sm-3" style="margin:auto;text-align:center;">
                <form action="actualizar_costo_lab.php" method="post">
                    <input type="number" value="" name="costo_lab" id="costo_lab">
                    <button class="btn btn-primary">REGISTRAR</button>
                </form>
            </div>
        </div>
    </div>
    <hr />
    <div class="container-fluid">
        <div class="row">
            <div class="alert alert-info" >
                <strong>EDITE EL COSTO DE LA ASIGNATURA</strong><h4>El costo actual es B/. <?php echo $costo_asig;?></h4>
            </div>
            <div id="costoasig" class="col-lg-6 col-md-6 col-sm-3" style="margin:auto;text-align:center;">
                <form action="actualizar_costo_asig.php" method="post">
                    <input type="number" value="" name="costo_asig" id="costo_asig">
                    <button class="btn btn-primary">REGISTRAR</button>
                </form>
            </div>
        </div>
    </div>
    <hr />
    <!-- Se agregan materias para ser dictadas por el profesor -->
    <div class="container-fluid">
        <div class="row" id="materia">
            <div class="alert alert-info col-lg-12 col-md-12 col-sm-3" style="margin:auto" id="profesor">
                <strong>INGRESE Y ELIMINE</strong><h4> Las asignaturas que dictarán los profesores.</h4>
            </div>
            <div class="col-lg-12 col-md-12 col-sm-12" style="margin-left:10px;margin-right:10px;">
                <br />
                <form action="edicion.php#profesor" method="POST">
                    <select name="profesor"  class="input-sm" onchange="this.form.submit();" >
                            <option value="">SELECCIONE AL PROFESOR</option>
                        <?php while($row4 = $resultado4->fetch_array(MYSQLI_ASSOC)) { ?>
                            <option value="<?php echo $row4['id_profesor'];?>"><?php echo $row4['nom_prof'].' '.$row4['ape_prof'];?></option>
                        <?php }?>
                    </select>
                </form>
            </div>
            <div class="col-lg-5 col-md-5 col-sm-12" >
                <h5>Asigne las materias para: <b id="mayus"><?php echo $row5['nom_prof'].' '.$row5['ape_prof'];?></b></h5>
                <form action="edicion.php#materia" method="POST">
                    <input type="hidden" name="idprofe" value="<?php echo $row5['id_profesor'];?>">
                    <select name="materia[]" id="" multiple style="height:200px;width:70%;" onchange="marcar(this)">
                        <?php while($row3 = $resultado3->fetch_array(MYSQLI_ASSOC)) { ?>
                            <option value="<?php echo $row3['id_asig'];?>" id="mayus" >
                                <?php echo $row3['cod_asig'].' '.$row3['nombre_asig'];?>
                            </option>
                        <?php }?>
                    </select>
            </div>
            <div class="col-lg-1 col-md-1 col-sm-6" style="text-align: center;">
                <button class="btn btn-primary" >>></button>
            </div>
                </form>
            <br>
            <div class="col-lg-1 col-md-1 col-sm-6" style="text-align: center;" >
            <form action="edicion.php#materia" method="POST">
                    <button class="btn btn-primary"><<</button>
                </div>
                <div class="col-lg-5 col-md-5 col-sm-12" style="" >
                    <h5>Asignaturas que dicta el profesor:</h5>
                    <input type="hidden" name="idprofe" value="<?php echo $row5['id_profesor'];?>">
                    <select name="materia2[]" id="materia2" multiple style="height:200px;width:70%;" onchange="marcar(this)">  
                        <?php while($row2 = $resultado2->fetch_array(MYSQLI_ASSOC)) { ?>
                            <option  value="<?php echo $row2['id_asig'];?>" id="mayus"><?php echo $row2['cod_asig'].' '.$row2['nombre_asig'];?>
                            </option>
                        <?php }?>
                    </select>
                </div>
            </form>
        </div>
        <br />
        <?php echo $success;?>
        <?php echo $error;?>
        <br />
        <br />
        <br />
        <br />
    </div>
    <hr />
    <!-- Se agregan materias para ser asignadas a un estudiante -->
    <div class="container-fluid">
        <div class="row" id="estudiante"  >
            <div class="alert alert-info col-lg-12 col-md-12 col-sm-3"  style="margin:auto">
                <strong>INGRESE Y ELIMINE</strong><h4> Las asignaturas que los estudiantes cursarán.</h4>
            </div>
            <div class="col-lg-12 col-md-12 col-sm-12" style="margin-left:10px;margin-right:10px">
                <br />
                <form action="edicion.php#estudiante" method="POST">
                    <select name="estudiante" class="input-sm" onchange="this.form.submit();">
                            <option value="">SELECCIONE AL ESTUDIANTE</option>
                        <?php while($row7 = $resultado7->fetch_array(MYSQLI_ASSOC)) { ?>
                            <option value="<?php echo $row7['id_estu']."-".$row7['carrera_idcarrera'];?>"><?php echo $row7['nombre_estu'].' '.$row7['apellido_estu'];?></option>
                        <?php }?>
                    </select>
                </form>
            </div>
            <div class="col-lg-5 col-md-5 col-sm-12" >
            <h5>Asigne las materias para: <b id="mayus"><?php echo $row10['nombre_estu'].' '.$row10['apellido_estu'];?></b></h5>
            <form action="edicion.php#estudiante" method="POST">
                    <input type="hidden" name="idestu" value="<?php echo $row10['id_estu'];?>">
                    <select name="materia3[]" id="materia3" multiple style="height:200px;width:70%;" onchange="marcar(this)">
                        <?php while($row8 = $resultado8->fetch_array(MYSQLI_ASSOC)) { ?>
                            <option value="<?php echo $row8['id_asig'];?>" id="mayus" >
                                <?php echo $row8['cod_asig'].' '.$row8['nombre_asig'];?>
                            </option>
                        <?php }?>
                    </select>
                </div>
            <div class="col-lg-1 col-md-1 col-sm-6" style="text-align: center;">
                <button class="btn btn-primary" >>></button>
            </div>
            <br>
            </form>
            <div class="col-lg-1 col-md-1 col-sm-6" style="text-align: center;">
            <form action="edicion.php#estudiante" method="POST">
                <button class="btn btn-primary"><<</button>
            </div>
            <div class="col-lg-5 col-md-5 col-sm-12" style="" >
                <h5>Asignaturas que posee el estudiante:</h5>
                <input type="hidden" name="idestu" value="<?php echo $row10['id_estu'];?>">                
                <select name="materia4[]" id="materia4" multiple style="height:200px;width:70%;" onchange="marcar(this)">  
                    <?php while($row9 = $resultado9->fetch_array(MYSQLI_ASSOC)) { ?>
                        <option  value="<?php echo $row9['id_asig'];?>" id="mayus"><?php echo $row9['cod_asig'].' '.$row9['nombre_asig'];?>
                        </option>
                    <?php }?>
                </select>
            </div>
            </form>
        </div>
        <br />
        <?php echo $success_2;?>
        <?php echo $error_2;?>
    </div>
    <div class="container-fluid" style="auto" id="cal">
        <div class="row">
            <div class="alert alert-info" >
                <strong>CALENDARIO DE PAGO</strong><br><h4>EDITE LOS VALORES</h4>
            </div>
            <div class="col-lg-12 col-md-10 col-sm-4 table-responsive" >
                <table class="table table-stripped table-hover table-condensed ">
                    <thead id="mayus">
                        <tr class="info">
                            <th>N° </th>
                            <th style="width:auto">Item</th>
                            <th style="width:auto">Inicia</th>
                            <th style="width:auto">Finaliza</th>
                            <th style="width:auto">Reporte</th>
                            <th>Modificar</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php 
                        $i=1;
                        while($row13 = $resultado13->fetch_array(MYSQLI_ASSOC)) { ?>
                            <tr>
                                <td><?php echo $row13['id']; ?></td>
                                <td><?php echo utf8_encode($row13['item']);?></td>
                                <td><?php echo strftime("%d de %B de %Y", strtotime($row13['fa']));?></td>
                                <td><?php echo strftime("%d de %B de %Y", strtotime($row13['fb']));?></td>
                                <td id="mayus"><?php echo $row13['rep'];?></td>
                                <td><a href="modificar_calendario.php?id=<?php echo $row13['id']; ?>"><span class="glyphicon glyphicon-pencil"></span></a></td>
                            </tr>
                        <?php }?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>


<br><br><br><br><br>

<script>
  	// Limitará a dos la cantidad de materias en un estudiantes que se introducen
      var ultimoValorValido = null;
      $("#materia3").on("change", function() {
        if ($("#materia3 option:checked").length > 2) {
          $("#materia3").val(ultimoValorValido);
          ultimoValorValido = $("#selectID").val([]);      
        } else {
          ultimoValorValido = $("#materia3").val();
        }
    });
  </script>
   <script>
    $("[data-toggle=popover]")
    .popover({html:true})
  </script>
</body>
<?php require 'footer.php';?>
</html>
<?php
    mysqli_close($mysqli);
    }else{
    header("Location:cerrar_session.php");
    }
?>
