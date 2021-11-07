<?php

    require 'conexion.php';
    require 'scripts.php';

    session_start();
    if(isset($_SESSION['u_usuario'])){ 

        $sql1 = "SELECT * from asignatura ORDER BY nombre_asig ASC;";
        $resultado1 = $mysqli->query($sql1);
        $campo1 = isset($_POST["var1_reporte1"]) ? $_POST["var1_reporte1"] : 0; 
        $campo2 = isset($_POST["var4_reporte1"]) ? $_POST["var4_reporte1"] : 0;
        $campo3 = isset($_POST["varfacultad"]) ? $_POST["varfacultad"] : 0;
        $campo4 = isset($_POST["idgrupo"]) ? $_POST["idgrupo"] : 0;
        $campo5 = isset($_POST["var444_reporte1"]) ? $_POST["var444_reporte1"] : $campo2;
        $segundaAsig ="";

        $sql3 = "SELECT nombre_carrera FROM carrera WHERE idcarrera = '$campo1';";
        $resultado3 = $mysqli->query($sql3);
        $row3 = $resultado3->fetch_array(MYSQLI_ASSOC);

        $sql4 = "SELECT nombre_asig FROM asignatura WHERE id_asig = '$campo2';";
        $resultado4 = $mysqli->query($sql4);
        $row4 = $resultado4->fetch_array(MYSQLI_ASSOC);

        $sql5 = "SELECT facultad FROM facultad WHERE id = '$campo3';";
        $resultado5 = $mysqli->query($sql5);
        $row5 = $resultado5->fetch_array(MYSQLI_ASSOC);

        $sql7 = "SELECT distinct grupo FROM estudiantes WHERE grupo = '$campo4';";
        $resultado7 = $mysqli->query($sql7);
        $row7 = $resultado7->fetch_array(MYSQLI_ASSOC);

        $sql8 = "SELECT nombre_asig FROM asignatura WHERE id_asig = '$campo5';";
        $resultado8 = $mysqli->query($sql8);
        $row8 = $resultado8->fetch_array(MYSQLI_ASSOC);

        $sql6 = "SELECT DISTINCT grupo FROM estudiantes;";
        $resultado6 = $mysqli->query($sql6);
        
        if (isset($_POST['var4_reporte1']) && empty($_POST['var444_reporte1'])) {

            $var1= htmlentities($_POST['var4_reporte1']);
            $var3= htmlentities($_POST['idgrupo']);
            // $sql = "CALL llamarestudiantes1($var1,$var3)";

            $sql = "SELECT DISTINCT nombre_estu, apellido_estu, cedula_estu, correo_estu, tel_estu, cel_estu, grupo
            FROM `asignatura_has_estudiantes` AE INNER JOIN estudiantes E ON E.id_estu = AE.estudiantes_id_estu 
            and E.id_estu = AE.estudiantes_id_estu and AE.`asignatura_id_asig`= $var1 and e.grupo = $var3
            INNER JOIN asignatura A ON A.id_asig = AE.`asignatura_id_asig` ;";
            
            $resultado = $mysqli->query($sql);
            
        }
        elseif (isset($_POST['var4_reporte1']) && isset($_POST['var444_reporte1'])) {
            $var1= htmlentities($_POST['var4_reporte1']);
            $var2 = htmlentities($_POST['var444_reporte1']) ? htmlentities($_POST['var444_reporte1']) : $campo2;
            $var3= htmlentities($_POST['idgrupo']);
            // $sql = "CALL llamarestudiantes2($var1,$var2,$var3)";
            $sql = "SELECT `asignatura_id_asig`,`estudiantes_id_estu`,id_estu, id_asig, nombre_estu,  apellido_estu, correo_estu, cedula_estu, tel_estu, cel_estu, nombre_asig,grupo 
            FROM `asignatura_has_estudiantes` AE INNER JOIN estudiantes E ON E.id_estu = AE.estudiantes_id_estu and AE.`asignatura_id_asig`= $var2
            OR E.id_estu = AE.estudiantes_id_estu and AE.`asignatura_id_asig`= $var1 and e.grupo = $var3 INNER JOIN asignatura A 
            ON A.id_asig = AE.`asignatura_id_asig`;
            ";
            $resultado = $mysqli->query($sql);
            $segundaAsig = 'Y<br>'.$row8['nombre_asig'];
        }
        else{
            $sql = "SELECT * from estudiantes ORDER BY nombre_estu ASC;";
            $resultado = $mysqli->query($sql);
        }
?>
<html lang="es">
<head>
<?php
if(!isset($_POST["var4_reporte1"])){
    echo '<title>Reporte B</title>';
}else{
    $a=$row4["nombre_asig"];
    $ra = "_";
    $gr = "grupo";
    $vargr = $row7['grupo'];
    $rm = "-";
    $año = Date("Y");
    echo "<title>estu-$a$rm$gr$ra$vargr</title>";
 }?>
        <link rel="stylesheet" href="css/reporte2.css">     
        <?php include 'navbar.php';  ?>    
</head>
<body>
<?php 
    if(isset($_POST["var1_reporte1"]) || isset($_POST["var4_reporte1"]) ||  isset($_POST["varfacultad"]) ){
        
    }else{
        require 'modalB.php';
    }  
    ?>
    <!-- Aquí abajo se incluyen los navbar -->
    <div class="container-fluid" >
        <div id="print">
            <div class="container-fluid">               
                <ol class="breadcrumb">
                        <li><a href="home.php">Inicio</a></li>
                        <li><a href="" onClick="location.reload();">Reporte B</a></li>
                    <div class="pull-right" style="margin-right:0; color:#00aaff;" >
                        <li onClick="window.print();"><a><i class="glyphicon glyphicon-print"></i></a></li>
                    </div>
                </ol>
            </div>            
            <div class="col-lg-12 col-md-12 col-md-12 col-xs-12" style="text-align:center;">
                <div class="row ">
                    <form action="" target="_blank" method="POST">  
                        <p>
                            <br><br>
                            <h4>UNIVERSIDAD TECNOLÓGICA DE PANAMÁ</h4>
                            <h4 id="mayus">facultad de <?php echo $row5['facultad']; ?></h4>
                            <h4>COORDINACIÓN DE POSTGRADO </h4>
                            <h4 id="mayus"  <?php echo $row3['nombre_carrera']; ?></h4>
                            <h4 id="mayus"><?php echo $row4['nombre_asig']; ?></h4>
                            <h4 id="mayus"><?php echo $segundaAsig ?></h4>
                            <h4 id="mayus">Grupo: <?php echo $row7['grupo']; ?></h4>
                            <br />
                        </p>  
                </div>
            </div>
            <div class="col-lg-12 col-md-12 col-sm-12  col-xs-12" >
                <div class="row table-responsive">
                    <table class="table table-stripped table-hover table-condensed  " id="tablas" border="2">
                        <thead>
                            <tr class="info">
                            <!--   <th>ID</th>-->
                                <th>N°</th>
                                <th>Nombre</th>
                                <th>Cédula</th>
                                <th>Correo</th>
                                <th>Teléfonos</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php 
                            $i=1;
                            while($row = $resultado->fetch_array(MYSQLI_ASSOC)) { 
                                ?>
                                <tr>
                                    <td><?php echo $i; $i++; ?></td>
                                    <td id="mayus"><?php echo utf8_encode($row['nombre_estu'])." ".utf8_encode($row['apellido_estu']);?></td>
                                    <td><?php echo $row['cedula_estu'];?></td>
                                    <td id="prueba" name="prueba"><?php echo $row['correo_estu'];?></td>
                                    <td><?php echo $row['tel_estu']." <br /> ".$row['cel_estu'];?></td>
                                </tr>
                            <?php }?>
                        </tbody>
                    </table>
                </div>
            </div> 
        </div> </div> <!-- hasta aqui se imprime con el reporte -->
            <div class="col-lg-12 col-md-12 col-sm-12  col-xs-12">
                <div style="text-align:center;">
                    <p>&nbsp;</p>
                    <a type="button" class="btn btn-primary" onClick="location.reload();" style="width: 300px; height: 48px; background: #6699FF; color: #ffffff; cursor: pointer; border: 0px;" >RECARGAR</a>
                    <button type="submit" class="btn btn-success" onClick="printContent('print');" style="width: 300px; height: 48px; background: green; color: #ffffff; cursor: pointer; border: 0px;">IMPRIMIR</button> 
                </div>  
            </div>
                    </form>  
    </div>                   
    <p>&nbsp;</p>
    <p>&nbsp;</p>
    <p>&nbsp;</p>
    <p>&nbsp;</p>
    <p>&nbsp;</p>

    <?php
        include_once 'footer.php';
    ?>
    <script type="text/javascript">
        $(function(){
            $("#myModal2").modal();
        });
    </script>
    <script>
        $("[data-toggle=popover]")
        .popover({html:true})
  </script>
</body>
</html>
<?php }
else{
  header("Location:cerrar_session.php");
}

?>
