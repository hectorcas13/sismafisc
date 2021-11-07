<?php

    // require 'conexion.php';
    // include_once 'scripts.php';
    error_reporting(0); //evitamos que envie un error por el contador de $var_count cuando este esté vacío.
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="stylesheet" href="css/ver_datos.css">
    <title>Contraseña Incorrecta</title>
</head>
<body id="contraerror" >
    <div >
        <div class="alert alert-danger alert-dismissible">
            <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
            <strong>ERROR!</strong> El usuario o la contraseña que introdujo no existe, intente nuevamente.
        </div>
        <div>
            <a href="main.html">
                <button class="btn btn-info btn-lg">Regresar</button>
            </a>
        </div>
    </div>
</body>
</html>