<?php
    include("conexion.php");
    // include '../paginas/general.php';

    $idPedidoActual = 0;
    
    // $sqlIDUsuario="SELECT idUsuario from usuario where nombreUsuarioLogin = '".$_SESSION['usuario']."'";
    // $resultado = $conexion->query($sqlIDUsuario);

    // if ($resultado->num_rows > 0) {
    //     while ($fila = $resultado->fetch_assoc()) {
    //         $idUsuarioActual = $fila['idUsuario'];
    //     }
    // } else {
    //     echo "<h2>Error durante la busqueda</h2> <br>";
    // }

    $consultaPedidoActual = "SELECT idPedido FROM Pedido WHERE (idUsuario = $idUsuarioActual AND idEstadoPreparacion = 1) OR (idUsuario = $idUsuarioActual AND idEstadoPreparacion = 3) LIMIT 1";
    
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