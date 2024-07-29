<?php
    $usuario = $_POST['user'];
    $password = $_POST['password'];

    include("../recursos/conexion.php");

    $consultaSQL = "SELECT contrasenaUsuario FROM usuario WHERE nombreUsuarioLogin = '$usuario'";
    $resultado = $conexion->query($consultaSQL);

    if ($resultado->num_rows > 0) {
        while ($fila = $resultado->fetch_assoc()) {
            if($password == $fila['contrasenaUsuario']){
                session_start();
                $_SESSION['usuario'] = $usuario;
                include('acerca-de.php');
            }else{
                include('inicio-sesion.php');
                echo '<script>alert("contraseña incorrecta")</script>';
            }
        }
    } else {
        echo "<h2>No se encontro el usuario.</h2> <br>";
    }
?>