<?php 

include 'scripts.php'; // Se importa las funciones en javascript para que funcione la página.
setlocale(LC_TIME,"es_ES");
$fecha= date("Y-m-d h:i");

if($_FILES["archivo"]["error"]>0){

    echo'<script type="text/javascript">
    alert("¡ERROR! El archivo no fue guardado");
    window.history.go(-1);
    </script>';

}else{

    $permitidos = array("application/pdf");
    $limite_kb = 200;

    if(in_array($_FILES["archivo"]["type"], $permitidos) && $_FILES["archivo"]["size"] <= $limite_kb * 1024){

        $ruta = 'files/'.'/';
        $archivo = $ruta.$_FILES["archivo"]["name"];

        // verifica que la ruta existe
        if(!file_exists($ruta)){
            mkdir($ruta);
        }

        // validamos que no exista duplicados
        if(!file_exists($archivo)){
            // tmp_name asigna un nombre temporal al archivo
            $resultado = @move_uploaded_file($_FILES["archivo"]["tmp_name"],$archivo); 

            if($resultado){
                echo'<script type="text/javascript">
                alert("¡BIEN! El archivo fue guardado");
                window.location.href="subir_reporte.php";
                </script>';
            }else{
                echo'<script type="text/javascript">
                alert("¡ERROR! Error al guardar el archivo");
                window.history.go(-1);
                </script>';
             
            }

        }else{
            echo'<script type="text/javascript">
            alert("¡ERROR! El archivo ya existe");
            window.history.go(-1);
            </script>';
        }

    }else{
        echo'<script type="text/javascript">
        alert("¡ERROR! Archivo no permitido o excede el tamaño");
        window.history.go(-1);
        </script>';
    }
}





?>