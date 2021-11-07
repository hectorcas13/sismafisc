<?php

require 'conexion.php';
require 'scripts.php';//Este importa los scripts de la página scripts.php
session_start();

if(isset($_SESSION['u_usuario'])){ 

    $var_sesion = $_SESSION['u_usuario'];
    $sql8 = "SELECT id_user FROM usuario WHERE usuario = '$var_sesion';";
    $resultado8 = $mysqli->query($sql8);
    $row8= $resultado8->fetch_array(MYSQLI_ASSOC);

    // recibe las variables del modal
    $var1 = isset($_POST['var1_reporte1']) ? $_POST['var1_reporte1'] : null; //carrera 
    $var2 = isset($_POST['var4_reporte1']) ? $_POST['var4_reporte1']: null; //asignatura
    $var3 = isset($_POST['reporte1profe']) ? $_POST['reporte1profe']: null; //profesor
    $var4 = isset($_POST['periodo']) ? $_POST['periodo']: null; //período
    $campo4 = isset($_POST["varfacultad"]) ? $_POST["varfacultad"] : 0;
    $var5 = isset($_POST['ubicacion']) ? $_POST['ubicacion']: null; //Ubicación
    $var6 = isset($_POST['grupo']) ? $_POST['grupo']: null; //Grupo

    // contador de estudiantes en una asignatura
    $sql1 = "SELECT DISTINCT COUNT(`estudiantes_id_estu`) as contar
    FROM `asignatura_has_estudiantes` WHERE `asignatura_id_asig` = '$var2';";
    $resultado1 = $mysqli->query($sql1);
    $row1 = mysqli_fetch_array($resultado1);

    $sql2 = "SELECT * from carrera WHERE idcarrera = '$var1'";
    $resultado2 = $mysqli->query($sql2);
    $row2 = mysqli_fetch_array($resultado2); 

    $sql3 = "SELECT * from asignatura WHERE id_asig = '$var2'";
    $resultado3 = $mysqli->query($sql3);
    $row3 = mysqli_fetch_array($resultado3); 

    $sql4 = "SELECT * from profesor WHERE id_profesor = '$var3'";
    $resultado4 = $mysqli->query($sql4);
    $row4 = mysqli_fetch_array($resultado4);

    $sql5 = "SELECT COUNT(exoneracion) AS estado_no_exonerados
    FROM estudiantes E 
    INNER JOIN asignatura_has_estudiantes AHE
    ON E.id_estu = AHE.estudiantes_id_estu
    INNER JOIN asignatura A 
    ON A.id_asig = AHE.asignatura_id_asig
    WHERE E.exoneracion = 1 AND A.id_asig = $var2;";
    $resultado5 = $mysqli->query($sql5);
    if ($resultado5 == null){
        $row5 = null;}
    else{
        $row5 = mysqli_fetch_array($resultado5);
    }

    $sql6 = "SELECT COUNT(exoneracion) AS estado_exonerados_50
    FROM estudiantes E 
    INNER JOIN asignatura_has_estudiantes AHE
    ON E.id_estu = AHE.estudiantes_id_estu
    INNER JOIN asignatura A 
    ON A.id_asig = AHE.asignatura_id_asig
    WHERE E.exoneracion = 2 AND A.id_asig = $var2;";
    $resultado6 = $mysqli->query($sql6);
    if($resultado6 == null){
        $row6 = null;
    }else{
    $row6 = mysqli_fetch_array($resultado6);}

    $sql7 = "SELECT COUNT(exoneracion) AS estado_exonerados_25
    FROM estudiantes E 
    INNER JOIN asignatura_has_estudiantes AHE
    ON E.id_estu = AHE.estudiantes_id_estu
    INNER JOIN asignatura A 
    ON A.id_asig = AHE.asignatura_id_asig
    WHERE E.exoneracion = 3 AND A.id_asig = $var2;";
    $resultado7 = $mysqli->query($sql7);
    if ($resultado7 == null){
        $row7 = null;
    }else{
    $row7 = mysqli_fetch_array($resultado7);}

    $var_lab1 = $row3['lab']; // Nos trae la consulta de si la materia tiene laboratorio
    $sql9 = "SELECT costo_lab from costo_lab where id_lab = '$var_lab1'";
    $resultado9 = $mysqli->query($sql9);
    $row9 = mysqli_fetch_array($resultado9);

    $sql10 = "SELECT * from costo_asig;";
    $resultado10 = $mysqli->query($sql10);
    $row10 = mysqli_fetch_array($resultado10);

    $var_lab2 = $row9['costo_lab']; //Nos trae el costo de la tabla costo_lab, si tiene algún costo el laboratorio
    $varlab_total = number_format($row1['contar'] * $var_lab2,2);
    $costo_parcial_asig = $row10['costo_materia']; // Costo de la materia que multiplica las variables de abajo
    $noexo_ingresos = number_format($row3['creditos']*$costo_parcial_asig*$row5['estado_no_exonerados'],2);
    $exo50_ingresos = number_format(($row6['estado_exonerados_50'] * (0.5 * $costo_parcial_asig * $row3['creditos'])),2);
    $exo25_ingresos = number_format(($row7['estado_exonerados_25'] * (0.25 * $costo_parcial_asig * $row3['creditos'])),2);
    $total_ingresos = number_format($noexo_ingresos + $exo50_ingresos + $exo25_ingresos + $varlab_total,2);

    $sql11 = "SELECT facultad FROM facultad WHERE id = '$campo4';";
    $resultado11 = $mysqli->query($sql11);
    $row11 = $resultado11->fetch_array(MYSQLI_ASSOC);

    /* La variable var_javascript se declaro en php y se paso a javascript para que el algoritmo pueda ser restado mas abajo*/
    /* Esta variable var_javascript toma el registro del total de ingresos que es calculado automaticamente con las formulas proporcionadas */
    echo "<script>\n";
    echo "var_javascript='".number_format($total_ingresos,2)."'\n";
    echo "</script>\n";
?>
<html lang="es">
<head> 

<?php

    if(!isset($_POST["reporte1profe"])){
        echo '<title>Reporte D</title>';
    }else{
        
        $n=$row4['nom_prof'];
        $l=$row4['ape_prof'];
        $ra = "_";
        $rm = "-";
        $año = Date("Y");
        echo "<title>cuadro-$n$ra$l$rm$var6$rm$año</title>";
 }?>
</head>
<body>
<!-- Modal -->

<?php include 'navbar.php';
    
    if(empty($_POST["varfacultad"]) || empty($_POST["var1_reporte1"]) || empty($_POST["var4_reporte1"]) || empty($_POST["reporte1profe"]) ){
        require 'modalD.php';
    } else{
        
    }  
?>
    <!-- Aquí abajo se incluyen los navbar -->
   
    <div id="print">
    <!-- breadcrumbs -->
    <div class="container-fluid">               
      <ol class="breadcrumb">
        <li><a href="home.php">Inicio</a></li>
        <li><a href="" onClick="location.reload();">Reporte 4</a></li>
        <div class="pull-right" style="margin-right:0; color:#00aaff;" >
            <li onClick="window.print();"><a><i class="glyphicon glyphicon-print"></i></a></li>
        </div> 
      </ol>
    </div>
    <div class="row" >
        
        <div class="col-md-12 col-lg-12 col-sm-12">
            <!-- primer parrafo de entrada -->
                <div style="text-align:center;">
                    <br><br>
                    <h4>UNIVERSIDAD TECNOLÓGICA DE PANAMÁ</h4>
                    <h4>VICERRECTORIA DE INVESTIGACIÓN, POSTGRADO Y EXTENSIÓN</h4>
                    <h4>UNIVERSIDAD TECNOLÓGICA DE PANAMÁ</h4>
                    <h4>CUADRO DE INGRESOS Y EGRESOS</h4>
                    <br />
                </div>
                
            <div class="container-fluid">
                <form action="" method="POST" id="f1" name="f1"> <!-- no quitar los f1, son con lo que llamamos al javascript para la suma de total egresos y resultado -->
                    <!-- segundo parrafo -->
                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12" >
                        <p>PARA EL PERÍODO ACADÉMICO: <?php echo $var4." ".date("Y");?> </p>
                        <p>UBICACIÓN:<span id="mayus"> <?php echo $var5?></span> </p>
                        <p><span id="mayus"><?php echo $row11['facultad']; ?></span> </p>                        
                        <p>PROGRAMA: <span id="mayus"><?php echo $row2['nombre_carrera']; ?></span></p>  
                        
                    </div>
                    
            <!-- puse los estilos css aqui, por alguna razon no se imprimía con el formato puesto -->
            <style>
                        @media print {

                                body {
                                    margin: 0;
                                    padding-left:20px;
                                }
                                input {
                                    display: none;
                                }
                                #display{
                                    display:inline-flex !important;
                                }
                                #display2{
                                    display:inline-flex !important;   
                                }
                                #display3{
                                    display:inline-flex !important;
                                }
                                .breadcrumb{
                                    display:none;
                                }
                                #customers td, #customers th {
                              
                                    font-size: 11px !important;
                                }
                                #margen{
                                    margin-top:-55px;
                                }
                            }
                
                        @page {
                            size:   29cm 21.59cm;                            
                            }
                            #mayus{
                            text-transform: uppercase;
                            }

                            #formularios{
                            border: 1px solid lightskyblue;
                            display: inline-block;
                            border-style: dashed;  
                            }
                            #formularios:hover{
                            background-color:#f2f2f2;
                            }

                            .dot {
                            height: 12px;
                            width: 12px;
                            background-color: #bbb;
                            border-radius: 50%;
                            display: inline-block;
                            background-color: green;
                            padding-bottom: 8px;
                            border-style: groove;
                            border-width: 1px;
                            }
                            #customers {
                            font-family: "Arial";
                            border-collapse: collapse;
                            
                            }
                            #customers td, #customers th {
                            border: 2px solid #ddd;
                            border-color:black;
                            /* padding: 10px; */
                            font-size: 12px;
                            }
                            #customers tr:hover {
                            background-color: royalblue;
                            }
                            #customers th {
                            text-align: center;
                            font-size: 12px;
                            }
                            button{
                            border:2px groove  darkcyan ;
                            }
                            .btn{
                            width:300px;
                            height:50px ;
                            }
                            td{
                                text-align:center;
                            }
                            #display{
                                display:none;
                            }
                            #display2{
                                display:none;    
                            }
                            #display3{
                                display:none;
                            }

            </style>
            <div class="container-fluid">
                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                        <br><br>
                        <!--AQUÍ EMPIEZA LA TABLA -->
                        <div class="row table-responsive" style="text-align:center;">
                            <table id="customers">
                                <tr>
                                    <th colspan="4" style="border:0;"></th>
                                    <th colspan="2">No Exonerados</th>
                                    <th colspan="2">Exonerados al 50%</th>
                                    <th colspan="2">Exonerados al 25%</th>
                                </tr>
                                <tr>
                                    <th>
                                        Asignatura
                                    </th>
                                    <th>
                                        Grupos
                                    </th>
                                    <th>
                                        <p>Estudiantes</p>
                                        <p>Matriculados</p> 
                                    </th>
                                    <th>
                                        <p>Número</p>
                                        <p>de créditos</p>
                                    </th>
                                    <th>
                                        <p>Cantidad</p>
                                    </th>
                                    <th>
                                        <p>Ingresos</p>
                                        <p>B/.</p>
                                    </th>
                                    <th>
                                        <p>Cantidad</p>
                                    </th>
                                    <th>
                                        <p>Ingresos</p>
                                        <p>B/.</p>
                                    </th>
                                    <th>
                                        <p>Cantidad</p>
                                    </th>
                                    <th>
                                        <p>Ingresos</p>
                                        <p>B/.</p>
                                    </th>
                                    <th>
                                        <p>Laboratorio</p>
                                    </th>
                                    <th>
                                        <p>Total</p>
                                        <p>Ingresos</p>
                                        <p>B/.</p>
                                    </th>
                                    <th>
                                        <p>Número</p>
                                        <p>de Modulo</p>
                                    </th>
                                    <th>
                                        <p>Salario</p>
                                        <p>B/.</p>
                                    </th>
                                    <th>
                                        <p>Profesor</p>
                                    </th>
                                    <th>
                                        <p>Otros Egresos</p>
                                        <p>B/.</p>
                                    </th>
                                    <th>
                                        <p>Total Egresos</p>
                                        <p>B/.</p>
                                    </th>
                                    <th>
                                        <p>Resultado</p>
                                        <p>B/.</p>
                                    </th>
                                </tr>   
                                <tr>
                                    <td id="mayus" ><?php echo $row3['nombre_asig']; ?></td>
                                    <td id="mayus"><?php echo $var6 ;?></td>
                                    <td><?php echo $row1['contar'] ?></td>
                                    <td><?php echo $row3['creditos'] ?></td>
                                    <td><?php echo $row5['estado_no_exonerados']; ?></td>
                                    <td><?php echo $noexo_ingresos;?></td>
                                    <td><?php echo $row6['estado_exonerados_50']; ?></td>
                                    <td><?php echo $exo50_ingresos; ?></td>
                                    <td><?php echo $row7['estado_exonerados_25']; ?></td>
                                    <td><?php echo $exo25_ingresos;  ?></td>
                                    <td><?php echo $varlab_total ?></td>
                                    <td id="toting"><?php echo $total_ingresos;?></td>
                                    <td><div id="display2"></div><input onchange="DisplayC3()" type="text" id="manual2" class="input-sm" style="border:0;width:60px;text-align:center;"></td>
                                    <td><div id="display"></div><input onchange="DisplayC3();sumar();"name="salario" id="manual" type="number"  min="0" max="99999" style="width: 100px;border:0;text-align:center;" class="input-sm"  required></td>
                                    <td id="mayus"><?php echo $row4['nom_prof'].' '.$row4['ape_prof']; ?></td>
                                    <td><div id="display3"></div><input onchange="DisplayC3();sumar();" type="number" id="manual3" name="otros_egresos"  min="0" max="99999" style="width: 100px;border:0;text-align:center;" class="input-sm" required></td>
                                    <td><span id="resultado" name="resultado">0.00</span></td>
                                    <td><span id="demo">0.00</span></td>
                                </tr>
                            </table>
                        </div>
                        <br><br><br><br>
                    </div> <!-- se acaba la timezone_abbreviations_list -->
            </div>     
                    
                    <!-- empieza la sección de firmas -->
                    
                    <div class="col-md-6 col-lg-6 col-sm-12 col-xs-12" style="">
                        <div class="row" style="text-align:left;">
                            <p>_____________________________________</p>
                            <p>Firma de la Coordinadora de Postgrado</p>
                        </div>
                    </div>    
                    <div class="col-md-6 col-lg-6 col-sm-12 col-xs-12" >
                        <div class="row" style="float:right;" id="margen">
                        <p>_____________________________________</p>
                        <p style="padding-left:70px">Sello de la Facultad</p>
                        </div>                       
                    </div>
            </div>
        </div>
        </div> </div> </div> </div> <!-- este div indica hasta donde se va a imprimir --> <br><br><br>
                <!-- botones -->
                <div>
                    <center>
                    <input type="button" value="RECARGAR PÁGINA" onClick="location.reload();" style="width: 300px; height: 48px; background: #6699FF; color: #ffffff; cursor: pointer; border: 0px;"/>
                    <button type="submit"  class="btn btn-success" onClick="printContent('print');">IMPRIMIR</button>
                    </center>
                </div>        
                </form>
                <p>&nbsp;</p>
                <p>&nbsp;</p>
                <p>&nbsp;</p>
                <p>&nbsp;</p>
                <p>&nbsp;</p>
                <p>&nbsp;</p>
            </div>
        </div>
    </div>

    <script type="text/javascript">
        $(function(){
            $("#myModal2").modal();
        });
    </script>
    <script>
        $("[data-toggle=popover]")
        .popover({html:true});
    </script>
    <script>
        /* Este codigo suma el salario y otros egresos y lo pone en la fila de total egresos*/
            function sumar(){
            a = 0.00
            b = 0.00
            a = document.f1.salario.value;
            b = document.f1.otros_egresos.value;
            total = parseFloat(a) + parseFloat(b);           
            document.getElementById("resultado").innerHTML = total.toFixed(2);          
            
            /* De aquí para abajo se toman las variables se convierten a numeros y se restan en el total*/
            var var1 = parseFloat(var_javascript);
            var var2 = parseFloat(total);
            var var3 = var1 - var2;
            document.getElementById("demo").innerHTML = var3.toFixed(2);
        };
    </script>
 <?php include_once 'footer.php'; ?>
</body>
</html>
<?php }
else{
  header("Location:cerrar_session.php");
}
?>