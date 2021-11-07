<?php
require 'conexion.php';
session_start();
if(isset($_SESSION['u_usuario'])){ 
        $id = $_GET['id'];
        $sql = "SELECT *
        from estudiantes where id_estu = '$id';";

        $resultado = $mysqli->query($sql);
        $row = $resultado->fetch_array(MYSQLI_ASSOC);
        require 'scripts.php';
        include_once 'funciones.php';
?>
<html lang="es">
<head>
    <link rel="stylesheet" href="css/ver_datos.css">
    <link rel="stylesheet" href="css/arreglos.css">
    <title>Modifique Estudiante</title>
</head>
<body>
    <div class="jumbotron" >
      <h1 class="">MODIFIQUE SU REGISTRO</h1>
      <p>
       EDITE LOS DATOS DEL ESTUDIANTE
      </p>
    </div>
    <div id="AgregarEstudiante" >
      <form class="form-horizontal" action="actualizar_estudiante.php" method="post" id="" accept-charset="ISO-8859-1">
        <div class="form-group">
            <label class="control-label col-sm-4" for=""><kbd>Agregar <ins>nombre</ins> del estudiante</kbd></label>
          <div class="col-sm-5">
            <input type="text" style="width:20em" maxlength="20" class="form-control" autofocus id="nombre_estu" name="nombre_estu" value="<?php echo utf8_encode($row['nombre_estu']);?>" required>
          </div>
        </div>
        <div class="form-group">
            <label class="control-label col-sm-4" for=""><kbd>Agregar <ins>apellido</ins> de estudiante</kbd></label>
          <div class="col-sm-5">
              <input type="text" maxlength="20" style="width:20em" class="form-control" id="apellido_estu" name="apellido_estu" value="<?php echo utf8_encode($row['apellido_estu']);?>" required>
          </div>
        </div>
        <!-- Agregar si esta exonerado -->
        <div class="form-group" >
          <label class="control-label col-sm-4" for="" ><span id="redd"> * </span><kbd>Exoneración</kbd></label>
            <div class="col-sm-5">
            <label class="container" style="display:none">
                <input type="radio" name="estado" id="estado"  value="<?php echo $row['exoneracion'];?>" checked="checked"><br>
                <span class="checkmark"></span>
              </label>
              <label class="container">
                <input type="radio" name="estado" id="estado" value="3" > Exonerado 25%<br>
                <span class="checkmark"></span>
              </label>
              <label class="container">
                <input type="radio" name="estado" id="estado" value="2"> Exonerado 50%
                <span class="checkmark"></span>
              </label>
              <label class="container">
                <input type="radio" name="estado" id="estado" value="1" > No Exonerado
                <span class="checkmark"></span>
              </label>
            </div>
        </div>
        <div class="form-group">
            <label class="control-label col-sm-4" for=""><kbd>Agregar la cédula</kbd></label>
          <div class="col-sm-5">
              <input type="text" style="width:20em" maxlength="20" size="20 "class="form-control" id="cedula_estu"  name="cedula_estu" value="<?php echo $row['cedula_estu'];?>" required>
              <input type="hidden" style="width:20em" maxlength="20" size="20 "class="form-control" id="cedula_original"  name="cedula_original" value="<?php echo $row['cedula_estu'];?>" >
          </div>
        </div>
        <div class="form-group">
            <label class="control-label col-sm-4" for="" ><kbd>Teléfono</kbd></label>
          <div class="col-sm-5">          
            <input type="tel" maxlength="7" style="width:20em" class="form-control" id="tel_estu" name="tel_estu" value="<?php echo $row['tel_estu'];?>" name="tel_estu" pattern=".{7,7}" title="Ingresa solo 7 números y sin guiones">
          </div>
        </div>
        <div class="form-group">
            <label class="control-label col-sm-4" for="" ><kbd>Celular</kbd></label>
          <div class="col-sm-5">          
            <input type="tel" maxlength="8" style="width:20em" class="form-control" id="cel_estu"  name="cel_estu" value="<?php echo $row['cel_estu'];?>" pattern=".{8,8}" title="Ingresa solo 8 números y sin guiones">
          </div>
        </div>
        <div class="form-group">
          <label class="control-label col-sm-4" for="" ><kbd>Correo</kbd></label>
        <div class="col-sm-5">          
          <input type="email" maxlength="50" style="width:20em" class="form-control" id="correo_estu" name="correo_estu" value="<?php echo $row['correo_estu'];?>" pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,3}$">
          <input type="hidden" maxlength="50" style="width:20em" class="form-control" id="correo_original" name="correo_original" value="<?php echo $row['correo_estu'];?>" pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,3}$">
        </div>
        </div>
        <div class="form-group">
            <label class="control-label col-sm-4" for="" ><span id="redd"> * </span><kbd>Grupo</kbd></label>
          <div class="col-sm-5">          
            <input type="number" maxlength="1" max="9" min="1" class="form-control" id="grupo" placeholder="Grupo" name="grupo" style="width:20em"  value="<?php echo $row['grupo'];?>"  required>
          </div>
        </div>
        <!-- Se elige la facultad del estudiante-->
        <div class="form-group" id="xcarrera">
          <label class="control-label col-sm-4" for="" ><span id="redd"> * </span><kbd>¿A qué facultad pertenece?</kbd></label>
          <div class="col-sm-5" >
            <select name="varfacultad" id="varfacultad" class="input-sm" style="width:20em" required> 
           
            </select>
          </div>
        </div>
        <!-- Se elige la carrera del estudiante-->
        <div class="form-group" id="xcarrera">
            <label class="control-label col-sm-4" for="" ><span id="redd"> * </span><kbd>¿A qué carrera pertenece?</kbd></label>
            <div class="col-sm-5">          
              <select  id="var1_reporte1" name="var1_reporte1" class="input-sm" style="width:20em" required >
            
              </select>
            </div>
        </div>
        <div class="form-group" id="botones" >        
          <div>
            <a href="ver_estudiante.php"><button style="width:9em;" type="button" class="btn btn-default">      Atrás </button></a>
            <button type="submit" class="btn btn-dark">Actualizar datos</button>
          </div>
        </div>
        <input type="hidden" id="id_estudiante" name="id_estudiante" value="<?php echo $row['id_estu']; ?>" />
        <input type="hidden" id="id_carrera" name="id_carrera" value="<?php echo $row['carrera_idcarrera']; ?>" />
      </form>
    </div>
    <script src="js/function.js"></script>
    <script>
      // Limitará a dos la cantidad de materias en un estudiantes que se introducen
      var ultimoValorValido = null;
        $("#var4_reporte1").on("change", function() {
          if ($("#var4_reporte1 option:checked").length > 2) {
                $("#var4_reporte1").val(ultimoValorValido);
                ultimoValorValido = $("#var4_reporte1").val([]);      
                } else {
                ultimoValorValido = $("#var4_reporte1").val();
                }
        });
    </script>
</body>
  <?php include_once 'footer.php';  ?>  
</html>
<?php }
  else{
    header("Location:cerrar_session.php");
  }
?>