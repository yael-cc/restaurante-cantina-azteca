<?php
include("../recursos/conexion.php");

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $idPlatillo = $_POST['idPlatillo'] ?? null;
    $precioPromocion = $_POST['precioPromocion'] ?? null;
    $motivoPromocion = $_POST['motivoPromocion'] ?? null;
    $fechaFinalPromocion = $_POST['fechaFinalPromocion'] ?? null;

    if ($idPlatillo && $precioPromocion && $motivoPromocion && $fechaFinalPromocion) {
        $consultaSQL = "INSERT INTO Promocion (idPlatillo, precioPromocion, motivoPromocion, fechaFinalPromocion) 
                        VALUES (?, ?, ?, ?)";
        $stmt = $conexion->prepare($consultaSQL);

        if ($stmt) {
            $stmt->bind_param("idss", $idPlatillo, $precioPromocion, $motivoPromocion, $fechaFinalPromocion);
            $stmt->execute();
            $stmt->close();
            echo "Promoción agregada exitosamente.";
        } else {
            echo "Error al preparar la consulta: " . $conexion->error;
        }
    } else {
        echo "Todos los campos son obligatorios.";
    }
}

$conexion->close();
?>