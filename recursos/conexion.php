<?php
    $server = 'localhost';
    $user = 'root';
    $pass = '';
    $db = 'restaurante';

    $conexion = new mysqli($server, $user, $pass, $db);

    if ($conexion->connect_error) {
        die('Conexion fallida'. $conexion->connect_error);
    }else {
        // echo 'Conectado';;
    }
?>