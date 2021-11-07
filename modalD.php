<div class="modal fade in" id="myModal2" role="dialog" style="display: block; padding-right: 17px;">
  <div class="modal-dialog"><!-- Modal content-->
    <div class="modal-content">
      
        <div class="modal-header" style="background-color:#b3ccff;color:white;">
          <h2>SELECCIONE SUS OPCIONES</h2>
        </div>
            <div class="modal-body" style="margin-right:auto;margin-left:auto;text-align:center;">
            <form action="<?php echo $_SERVER['PHP_SELF']?>" method="POST">           
                <div id="formularios" >
                    <br />
                    <!-- Facultad -->
                    <label for="">Facultad</label><br>
                    <select name="varfacultad" id="varfacultad" class="input-sm"> </select>
                    <br /> <hr />
                    <!--Carrera-->
                    <label for="">Programa</label><br>
                    <select name="var1_reporte1" id="var1_reporte1" class="input-sm" ></select>
                    <p>&nbsp;</p>
                    <hr />
                    <!--Asignatura-->
                    <label for="">Asignatura</label><br>
                    <select name="var4_reporte1" id="var4_reporte1" class="input-sm"> </select>
                    <p>&nbsp;</p>
                    <hr />
                    <!--Profesor-->
                    <label for="">Profesor</label><br>
                    <select id="reporte1profe" name="reporte1profe" class="input-sm" ><OPTion selected disabled>SELECCIONE AL PROFESOR</OPTion></select>
                    <hr>
                    <label for="">Período</label><br>
                    <select name="periodo" id="periodo" class="input-sm">
                        <option value="PRIMER SEMESTRE" selected>PRIMER SEMESTRE</option>
                        <option value="SEGUNDO SEMESTRE">SEGUNDO SEMESTRE</option>
                        <option value="VERANO">VERANO</option>
                    </select>
                    <hr>
                    <label for="">Ubicación</label><br>
                    <textarea name="ubicacion" id="mayus"  maxlength="30" cols="30" rows="2" placeholder="Indique la ubicacíon"></textarea></p>
                    <hr>
                    <label for="">Grupo</label><br>
                    <input type="text" required class="input-sm" name="grupo"  required>
                    <br><br>
                </div>
            </div>
      <div class="modal-footer" style="background-color:#b3ccff;"  >
        <div style="text-align:center;">
          <input class="btn btn-primary active"  type="submit" class="" value="Ejecutar" >
          <button class="btn btn-default" data-dismiss="modal" type="button">Close</button>
        </div>  
      </form>
      </div>
    </div>
  </div>
</div>