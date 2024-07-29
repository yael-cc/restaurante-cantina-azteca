<?php
include("../recursos/conexion.php");
include("../recursos/pedidoActual.php");

$conexion = new mysqli($server, $user, $pass, $db);

if (isset($_POST['idPedido'])) {
    $idPedido = (int)$_POST['idPedido'];

    $sql = "UPDATE Pedido SET idEstadoPreparacion = 3 WHERE idPedido = $idPedidoActual";

    if ($conexion->query($sql) === TRUE) {
        echo "Pedido actualizado correctamente.";
        header("Location:../paginas/populares.php");
        exit();
    } else {
        echo "Error al actualizar el pedido: " . $conexion->error;
    }
} else {
    echo "ID del pedido no proporcionado.";
}

$conexion->close();
?>
