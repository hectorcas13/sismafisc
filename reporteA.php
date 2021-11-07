#reporte A

<?php

    require 'conexion.php';
    session_start();
    if(isset($_SESSION['u_usuario'])){ 
    
    setlocale(LC_TIME, 'es_ES'); //convierte las fechas a español   
    require 'scripts.php'; // Este importa los scripts de la página scripts.php
    $var_sesion = $_SESSION['u_usuario'];

    // Reciben los datos del modal
    $var1 = isset($_POST['var1_reporte1']) ? $_POST['var1_reporte1'] : null;
    $var2 = isset($_POST['var4_reporte1']) ? $_POST['var4_reporte1'] : null;
    $var3 = isset($_POST['var444_reporte1']) ? $_POST['var444_reporte1'] : null;
    $campo4 = isset($_POST["varfacultad"]) ? $_POST["varfacultad"] : 0;
    $var4 = isset($_POST['periodo']) ? $_POST['periodo'] : null;
    $var5 = isset($_POST['comentario']) ? $_POST['comentario'] : null;
    $var6 = isset($_POST['grupo']) ? $_POST['grupo'] : null;
    $var66 ="";
    $var7 = isset($_POST['pago']) ? $_POST['pago'] : null;
    if($var6 == NULL){
        $var66 == "";
    }else{
        $var66= "Grupo N°  ".$var6;
    }

    // saca la carrera en programa
    $sql2 = "SELECT * from carrera WHERE idcarrera = '$var1'";
    $resultado2 = $mysqli->query($sql2);
    $row2 = mysqli_fetch_array($resultado2); 
    // saca la asignatura en la tabla   
    $sql3 = "SELECT * from asignatura WHERE id_asig = '$var2'";
    $resultado3 = $mysqli->query($sql3);
    $row3 = mysqli_fetch_array($resultado3); 
    $sql4 = "SELECT * from asignatura WHERE id_asig = '$var3'";
    $resultado4 = $mysqli->query($sql4);
    $row4 = mysqli_fetch_array($resultado4);

    $sql6 = "SELECT facultad FROM facultad WHERE id = '$campo4';";
    $resultado6 = $mysqli->query($sql6);
    $row6 = $resultado6->fetch_array(MYSQLI_ASSOC);

    //Busca en la base de datos la información sobre las fechas
    $sql = "SELECT * from settingdate ";
    $result = mysqli_query($mysqli,$sql);
    $fechas = array();
    while ($row = mysqli_fetch_assoc($result)) {


        //mientras exista la tabla ejecutará las siguientes tablas
        if (!isset($fechas[$row['id']])) {
     
           //Creamos el arreglo multidimensional para luego correrlo e imprimirlo
           $fechas[$row['id']] = array(
              'fa' => $row['fa'],
              'fb' => $row['fb'],
           );
        }
     }
?>
<html lang="es">
<head> 
<?php 
    if(!isset($_POST["var4_reporte1"])){
        echo '<title>Reporte A</title>';
    }else{
        $a=$row3["nombre_asig"];
        $ra = "grupo";
        $rm = "-";
        $año = Date("Y");
        echo "<title>hor-$a$rm$ra$var6$rm$año.</title>";
 }?>
        <title><?php echo "cal-".$row3['nombre_asig']." ".$row4['nombre_asig'].date("Y");?></title>
        <link rel="stylesheet" href="css/reporte1.css">
</head>
<body>
    <!-- Aquí abajo se incluyen los navbar -->
    <?php include 'navbar.php';
    
        if(isset($_POST["var1_reporte1"]) && isset($_POST["var4_reporte1"]) ){
            
        } else{
            require 'modalA.php';
        }  
    ?>
    <!-- Aquí abajo se incluyen los navbar -->
    <div id="print">
        <div class="container-fluid">             
        <ol class="breadcrumb">
                <li><a href="home.php">Inicio</a></li>
                <li><a href="" onClick="location.reload();">Reporte A</a></li>
            <div class="pull-right" style="margin-left:2px; margin-right:0; color:#00aaff;" >
                <li onClick="window.print();"><a><i class="glyphicon glyphicon-print"></i></a></li>
            </div>
        </ol>
        </div>
        <div class="row table-responsive">
            <div class="col-lg-2 col-md-2 col-sm-12 col-xs-12">        
            </div>
            <div class="col-lg-8 col-md-8 col-sm-12 col-xs-12 " style="text-align:center;"> 
                <center>
                    <p>
                        <h5>UNIVERSIDAD TECNOLÓGICA DE PANAMÁ</h5>
                        <h5 id="mayus">FACULTAD DE <?php echo $row6['facultad']; ?></h5>
                        <h5>VICEDECANATO DE INVESTIGACIÓN POSTGRADO Y EXTENSIÓN</h5>
                        <h5>COORDINACIÓN DE POSTGRADO</h5>
                    </p>
                    <h3><b>CALENDARIO DE PAGO</b></h3>
                </center>
            </div>
            <div class="col-lg-2 col-md-2 col-sm-12 col-xs-12">
            </div>
        </div>
        <form action="" target="_blank" name="formulario" method="POST">
            <div style="padding-left:90px;margin:auto;" id="prog">                
                    <p><ol><b>PROGRAMA: </b><span id="mayus"><input type="checkbox" checked disabled> <?php echo " ".$row2['nombre_carrera'];?></span>
                    </p>
                    <p>
                    <b>
                    PERÍODO: </b> 
                    <span id="mayus"><input type="checkbox" checked disabled> <?php echo " ".$var4;?></span>
                    <br></p>    
            </div>
            <span ><h4 style="padding-left:125px;padding-right:110px;"><?php echo " ".$var5;?></h4> </span>
                    
            <center>
                <p>
                    <b><?php echo $var66;?></span></b>
                <p>
            </center>           
            <div class="tab-content">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 table-responsive" >
                    <table id="tablas" >
                        <tr>
                            <th><h4><b>ACTIVIDADES</b></h4></th>
                            <th><h4><b>FECHAS</b></h4></th> 
                        </tr>
                        <tr>
                            <td>ASIGNATURA</td>
                            <td id="mayus"> <!-- SELECTS DE ASIGNATURA-->
                            <?php if (!isset($row4)){

                                echo "1. ".$row3['nombre_asig']; 

                            }else{?>
                                                                    
                            <?php 
                                echo "1. ".$row3['nombre_asig']; 
                                echo "<br>"."2. ".$row4['nombre_asig']; 
                            }?>
                            </td>
                        </tr>
                        <?php 
                            $formato_de_un_pago = strftime("%d de %B", strtotime($fechas[1]['fa']))." al ".strftime("%d de %B de %Y", strtotime($fechas[1]['fb']));
                            $formato_de_dos_pagos = strftime("%d de %B", strtotime($fechas[2]['fa']))." al ".strftime("%d de %B de %Y", strtotime($fechas[2]['fb']));
                            $formato_de_tres_pagos = strftime("%d de %B", strtotime($fechas[3]['fa']))." al ".strftime("%d de %B de %Y", strtotime($fechas[3]['fb']));

                                if($var7 == 1){?>
                                <tr>
                                    <td>  PRIMER PAGO: PAGO TOTAL CON DESCUENTO DEL 5% <li>PAGO DE LA MATRÍCULA</li></td>
                                    <td><?php echo $formato_de_un_pago;?></td>
                                    </tr>
                                <?php
                                }elseif($var7 == 2){?>
                                <tr>
                                    <td>PRIMER PAGO: PAGO TOTAL CON DESCUENTO DEL 5% <li>PAGO DEL 1/2 DE LA MATRÍCULA</li></td>
                                    <td><?php echo $formato_de_un_pago;?></td>
                                    </tr>
                                <tr>
                                    <td>SEGUNDO PAGO: <li>PAGO DEL 1/2 DE LA MATRÍCULA</li></td> 
                                    <td><?php echo $formato_de_dos_pagos;?></td>
                                </tr>
                                <?php
                                }else{?>
                                <tr>
                                    <td>PRIMER PAGO: PAGO TOTAL CON DESCUENTO DEL 5%   <li>PAGO DEL 1/3 DE LA MATRÍCULA</li></td>
                                    <td><?php echo $formato_de_un_pago;?></td>
                                    </tr>
                                <tr>
                                    <td>SEGUNDO PAGO: <li>PAGO DEL 1/3 DE LA MATRÍCULA</li></td> 
                                    <td><?php echo $formato_de_dos_pagos;?></td>
                                </tr>
                                <tr>
                                    <td>TERCER PAGO: <li>PAGO DEL 1/3 DE LA MATRÍCULA</li></td>
                                    <td><?php echo $formato_de_tres_pagos;?></td>
                                </tr>
                        <?php }?>
                        <tr>
                            <td>MATRÍCULA</td>
                            <td><?php echo strftime("%d", strtotime($fechas[4]['fa']))." al ".strftime("%d de %B de %Y", strtotime($fechas[4]['fb']));?></td>
                        </tr>
                        <tr>
                            <td>INICIO DE CLASES</td>
                            <td><?php echo strftime("%d de %B", strtotime($fechas[5]['fa']))." al ".strftime("%d de %B de %Y", strtotime($fechas[5]['fb']));?></td>
                        </tr>
                        <tr>
                            <td>DURACIÓN BRUTA</td>
                            <td><div id="display"></div><input onchange="getDisplay3()" type="text" id="duracion" name="duracion"style="border:0;text-align: center;width:80px;"> </td>
                        </tr>
                        <tr>
                            <td>RETIRO E INCLUSIÓN</td>
                            <td><?php echo strftime("%d", strtotime($fechas[6]['fa']))." y ".strftime("%d de %B de %Y", strtotime($fechas[6]['fb']));?></td>
                        </tr>
                        <tr>
                            <td>RETIRO FUERA DEL PERÍODO</td>
                            <td><?php echo strftime("%d", strtotime($fechas[7]['fa']))." y ".strftime("%d de %B de %Y", strtotime($fechas[7]['fb']));?></td>
                        </tr>
                        <tr>
                            <td>RETIRO TOTAL</td>
                            <td><?php echo strftime("%d", strtotime($fechas[8]['fa']))." al ".strftime("%d de %B de %Y", strtotime($fechas[8]['fb']));?></td>
                        </tr>
                        <tr>
                            <td>SITIO DE LA MATRÍCULA</td>
                            <td>http://matricula.utp.ac.pa</td>
                        </tr>
                    </table>
                    <div id="nota">
                        <h5><b>NOTA: SI NO CANCELA EN LAS FECHAS INDICADAS SE LE COBRARÁ UN RECARGO DEL 25%

                                            SE ACEPTA SOLAMENTE EFECTIVO PARA EL PAGO.
                            </b></h5>
                    </div>
                    </div></div></div>
                </div>
                <div id="botones" class="col-lg-12 col-md-12 col-sm-12 col-xs-12 " style="text-align:center;">
                    <button onClick="location.reload();" value="RECARGAR PÁGINA"  style="width: 300px; height: 48px; background: #6699FF; color: #ffffff; cursor: pointer; border: 0px;">RECARGAR</button>
                    <button type="submit" class="btn btn-success" onClick="getDisplay3();printContent('print');" style="width: 300px; height: 48px; background: green; color: #ffffff; cursor: pointer; border: 0px;">IMPRIMIR</button>
                </div> 
            </div>
        </div>
    </form>
    <br>
    <script type="text/javascript">
        $(function(){
            $("#myModal2").modal();
        });
    </script>
    <script>
        $("[data-toggle=popover]")
        .popover({html:true})
    </script>
    <p>&nbsp;</p>
    <p>&nbsp;</p>
</body>
    <?php include_once 'footer.php'; ?>
</html>
<?php }
else{
  header("Location:cerrar_session.php");
}
?>
