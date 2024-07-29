<?php
include("../recursos/conexion.php");

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nombrePlatillo = $_POST['nombrePlatillo'];
    $precioPlatillo = $_POST['precioPlatillo'];
    $descripcionPlatillo = $_POST['descripcionPlatillo'];
    $categoriaPlatillo = $_POST['categoriaPlatillo'];
    $estadoPlatillo = $_POST['estadoPlatillo'];

    $imagenPlatillo = $_FILES['imagenPlatillo'];
    $extensionesPermitidas = ['png', 'jpeg', 'jpg', 'webp', 'avif'];
    $extensionArchivo = strtolower(pathinfo($imagenPlatillo['name'], PATHINFO_EXTENSION));

    if (in_array($extensionArchivo, $extensionesPermitidas)) {
        $rutaDestino = '../imagenes/' . $imagenPlatillo['name'];
        move_uploaded_file($imagenPlatillo['tmp_name'], $rutaDestino);

        $consultaSQL = "INSERT INTO Platillo (nombrePlatillo, precioPlatillo, descripcionPlatillo, idCategoria, idEstado, imagenPlatillo) 
                        VALUES (?, ?, ?, ?, ?, ?)";
        $stmt = $conexion->prepare($consultaSQL);

        if ($stmt) {
            $stmt->bind_param("sdsiss", $nombrePlatillo, $precioPlatillo, $descripcionPlatillo, $categoriaPlatillo, $estadoPlatillo, $rutaDestino);
            $stmt->execute();
            $stmt->close();
            echo "Platillo agregado exitosamente.";
        } else {
            echo "Error al preparar la consulta: " . $conexion->error;
        }
    } else {
        echo "Tipo de archivo no permitido.";
    }
}

$conexion->close();
?>