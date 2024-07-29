<?php
include("../recursos/conexion.php");

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $idPedido = intval($_POST['idPedido']);
    $idPlatillo = intval($_POST['idPlatillo']);
    $cantidad = intval($_POST['cantidad']);

    $sqlInsertar = "INSERT INTO pedidoplatillo (idPedido, idPlatillo, cantidad) VALUES (?, ?, ?)";
    $stmt = $conexion->prepare($sqlInsertar);

    if ($stmt) {
        $stmt->bind_param("iii", $idPedido, $idPlatillo, $cantidad);
        if ($stmt->execute()) {
            header('refresh:0,url="./populares.php"');
            exit();
        } else {
            echo "Error al ejecutar la consulta: " . $stmt->error;
        }
        $stmt->close();
    } else {
        echo "Error al preparar la consulta: " . $conexion->error;
    }

    $conexion->close();
} else {
    echo "Método de solicitud no válido.";
}
?>
