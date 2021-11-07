<div class="modal fade in " id="myModal2" role="dialog" style="display: block; padding-right: 17px;">
    <div class="modal-dialog"><!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header" style="background-color:#b3ccff;color:white;">
                <h2>SELECCIONE SUS OPCIONES</h2>
            </div>
            <center>
            <div class="modal-body table-responsive">
                <form action="<?php echo $_SERVER['PHP_SELF'] ;?>" method="POST">        
                    <div id="formularios" style="padding-left:40px;padding-right:40px;">
                        <br />
                        <!-- Facultad -->
                        <label for="">Facultad</label>
                        <select name="varfacultad" id="varfacultad" class="input-sm" required> </select>
                        <br> <hr /> 
                        <!--Carrera-->
                        <label for="">Programa</label><br>
                        <select style="" id="var1_reporte1" name="var1_reporte1" class="input-sm" onChange="fAgrega()" required></select> 
                        <hr />
                        <!--Asignatura-->
                        <label for="">Asignatura 1</label><br>
                        <select id="var4_reporte1" name="var4_reporte1" class="input-sm" required ></select>
                        <br>  <br>
                        <label><kbd> Si es Semestral incluir segunda asignatura</kbd></label><br />
                        <label for="">Asignatura 2</label><br>
                        <select id="var444_reporte1" name="var444_reporte1" class="input-sm"><option value="0">SELECCIONE LA ASIGNATURA</option></select>
                        <hr>
                        <!-- periodo -->
                        <label for="">Período</label><br>
                        <select style="" id="periodo" name="periodo" class="input-sm"  required>
                            <option value="" disabled>SELECCIONE EL PERÍODO</option>
                            <option value="SEMESTRAL">SEMESTRAL</option>
                            <option value="MODULAR">MODULAR</option>
                            <option value="VIRTUAL">VIRTUAL</option>
                        </select>
                        <br><hr>
                        <!-- comentarios del reporte -->
                        <label for="">Comentarios</label><br>
                        <textarea name="comentario"  cols="30" rows="4" maxlength="300" id="otrosmodal" ></textarea>
                        <hr>
                        <!-- grupo -->
                        <label for="">Grupo</label><br>
                        <input type="number" class="input-sm" min="0" max="9" style="width:10em" id="otrosmodal" name="grupo" class="form-control" placeholder="1-9" >
                        <hr>
                        <!-- cantidad de pagos -->
                        <label for="">¿Cuantos pagos hará?</label><br>
                        <select style="margin-left:0px;" id="pago" name="pago" class="input-sm"  required>
                            <option value="" disabled>SELECCIONE FORMA DE PAGO</option>
                            <option value="1">1 pago</option>
                            <option value="2">2 pagos</option>
                            <option value="3" selected>3 pagos</option>
                        </select>
                        <br />
                        <br />
                    </div>
            </div>
            </center>
            <div class="modal-footer" style="background-color:#b3ccff;text-align:center;">
                <input class="btn btn-primary active"  type="submit" class="" value="Ejecutar" >
                <button class="btn btn-default" data-dismiss="modal" type="button" >Close</button>
            </div>
            </form>
        </div>
    </div>
</div>