<?php

//AQUÍ ESTARÁN TODAS LAS FUNCIONES EN PHP QUE SE USARÁN PARA VALIDAR LA ENTRADA DE INFORMACIÓN EN LAS TABLAS
// DE LA BASE DE DATOS mydb. ESTE ARCHIVO PHP SE IMPORTARÁ DONDE SE REQUIERA

    //Función para buscar repetidos en la tablas relacionada `asignatura_has_estudiantes`
    function buscaRepetidoTablaRel($ultimoID,$mysqli){
        $sql="SELECT estudiantes_id_estu from `asignatura_has_estudiantes` where estudiantes_id_estu= '$ultimoID'";
        $result=mysqli_query($mysqli,$sql);
        if(mysqli_num_rows($result) > 0){
            return 1;
        }else{
            return 0;
        }
    }

    //Función para buscar repetidos en la cedula del estudiante
    function buscaRepetidoCedula($ced,$mysqli){
        $sql="SELECT cedula_estu from estudiantes where cedula_estu= '$ced'";
        $result=mysqli_query($mysqli,$sql);
        if(mysqli_num_rows($result) > 0){
            return 1;
        }else{
            return 0;
        }
    }

    //Función para buscar repetidos en el correo del estudiante
    function buscaRepetidoCorreo($correo,$mysqli){
        $sql="SELECT correo_estu from estudiantes where correo_estu= '$correo'";
        $result=mysqli_query($mysqli,$sql);
        if(mysqli_num_rows($result) > 0){
            return 1;
        }else{
            return 0;
        }
    }

   //Función para buscar repetidos en el codigo de asignatura
    // function buscaRepetidoCodigoAsignatura($codasig,$mysqli){
    //     $sql="SELECT cod_asig from asignatura where cod_asig = '$codasig'";
    //     $result=mysqli_query($mysqli,$sql);
    //     if(mysqli_num_rows($result) > 0){
    //         return 1;
    //     }else{
    //         return 0;
    //     }
    // }
    if (!function_exists('parseDate')) {

        //Función para buscar repetidos en el correo del profesor
        function buscaRepetidoCorreoProf($correo_profesor,$mysqli){
            $sql="SELECT correo_prof from profesor where correo_prof = '$correo_profesor'";
            $result=mysqli_query($mysqli,$sql);
            if(mysqli_num_rows($result) > 0){
                return 1;
            }else{
                return 0;
            }
        }
    }
    if (!function_exists('parseDate')) {

        //Función para evitar que un estudiantes tenga mas de dos asignaturas asignadas
        function AsignaturaAsignadaAEstudiante($ultimoID,$mysqli){
            $sql="SELECT estudiantes_id_estu from asignatura_has_estudiantes where estudiantes_id_estu = '$ultimoID'";
            $result=mysqli_query($mysqli,$sql);
            if(mysqli_num_rows($result) > 2){
                return 1;
            }else{
                return 0;
            }
        }
    }
    if (!function_exists('parseDate')) {

        //Función para evitar que un estudiantes tenga mas de dos asignaturas asignadas
        function AsignaturaAsignadaAEstudiante2($ultimoID,$mysqli){
            $sql="SELECT estudiantes_id_estu from asignatura_has_estudiantes where estudiantes_id_estu = '$ultimoID'";
            $result=mysqli_query($mysqli,$sql);
            if(mysqli_num_rows($result) > 1){
                return 1;
            }else{
                return 0;
            }
        }
    }
    //Función para buscar repetidos en usuarios
    function buscaRepetidoUsuario($usuario,$mysqli){
        $sql="SELECT * from usuario where usuario= '$usuario'";
        $result=mysqli_query($mysqli,$sql);
        if(mysqli_num_rows($result) > 0){
            return 1;
        }else{
            return 0;
        }
    }
    //Función para buscar repetidos en contraseñas
    function buscaRepetidoContrasena($contrasena,$mysqli){
        $sql="SELECT * from usuario where contrasena='$contrasena'";
        $result=mysqli_query($mysqli,$sql);
        if(mysqli_num_rows($result) > 0){
            return 1;
        }else{
            return 0;
        }
    }
        //Función para buscar repetidos en email
        function buscaRepetidoemail($cor,$mysqli){
            $sql="SELECT * from usuario where correo='$cor'";
            $result=mysqli_query($mysqli,$sql);
            if(mysqli_num_rows($result) > 0){
                return 1;
            }else{
                return 0;
            }
        }
        // Valida el ingreso de datos al insertar el usuario
        function isNull($nom, $ape, $usu, $con){

            if(strlen(trim($nom))< 1 || strlen(trim($usu)) <1 || strlen(trim(
            $con)) < 1 ||  strlen(trim($ape))< 1)
            {
                return true;
            }else{
                return false;
            }
        }
        // Valida el ingreso de datos al insertar el usuario
        function isNullprof($nom, $ape, $cor){

            if(strlen(trim($nom))< 1 || strlen(trim($ape)) <1 || strlen(trim(
            $cor)) < 1)
            {
                return true;
            }else{
                return false;
            }
        }
        // Valida el ingreso de datos al insertar el profesor
        function isNull2($nombre_de_la_carrera){

            if(strlen(trim($nombre_de_la_carrera))< 1 )
            {
                return true;
            }else{
                return false;
            }
        }
        // Valida el ingreso de datos al insertar la asignatura
        function isNull3($asig, $codasig, $creditos, $carreraElegida){

            if(strlen(trim($asig))< 1 || strlen(trim($codasig)) <1 
            || strlen(trim($creditos)) < 1 || strlen(trim($carreraElegida)) < 1 )
            {
                return true;
            }else{
                return false;
            }
        }
        // Valida el ingreso de datos al insertar el asignatura
        function isNull4($asig, $codasig, $creditos, $carreraElegida){

            if(strlen(trim($asig))< 1 || strlen(trim($codasig)) <1 
            || strlen(trim($creditos)) < 1 || strlen(trim($carreraElegida)) < 1 )
            {
                return true;
            }else{
                return false;
            }
        }
        // Valida el ingreso de datos al insertar el estudiante
        function isNull5($nom, $ape, $ced, $estado, $cel, $correo, $carrera){

            if(strlen(trim($nom))< 1 || strlen(trim($ape)) <1 
            || strlen(trim($ced)) < 1 || strlen(trim($estado)) < 1 || strlen(trim($cel)) < 1 
            || strlen(trim($correo)) < 1 || strlen(trim($carrera)) < 1 ){
                return true;
            }else{
                return false;
            }
        }        
        function isEmail($email)
        {
            if(filter_var($email, FILTER_VALIDATE_EMAIL)){

                return true;
            }else{
                return false;
            }
        }
        function resultBlock($errors){
            if(count($errors) > 0)
            {
                echo "<div id='error' class='alert alert-danger alert-dismissible' role='alert'>
                <a href='#' class='close' onclick=\"showHide('error');\" data-dismiss='alert' aria-label='close'>[X]</a>
                <ul>";
                foreach($errors as $error)
                {
                    echo "<li>".$error."</li>";
                }
                    echo "</ul>";
                    echo "</div>";
            }
        }

        //Función para evitar que un estudiantes tenga mas de dos asignaturas asignadas
        function AsignaturaAsignadaAEstudianteX($ultimoID,$mysqli){
            $sql="SELECT estudiantes_id_estu from asignatura_has_estudiantes where estudiantes_id_estu = '$ultimoID'";
            $result=mysqli_query($mysqli,$sql);
            if((mysqli_num_rows($result) > 0) && (mysqli_num_rows($result) < 2)){
                return 1;
            }else{
                return 0;
            }
        }