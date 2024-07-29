<?php
    $usuario = $_POST['user'];
    $password = $_POST['password'];

    include("../recursos/conexion.php");

    $consultaSQL = "SELECT contrasenaUsuario, tipoUsuario FROM usuario WHERE nombreUsuarioLogin = '$usuario'";
    $resultado = $conexion->query($consultaSQL);

    if ($resultado->num_rows > 0) {
        while ($fila = $resultado->fetch_assoc()) {
            if($password == $fila['contrasenaUsuario']){
                $tipo = $fila['tipoUsuario'];
                session_start();
                $_SESSION['usuario'] = $usuario;
                $_SESSION['tipo'] = $tipo;
                include('acerca-de.php');
            }else{
                include('inicio-sesion.php');
                echo '<script>alert("contraseña incorrecta")</script>';
            }
        }
    } else {
        include('inicio-sesion.php');
        echo "<script>alert('Usuario no encontraso')</script>";
    }
?>