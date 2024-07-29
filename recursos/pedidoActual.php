<?php
    include("conexion.php");
    $idPedidoActual = 0;
    $consultaPedidoActual = "SELECT idPedido FROM pedido WHERE (idUsuario = $idUsuarioActual AND idEstadoPreparacion = 1) OR (idUsuario = $idUsuarioActual AND idEstadoPreparacion = 3) LIMIT 1";
    
    $resultadoPedidoA = $conexion->query($consultaPedidoActual);

    if ($resultadoPedidoA->num_rows > 0) {
        while ($fila = $resultadoPedidoA->fetch_assoc()) {
            $idPedidoActual = $fila['idPedido'];
        }
    } else {
        $idUsuario = 2;
        $idEstadoPreparacion = 1;
        $pagoRealizado = 0;
        $sqlPedido = "INSERT INTO pedido (idUsuario, idEstadoPreparacion, pagoRealizado, fechaPedido) VALUES (?, ?, ?, NOW())";
        $conexionPedido = $conexion->prepare($sqlPedido);

        if ($conexionPedido === false) {
            die("Error al preparar la consulta: " . $conexion->error);
        }

        $conexionPedido->bind_param("iii", $idUsuario, $idEstadoPreparacion, $pagoRealizado);

        if ($conexionPedido->execute()) {
            $idPedidoActual = $conexionPedido->insert_id;
        }

        $conexionPedido->close();
    }

    $conexion->close();
?>