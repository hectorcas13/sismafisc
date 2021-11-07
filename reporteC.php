<?php

    require 'conexion.php';
    require 'scripts.php';//Este importa los scripts de la página scripts.php 
    session_start();
    if(isset($_SESSION['u_usuario'])){ 

        $campo1 = isset($_POST["var1_reporte1"]) ? $_POST["var1_reporte1"] : 0; 
        $campo2 = isset($_POST["var4_reporte1"]) ? $_POST["var4_reporte1"] : 0;
        $campo22 = isset($_POST["var444_reporte1"]) ? $_POST["var444_reporte1"] : 0;
        $campo3 = isset($_POST["reporte1profe"]) ? $_POST["reporte1profe"] : 0;  
        $campo33 = isset($_POST["reporte2profe"]) ? $_POST["reporte2profe"] : 0;
        $campo4 = isset($_POST["varfacultad"]) ? $_POST["varfacultad"] : 0;
        $campo5 = isset($_POST["semestre"]) ? $_POST["semestre"] : NULL;
        $campo6 = isset($_POST["grupo"]) ? $_POST["grupo"] : NULL;
        $campo7 = isset($_POST["parrafo"]) ? $_POST["parrafo"] : NULL;

        $sql3 = "SELECT * FROM carrera WHERE idcarrera = '$campo1';";
        $resultado3 = $mysqli->query($sql3);
        $row3 = $resultado3->fetch_array(MYSQLI_ASSOC);

        $sql4 = "SELECT * FROM asignatura WHERE id_asig = '$campo2';";
        $resultado4 = $mysqli->query($sql4);
        $row4 = $resultado4->fetch_array(MYSQLI_ASSOC);

        $sql5 = "SELECT * FROM profesor WHERE id_profesor = '$campo3';";
        $resultado5 = $mysqli->query($sql5);
        $row5 = $resultado5->fetch_array(MYSQLI_ASSOC);

        $sql6 = "SELECT * FROM asignatura WHERE id_asig = '$campo22';";
        $resultado6 = $mysqli->query($sql6);
        $row6 = $resultado6->fetch_array(MYSQLI_ASSOC);

        $sql7 = "SELECT * FROM profesor WHERE id_profesor = '$campo33';";
        $resultado7 = $mysqli->query($sql7);
        $row7 = $resultado7->fetch_array(MYSQLI_ASSOC);

        $sql8 = "SELECT facultad FROM facultad WHERE id = '$campo4';";
        $resultado8 = $mysqli->query($sql8);
        $row8 = $resultado8->fetch_array(MYSQLI_ASSOC);
?>
<html lang="es">
<head> 

<?php

if(!isset($_POST["var4_reporte1"])){
    echo '<title>Reporte C</title>';
}else{
    $a=$row4["nombre_asig"];
    $n=$row5['nom_prof'];
    $l=$row5['ape_prof'];
    $ra = "_";
    $rm = "-";
    $año = Date("Y");
    echo "<title>hor-$a$rm$n$ra$l$año.</title>";
 }?>
    


        <link rel="stylesheet" href="css/reporte3.css">
        <link rel="stylesheet" href="css/cal.css">
        <?php include 'navbar.php'; ?>
</head>
<body>
    <!-- Aquí abajo se incluyen los navbar -->
    <?php 
        
        if(isset($_POST["var1_reporte1"]) || isset($_POST["var4_reporte1"]) || isset($_POST["reporte1profe"]) || isset($_POST["varfacultad"]) ){
        } else{
            require 'modalC.php';
        }  
    ?>
    <div id="print">              
        <ol class="breadcrumb">
                <li><a href="home.php">Inicio</a></li>
                <li><a href="" onClick="location.reload();">Reporte C</a></li>  
            <div class="pull-right" style="margin-right:0; color:#00aaff;" >
                    <li onClick="window.print();"><a><i class="glyphicon glyphicon-print"></i></a></li>
            </div>
        </ol>
    
        <div class="container-fluid"> 
            <div class="row col-lg-12 col-md-12 col-sm-12 col-xs-12" style="text-align:center;">

                <p style="margin-left:auto; margin-right:auto;">
                    <h5>UNIVERSIDAD TECNOLÓGICA DE PANAMÁ</h5>
                    <h5>COORDINACIÓN DE POSTGRADO </h5>
                    <!-- Se escoge la carrera -->
                    <h5 id="mayus">PROGRAMA DE  <?php echo $row3['nombre_carrera'];?></h5>
                    <!-- se escogen las materias -->
                    <h5 id="mayus"><?php echo $row4['nombre_asig'];?></h5>
                    <?php if($campo22 == 0 && $campo33 == 0){
                        
                    }else{?>
                    <h5 id="mayus">
                        <?php  
                            echo ' Y ';   
                            echo '<br>';
                            echo $row6['nombre_asig'];
                        ?>
                    </h5>

                    <?php  }?>
                    <h3><b>HORARIO DE CLASES</b></h3>
                </p >
              
            </div>
            </div>
            <form action="" target="_blank" method="POST">
                <div class="container-fluid">
                    <div class="row" style="">
                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12" style="text-align:left;">

                                <p id="mayus"><b>Facultad:  </b><?php echo $row8['facultad']; ?>

                                <span style="float:right;padding-right:84px;"><label for="">Año:  </label>  <?php echo date("Y"); ?></span></p>  

                                <p id="mayus"><b>Grupo: </b> <?php echo $campo6;?>
  

                                                                    
                                <span style="float:right"><label for="">Semestre: </label> <?php echo $campo5;?></span></p>
                        </div>
                    </div>
                </div>

            
            <!--El horario del reporte esta en orden en el grid según se imprime en pantalla-->
            <div class="container-fluid">
                <div class="row col-lg-12 col-md-12 col-sm-12 col-xs-12" style="margin-left:auto;margin-right:auto;">
                    <div class="grid-container table-responsive" id="mayus">
                    <div class="grid-item">hora</div> <div class="grid-item">Lunes</div> <div class="grid-item">martes</div><div class="grid-item">miércoles</div><div class="grid-item">jueves</div><div class="grid-item">viernes</div><div class="grid-item">sábado</div>
                    <div class="grid-item">07:00am - 07:55am</div><div class="grid-item"><div id="grid-lunes07am"></div><input onchange="Cal()" maxlength="2" size ="1" type="text" id="lunes07am" ></div><div class="grid-item"><div id="grid-martes07am"></div><input onchange="Cal()"  maxlength="2" size ="1" type="text" id="martes07am" ></div><div class="grid-item"><div id="grid-miercoles07am"></div><input onchange="Cal()"  maxlength="2" size ="1" type="text" id="miercoles07am" ></div><div class="grid-item"><div id="grid-jueves07am"></div><input onchange="Cal()"  maxlength="2" size ="1" type="text" id="jueves07am" ></div><div class="grid-item"><div id="grid-viernes07am"></div><input onchange="Cal()"  maxlength="2" size ="1" type="text" id="viernes07am" ></div><div class="grid-item"><div id="grid-sabado07am"></div><input onchange="Cal()"  maxlength="2" size="1" type="text" id="sabado07am" ></div>
                    <div class="grid-item">08:00am - 08:55am</div><div class="grid-item"><div id="grid-lunes08am"></div><input onchange="Cal()" maxlength="2" size ="1" type="text" id="lunes08am" ></div><div class="grid-item"><div id="grid-martes08am"></div><input onchange="Cal()"  maxlength="2" size ="1" type="text" id="martes08am" ></div><div class="grid-item"><div id="grid-miercoles08am"></div><input onchange="Cal()"  maxlength="2"  size="1" type="text" id="miercoles08am" ></div><div class="grid-item"><div id="grid-jueves08am"></div><input onchange="Cal()"  maxlength="2" size ="1" type="text" id="jueves08am" ></div><div class="grid-item"><div id="grid-viernes08am"></div><input onchange="Cal()"  maxlength="2" size ="1" type="text" id="viernes08am" ></div><div class="grid-item"><div id="grid-sabado08am"></div><input onchange="Cal()"  maxlength="2" size="1" type="text" id="sabado08am" ></div>
                    <div class="grid-item">09:00am - 09:55am</div><div class="grid-item"><div id="grid-lunes09am"></div><input onchange="Cal()" maxlength="2" size ="1" type="text" id="lunes09am" ></div><div class="grid-item"><div id="grid-martes09am"></div><input onchange="Cal()"  maxlength="2" size ="1" type="text" id="martes09am" ></div><div class="grid-item"><div id="grid-miercoles09am"></div><input onchange="Cal()"  maxlength="2"  size="1" type="text" id="miercoles09am" ></div><div class="grid-item"><div id="grid-jueves09am"></div><input onchange="Cal()"  maxlength="2" size ="1" type="text" id="jueves09am" ></div><div class="grid-item"><div id="grid-viernes09am"></div><input onchange="Cal()"  maxlength="2" size ="1" type="text" id="viernes09am" ></div><div class="grid-item"><div id="grid-sabado09am"></div><input onchange="Cal()"  maxlength="2" size="1" type="text" id="sabado09am" ></div>
                    <div class="grid-item">10:00am - 10:55am</div><div class="grid-item"><div id="grid-lunes10am"></div><input onchange="Cal()" maxlength="2" size ="1" type="text" id="lunes10am" ></div><div class="grid-item"><div id="grid-martes10am"></div><input onchange="Cal()"  maxlength="2" size ="1" type="text" id="martes10am" ></div><div class="grid-item"><div id="grid-miercoles10am"></div><input onchange="Cal()"  maxlength="2"  size="1" type="text" id="miercoles10am" ></div><div class="grid-item"><div id="grid-jueves10am"></div><input onchange="Cal()"  maxlength="2" size ="1" type="text" id="jueves10am" ></div><div class="grid-item"><div id="grid-viernes10am"></div><input onchange="Cal()"  maxlength="2" size ="1" type="text" id="viernes10am" ></div><div class="grid-item"><div id="grid-sabado10am"></div><input onchange="Cal()"  maxlength="2" size="1" type="text" id="sabado10am" ></div>
                    <div class="grid-item">11:00am - 11:55am</div><div class="grid-item"><div id="grid-lunes11am"></div><input onchange="Cal()" maxlength="2" size ="1" type="text" id="lunes11am" ></div><div class="grid-item"><div id="grid-martes11am"></div><input onchange="Cal()"  maxlength="2" size ="1" type="text" id="martes11am" ></div><div class="grid-item"><div id="grid-miercoles11am"></div><input onchange="Cal()"  maxlength="2"  size="1" type="text" id="miercoles11am" ></div><div class="grid-item"><div id="grid-jueves11am"></div><input onchange="Cal()"  maxlength="2" size ="1" type="text" id="jueves11am" ></div><div class="grid-item"><div id="grid-viernes11am"></div><input onchange="Cal()"  maxlength="2" size ="1" type="text" id="viernes11am" ></div><div class="grid-item"><div id="grid-sabado11am"></div><input onchange="Cal()"  maxlength="2" size="1" type="text" id="sabado11am" ></div>
                    <div class="grid-item">12:00pm - 12:55pm</div><div class="grid-item"><div id="grid-lunes12pm"></div><input onchange="Cal()" maxlength="2" size ="1" type="text" id="lunes12pm" ></div><div class="grid-item"><div id="grid-martes12pm"></div><input onchange="Cal()"  maxlength="2" size ="1" type="text" id="martes12pm" ></div><div class="grid-item"><div id="grid-miercoles12pm"></div><input onchange="Cal()"  maxlength="2"  size="1" type="text" id="miercoles12pm" ></div><div class="grid-item"><div id="grid-jueves12pm"></div><input onchange="Cal()"  maxlength="2" size ="1" type="text" id="jueves12pm" ></div><div class="grid-item"><div id="grid-viernes12pm"></div><input onchange="Cal()"  maxlength="2" size ="1" type="text" id="viernes12pm" ></div><div class="grid-item"><div id="grid-sabado12pm"></div><input onchange="Cal()"  maxlength="2" size="1" type="text" id="sabado12pm" ></div>
                    <div class="grid-item">01:00pm - 01:55pm</div><div class="grid-item"><div id="grid-lunes01pm"></div><input onchange="Cal()" maxlength="2" size ="1" type="text" id="lunes01pm" ></div><div class="grid-item"><div id="grid-martes01pm"></div><input onchange="Cal()"  maxlength="2" size ="1" type="text" id="martes01pm" ></div><div class="grid-item"><div id="grid-miercoles01pm"></div><input onchange="Cal()"  maxlength="2"  size="1" type="text" id="miercoles01pm" ></div><div class="grid-item"><div id="grid-jueves01pm"></div><input onchange="Cal()"  maxlength="2" size ="1" type="text" id="jueves01pm" ></div><div class="grid-item"><div id="grid-viernes01pm"></div><input onchange="Cal()"  maxlength="2" size ="1" type="text" id="viernes01pm" ></div><div class="grid-item"><div id="grid-sabado01pm"></div><input onchange="Cal()"  maxlength="2" size="1" type="text" id="sabado01pm" ></div>
                    <div class="grid-item">02:00pm - 02:55pm</div><div class="grid-item"><div id="grid-lunes02pm"></div><input onchange="Cal()" maxlength="2" size ="1" type="text" id="lunes02pm" ></div><div class="grid-item"><div id="grid-martes02pm"></div><input onchange="Cal()"  maxlength="2" size ="1" type="text" id="martes02pm" ></div><div class="grid-item"><div id="grid-miercoles02pm"></div><input onchange="Cal()"  maxlength="2"  size="1" type="text" id="miercoles02pm" ></div><div class="grid-item"><div id="grid-jueves02pm"></div><input onchange="Cal()"  maxlength="2" size ="1" type="text" id="jueves02pm" ></div><div class="grid-item"><div id="grid-viernes02pm"></div><input onchange="Cal()"  maxlength="2" size ="1" type="text" id="viernes02pm" ></div><div class="grid-item"><div id="grid-sabado02pm"></div><input onchange="Cal()"  maxlength="2" size="1" type="text" id="sabado02pm" ></div>
                    <div class="grid-item">03:00pm - 03:55pm</div><div class="grid-item"><div id="grid-lunes03pm"></div><input onchange="Cal()" maxlength="2" size ="1" type="text" id="lunes03pm" ></div><div class="grid-item"><div id="grid-martes03pm"></div><input onchange="Cal()"  maxlength="2" size ="1" type="text" id="martes03pm" ></div><div class="grid-item"><div id="grid-miercoles03pm"></div><input onchange="Cal()"  maxlength="2"  size="1" type="text" id="miercoles03pm" ></div><div class="grid-item"><div id="grid-jueves03pm"></div><input onchange="Cal()"  maxlength="2" size ="1" type="text" id="jueves03pm" ></div><div class="grid-item"><div id="grid-viernes03pm"></div><input onchange="Cal()"  maxlength="2" size ="1" type="text" id="viernes03pm" ></div><div class="grid-item"><div id="grid-sabado03pm"></div><input onchange="Cal()"  maxlength="2" size="1" type="text" id="sabado03pm" ></div>
                    <div class="grid-item">04:00pm - 04:55pm</div><div class="grid-item"><div id="grid-lunes04pm"></div><input onchange="Cal()" maxlength="2" size ="1" type="text" id="lunes04pm" ></div><div class="grid-item"><div id="grid-martes04pm"></div><input onchange="Cal()"  maxlength="2" size ="1" type="text" id="martes04pm" ></div><div class="grid-item"><div id="grid-miercoles04pm"></div><input onchange="Cal()"  maxlength="2"  size="1" type="text" id="miercoles04pm" ></div><div class="grid-item"><div id="grid-jueves04pm"></div><input onchange="Cal()"  maxlength="2" size ="1" type="text" id="jueves04pm" ></div><div class="grid-item"><div id="grid-viernes04pm"></div><input onchange="Cal()"  maxlength="2" size ="1" type="text" id="viernes04pm" ></div><div class="grid-item"><div id="grid-sabado04pm"></div><input onchange="Cal()"  maxlength="2" size="1" type="text" id="sabado04pm" ></div>
                    <div class="grid-item">05:00pm - 05:55pm</div><div class="grid-item"><div id="grid-lunes05pm"></div><input onchange="Cal()" maxlength="2" size ="1" type="text" id="lunes05pm" ></div><div class="grid-item"><div id="grid-martes05pm"></div><input onchange="Cal()"  maxlength="2" size ="1" type="text" id="martes05pm" ></div><div class="grid-item"><div id="grid-miercoles05pm"></div><input onchange="Cal()"  maxlength="2"  size="1" type="text" id="miercoles05pm" ></div><div class="grid-item"><div id="grid-jueves05pm"></div><input onchange="Cal()"  maxlength="2" size ="1" type="text" id="jueves05pm" ></div><div class="grid-item"><div id="grid-viernes05pm"></div><input onchange="Cal()"  maxlength="2" size ="1" type="text" id="viernes05pm" ></div><div class="grid-item"><div id="grid-sabado05pm"></div><input onchange="Cal()"  maxlength="2" size="1" type="text" id="sabado05pm" ></div>
                    <div class="grid-item">06:00pm - 06:55pm</div><div class="grid-item"><div id="grid-lunes06pm"></div><input onchange="Cal()" maxlength="2" size ="1" type="text" id="lunes06pm" ></div><div class="grid-item"><div id="grid-martes06pm"></div><input onchange="Cal()"  maxlength="2" size ="1" type="text" id="martes06pm" ></div><div class="grid-item"><div id="grid-miercoles06pm"></div><input onchange="Cal()"  maxlength="2"  size="1" type="text" id="miercoles06pm" ></div><div class="grid-item"><div id="grid-jueves06pm"></div><input onchange="Cal()"  maxlength="2" size ="1" type="text" id="jueves06pm" ></div><div class="grid-item"><div id="grid-viernes06pm"></div><input onchange="Cal()"  maxlength="2" size ="1" type="text" id="viernes06pm" ></div><div class="grid-item"><div id="grid-sabado06pm"></div><input onchange="Cal()"  maxlength="2" size="1" type="text" id="sabado06pm" ></div>
                    <div class="grid-item">07:00pm - 07:55pm</div><div class="grid-item"><div id="grid-lunes07pm"></div><input onchange="Cal()" maxlength="2" size ="1" type="text" id="lunes07pm" ></div><div class="grid-item"><div id="grid-martes07pm"></div><input onchange="Cal()"  maxlength="2" size ="1" type="text" id="martes07pm" ></div><div class="grid-item"><div id="grid-miercoles07pm"></div><input onchange="Cal()"  maxlength="2"  size="1" type="text" id="miercoles07pm" ></div><div class="grid-item"><div id="grid-jueves07pm"></div><input onchange="Cal()"  maxlength="2" size ="1" type="text" id="jueves07pm" ></div><div class="grid-item"><div id="grid-viernes07pm"></div><input onchange="Cal()"  maxlength="2" size ="1" type="text" id="viernes07pm" ></div><div class="grid-item"><div id="grid-sabado07pm"></div><input onchange="Cal()"  maxlength="2" size="1" type="text" id="sabado07pm" ></div>
                    <div class="grid-item">08:00pm - 08:55pm</div><div class="grid-item"><div id="grid-lunes08pm"></div><input onchange="Cal()" maxlength="2" size ="1" type="text" id="lunes08pm" ></div><div class="grid-item"><div id="grid-martes08pm"></div><input onchange="Cal()"  maxlength="2" size ="1" type="text" id="martes08pm" ></div><div class="grid-item"><div id="grid-miercoles08pm"></div><input onchange="Cal()"  maxlength="2"  size="1" type="text" id="miercoles08pm" ></div><div class="grid-item"><div id="grid-jueves08pm"></div><input onchange="Cal()"  maxlength="2" size ="1" type="text" id="jueves08pm" ></div><div class="grid-item"><div id="grid-viernes08pm"></div><input onchange="Cal()"  maxlength="2" size ="1" type="text" id="viernes08pm" ></div><div class="grid-item"><div id="grid-sabado08pm"></div><input onchange="Cal()"  maxlength="2" size="1" type="text" id="sabado08pm" ></div>
                    <div class="grid-item">09:00pm - 09:55pm</div><div class="grid-item"><div id="grid-lunes09pm"></div><input onchange="Cal()" maxlength="2" size ="1" type="text" id="lunes09pm" ></div><div class="grid-item"><div id="grid-martes09pm"></div><input onchange="Cal()"  maxlength="2" size ="1" type="text" id="martes09pm" ></div><div class="grid-item"><div id="grid-miercoles09pm"></div><input onchange="Cal()"  maxlength="2"  size="1" type="text" id="miercoles09pm" ></div><div class="grid-item"><div id="grid-jueves09pm"></div><input onchange="Cal()"  maxlength="2" size ="1" type="text" id="jueves09pm" ></div><div class="grid-item"><div id="grid-viernes09pm"></div><input onchange="Cal()"  maxlength="2" size ="1" type="text" id="viernes09pm" ></div><div class="grid-item"><div id="grid-sabado09pm"></div><input onchange="Cal()"  maxlength="2" size="1" type="text" id="sabado09pm" ></div>
                </div>
            </div>
            
            <div class="container-fluid">
                <div class="row table-responsive col-lg-12 col-md-12 col-sm-12 col-xs-12" style="margin-left:auto;margin-right:auto;">
                    <br>
                    <table border="1" >
                        <tr>
                            <th colspan="4" id="colspan">Asignación</th>
                            <th rowspan="2"><br />Cod Hora</th>
                            <th rowspan="2"><br />Profesor</th>
                            <th rowspan="2"><br />Aula</th>
                        </tr>
                        <tr id="br">
                            <th>Abrev</th>
                            <th>No.</th>
                            <th>Denominación</th>
                            <th>Cod Asig.</th>
                        </tr>
                        <tr>
                            <td id="mayus"><?php echo $row4['abre_asig'];?></td> <!--Abrev -->
                            <td>1</td> <!--No. -->
                            <td id="mayus"><?php echo $row4['nombre_asig'];?></td> <!--Materia -->
                            <td id="mayus"><?php echo $row4['cod_asig'];?></td> <!--Código de asignatura -->
                            <td id="mayus"><div id="display1" class="d-none d-print-block"></div><input   onchange="DisplayC()" type="text" size="3" maxlength="4"class="input-sm" id="codhora1"></td> <!-- Código de Hora -->
                            <td><?php echo $row5['nom_prof']." ".$row5['ape_prof'];?></td> <!--Profesor -->
                            <td style="width:200px !important;"><div id="display2"></div><textarea onchange="DisplayC()"  style="border:0;" class="input-sm"  wrap="hard" name="aula1" id="aula1" cols="30" rows="3" maxlength="90" >Salón --- Edificio ---</textarea></td> <!--Aula -->
                        </tr>
                        <?php if($campo22 == 0 || $campo33 == 0){
                        }else{?>
                        <tr>
                            <td id="mayus"><?php echo $row6['abre_asig'];?></td> <!--Abrev -->
                            <td>2</td> <!--No. -->
                            <td id="mayus"><?php echo $row6['nombre_asig'];?></td> <!--Materia -->
                            <td id="mayus"><?php echo $row6['cod_asig'];?></td> <!--Código de asignatura -->
                            <td id="mayus"><div id="display3"></div><input onchange="DisplayC()" type="text" size="3" maxlength="4" class="input-sm" id="codhora2"></td> <!-- Código de Hora -->
                            <td><?php echo $row7['nom_prof']." ".$row7['ape_prof'];?></td> <!--Profesor -->
                            <td style="width:200px !important;"><div id="display4"></div><textarea onchange="DisplayC()"  style="border:0;" class="input-sm"  wrap="hard" name="aula2" id="aula2" cols="30" rows="3" maxlength="90">Salón --- Edificio ---</textarea></td> <!--Aula -->
                        </tr>

                        <?php  }?>

                    </table>
                </div>
            </div>
            <div class="row" style="margin-right:auto;margin-left:auto;">
                <div>
                    <h4><?php echo $campo7;?></h4>
                </div>
            </div>
        </div>
    </div></div>  <!-- hasta aquí se imprime -->
            <div class="col-lg-12 col-md-12">
                <div class="row" style="text-align:center;">
                    <a href="" onClick="location.reload();"><input type="button" value="RECARGAR PÁGINA"  style="width: 300px; height: 48px; background: #6699FF; color: #ffffff; cursor: pointer; border: 0px;"/></a>
                    <button type="submit" class="btn btn-success" onClick="printContent('print');">IMPRIMIR</button>
                    
                </div>                  
            </div>
        </form>               
    <p>&nbsp;</p>
    <p>&nbsp;</p>
    <p>&nbsp;</p>
    <p>&nbsp;</p>
 
   <script>
        $("[data-toggle=popover]")
        .popover({html:true})


  </script>
</body>
<?php include_once 'footer.php'; ?>
</html>
<?php }
else{
  header("Location:cerrar_session.php");
}
?>
