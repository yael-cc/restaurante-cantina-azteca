<?php
include("../recursos/conexion.php");

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nombreUsuario = $_POST['nombreUsuario'] ?? '';
    $apellidoUsuario = $_POST['apellidoUsuario'] ?? '';
    $correoUsuario = $_POST['correoUsuario'] ?? '';
    $nombreUsuarioLogin = $_POST['nombreUsuarioLogin'] ?? '';
    $contrasenaUsuario = password_hash($_POST['contrasenaUsuario'] ?? '', PASSWORD_BCRYPT);
    $tipoUsuario = $_POST['tipoUsuario'] ?? 'cliente';

    if (isset($_FILES['fotoUsuario']) && $_FILES['fotoUsuario']['error'] === UPLOAD_ERR_OK) {
        $fileTmpPath = $_FILES['fotoUsuario']['tmp_name'];
        $fileName = $_FILES['fotoUsuario']['name'];
        $fileSize = $_FILES['fotoUsuario']['size'];
        $fileType = $_FILES['fotoUsuario']['type'];
        $fileNameCmps = explode(".", $fileName);
        $fileExtension = strtolower(end($fileNameCmps));

        $allowedfileExtensions = ['png', 'jpeg', 'jpg', 'webp', 'avif'];
        if (in_array($fileExtension, $allowedfileExtensions)) {
            $newFileName = md5(time() . $fileName) . '.' . $fileExtension;
            $uploadFileDir = '../imagenes/usuarios/';
            $dest_path = $uploadFileDir . $newFileName;

            if (move_uploaded_file($fileTmpPath, $dest_path)) {
                $fotoUsuario = $dest_path;
            } else {
                $fotoUsuario = null;
                echo 'Error al mover el archivo subido.';
            }
        } else {
            echo 'Tipo de archivo no permitido.';
            exit();
        }
    } else {
        $fotoUsuario = null;
    }

    $consultaSQL = "INSERT INTO Usuario (nombreUsuario, apellidoUsuario, fotoUsuario, correoUsuario, nombreUsuarioLogin, contrasenaUsuario, tipoUsuario) 
                    VALUES (?, ?, ?, ?, ?, ?, ?)";
    $stmt = $conexion->prepare($consultaSQL);

    if ($stmt) {
        $stmt->bind_param("sssssss", $nombreUsuario, $apellidoUsuario, $fotoUsuario, $correoUsuario, $nombreUsuarioLogin, $contrasenaUsuario, $tipoUsuario);
        $stmt->execute();
        $stmt->close();
        echo "Usuario agregado exitosamente.";
    } else {
        echo "Error al preparar la consulta: " . $conexion->error;
    }
}

$conexion->close();
?>