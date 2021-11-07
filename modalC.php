    <!-- MODAL-->
<div class="modal fade in" id="myModal2" role="dialog" style="display: block; padding-right: 17px;">
    <div class="modal-dialog"><!-- Modal content-->
        <div class="modal-content">
        
            <div class="modal-header" style="background-color:#b3ccff;color:white;">
                <h2>SELECCIONE SUS OPCIONES</h2>
            </div>
            <div class="modal-body">
                <center>
                    <form action="<?php echo $_SERVER['PHP_SELF']?>" method="POST">                
                    <div id="formularios" >
                        <br />
                        <label for="">Facultad</label><br>
                        <select name="varfacultad" id="varfacultad" class="input-sm"> </select>
                        <br />
                        <hr />                        
                            <!-- Se escoge la carrera -->
                            <label for=""> Programa</label><br>
                        <select style="" id="var1_reporte1" name="var1_reporte1" class="input-sm" required> </select> 
                            <hr />
                            <label for="">Asignatura 1</label><br>
                        <select name="var4_reporte1" id="var4_reporte1" class="input-sm" required> </select>
                        <br><br>
                        <label><kbd> Si es Semestral incluir segunda asignatura</kbd></label><br />
                        <label for="">Asignatura 2</label><br>
                        <select name="var444_reporte1" id="var444_reporte1" class="input-sm" ><option value="0">SELECCIONE LA ASIGNATURA</option></select>
                            <hr />
                            <label for="">Profesor 1</label><br>
                        <select id="reporte1profe" name="reporte1profe" class="input-sm">
                            <option value="">SELECCIONE AL PROFESOR</option>
                        </select>
                        <br><br>
                        <label><kbd> Si es Semestral incluir el segundo profesor</kbd></label><br />
                        <label for="">Profesor 2</label><br>
                        <select id="reporte2profe" name="reporte2profe" class="input-sm">
                            <option value="">SELECCIONE AL PROFESOR</option>
                        </select>
                        <hr />
                        <label for="">Semestre</label><br>
                        <select name="semestre" id="semestre" class="input-sm" required>
                            <option value="PRIMERO" selected>PRIMERO</option>
                            <option value="SEGUNDO">SEGUNDO</option>
                            <option value="VERANO">VERANO</option>
                        </select>
                        <hr>
                        <label for="">Grupo de salón</label><br>
                        <input type="text" class="input-sm" name="grupo">
                        <hr>
                        <div id="parrafo_abajo">
                            <label for="">Párrafo o Instrucciones</label><br><br>
                            <textarea name="parrafo" id="parrafo" cols="35" rows="5" maxlength="500" placeholder="500 carácteres solamente."></textarea>
                            <br><br>
                        </div>
                            
                    </div>
                </center>
            </div>
            <div class="modal-footer" style="background-color:#b3ccff;text-align:center;">
                <input class="btn btn-primary active"  type="submit" class="" value="Ejecutar" >
                <button class="btn btn-default" data-dismiss="modal" type="button">Close</button>
                    </form> 
            </div>
        </div>
    </div>
</div>