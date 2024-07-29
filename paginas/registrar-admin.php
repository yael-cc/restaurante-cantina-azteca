<?php
    include('utilidades.php');

    session_start();
    if(!$_SESSION['tipo']=='admin'){
        echo "<script>alert('No es admin')</script>";
        redireccionar('no admin', 'acerca-de.php');
        return;
    }
    
    $nombre = validar($_POST['nombre']);
    $apellido = validar($_POST['apellido']);
    $correo = validar($_POST['correo']);
    $username = validar($_POST['username']);
    $password = validar($_POST['password']);

    if(
        $nombre == '' ||
        $apellido == '' ||
        $correo == '' ||
        $username == '' ||
        $password == ''
    ){
        echo "<script>alert('Campos no validos')</script>";
        redireccionar('no admin', 'acerca-de.php');
        return;
    }

    $foto = subir_imagen($_FILES['imagen']);

    $conexion = conectar();

    if (!$conexion) {
        redireccionar('Error en la conexión', 'acerca-de.php');
        return;
    }

    $sql = "insert into usuario(nombreUsuario, apellidoUsuario, fotoUsuario, correoUsuario, nombreUsuarioLogin, contrasenaUsuario, tipoUsuario) 
        values('$nombre', '$apellido', '$foto', '$correo', '$username', '$password', 'admin');";

    $resultado = mysqli_query($conexion, $sql);

    if($resultado){
        echo "<script>alert('Guardado')</script>";
        redireccionar('Datos guardados exitósamente', 'acerca-de.php');
    }else{
        echo "<script>alert('Algo Trono')</script>";
        redireccionar('Error: '.mysqli_error($conexion), 'acerca-de.php');
    }

    mysqli_close($conexion);
?>