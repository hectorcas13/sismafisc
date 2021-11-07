<?php
// error_reporting(0);
include 'scripts.php'; // Se importa las funciones en javascript para que funcione la página.


$filename = $_GET['file']; //get the filename


$path = "files/$filename ";

if(!unlink($path)){

    echo'<script type="text/javascript">
    alert("¡ERROR! Hay un error);
    window.history.go(-1);
    </script>';   
}else{

    echo'<script type="text/javascript">
    alert("¡BIEN! Archivo fue eliminado");
    window.history.go(-1);
    </script>';

};


?>