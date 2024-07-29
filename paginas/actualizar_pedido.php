<?php
    include("../recursos/conexion.php");

    if ($conexion->connect_error) {
        die("Error en la conexión: " . $conexion->connect_error);
    }
    
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $idPlatillo = intval($_POST['idPlatillo']);
        $idPedido = intval($_POST['idPedido']);
        $accion = $_POST['accion'];
        
        if ($accion === 'actualizar') {
            $cantidad = intval($_POST['cantidad']);
            if ($cantidad > 0) {
                $sqlActualizar = "UPDATE pedidoplatillo SET cantidad = ? WHERE idPedido = ? AND idPlatillo = ?";
                $stmt = $conexion->prepare($sqlActualizar);
                
                if ($stmt) {
                    $stmt->bind_param("iii", $cantidad, $idPedido, $idPlatillo);
                    $stmt->execute();
                    $stmt->close();
                } else {
                    echo "Error al preparar la consulta: " . $conexion->error;
                }
            }
        } else if ($accion == 'quitar') {
            $sqlEliminar = "DELETE FROM pedidoplatillo WHERE idPedido = ? AND idPlatillo = ?";
            $stmt = $conexion->prepare($sqlEliminar);
            
            if ($stmt) {
                $stmt->bind_param("ii", $idPedido, $idPlatillo);
                $stmt->execute();
                $stmt->close();
            } else {
                echo "Error al preparar la consulta: " . $conexion->error;
            }
        }

        header("Location: " . $_SERVER['HTTP_REFERER']);
        exit();
    }

    $conexion->close();
?>