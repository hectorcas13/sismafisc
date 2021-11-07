<!-- Modal -->
<div class="modal fade in" id="myModal2" role="dialog" style="display: block; padding-right: 17px;">
  <div class="modal-dialog"><!-- Modal content-->
    <div class="modal-content">
      
        <div class="modal-header"  style="background-color:#b3ccff;color:white;">
            <h2>SELECCIONE SUS OPCIONES</h2>
        </div>
        <center>
            <div class="modal-body">
                <form  action="<?php echo $_SERVER['PHP_SELF']?>" method="POST">
                    <div id="formularios" style="padding-left:40px;padding-right:40px;">
                    <br /> 
                    <label for="">Facultad</label>
                    <select name="varfacultad" id="varfacultad" class="input-sm" required> </select>
                    <br /> <hr />                           
                    <!-- Se escoge la carrera -->
                    <label for="">Programa</label>
                    <select id="var1_reporte1" name="var1_reporte1" class="input-sm" onchange="mostrarValorX(this.value);" required> </select> 
                    <hr />
                    <!-- Se escoge la asignatura -->
                    <label for="">Asignatura 1</label>
                    <select name="var4_reporte1" id="var4_reporte1" class="input-sm" onchange="mostrarValorY(this.value);" required> </select> <br><br>
                    <label><kbd> Si es Semestral incluir segunda asignatura</kbd></label><br />
                    <label for="">Asignatura 2</label>
                    <select name="var444_reporte1" id="var444_reporte1" class="input-sm" onchange ="mostrarValorZ(this.value);" ><option value="0">SELECCIONE LA ASIGNATURA</option></select>
                    <hr>
                    <label for="">Grupo</label>
                    <select name="idgrupo" id="idgrupo" class="input-sm" required>
                            <option value="0">SELECCIONE EL GRUPO</option> 
                        <?php while($row6 = $resultado6->fetch_array(MYSQLI_ASSOC)) { ?>
                            <option value="<?php echo $row6['grupo'];?>"><?php echo $row6['grupo'];?></option>
                            
                        <?php }?>
                    </select> 
                    <br />
                    <br />
                    </div>              
            </div>
        </center>
      <div class="modal-footer" style="background-color:#b3ccff;">
                    <input class="btn btn-primary active"  type="submit" class="" value="Ejecutar" >
                    <button class="btn btn-default" data-dismiss="modal" type="button">Close</button>
                </form> 
      </div>
    </div>
  </div>
</div>