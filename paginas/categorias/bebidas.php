
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cantina Azteca</title>
    <link rel="stylesheet" href="../../estilos/menu.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Irish+Grover&display=swap" rel="stylesheet">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,100..900;1,100..900&display=swap" rel="stylesheet">
</head>

<?php
    include("general-categorias.php");
?>

<body>
    <main>
        <?php
            include("../../recursos/conexion.php");

            // Verificar si la conexión fue exitosa
            if ($conexion->connect_error) {
                die("Error en la conexión: " . $conexion->connect_error);
            }

            $consultaSQL = "SELECT * FROM platillo WHERE idCategoria = 4 ORDER BY nombrePlatillo";
            $resultado = $conexion->query($consultaSQL);

            if ($resultado->num_rows > 0) {
                while ($fila = $resultado->fetch_assoc()) {
                    $idPlatillo = $fila['idPlatillo'];
                    $fechaActual = date('Y-m-d');
                    
                    $stmt = $conexion->prepare("SELECT precioPromocion FROM Promocion WHERE idPlatillo = ? AND fechaFinalPromocion >= ?");
                    $stmt->bind_param("is", $idPlatillo, $fechaActual);
                    $stmt->execute();
                    $resultadoPromocion = $stmt->get_result();

                    $mensajeP = '';
                    $estiloColor = 'black';

                    if ($resultadoPromocion->num_rows > 0) {
                        $promo = $resultadoPromocion->fetch_assoc();
                        $precio = $promo['precioPromocion'];
                        $mensajeP = '<strong style = "color:blue"> Precio: $'.$promo['precioPromocion'].' -->  PROMOCIÓN</strong> <br> <i style= "text-decoration: line-through; color:orange"><strong>Precio normal: $'. $fila['precioPlatillo'].'</strong></i>';
                        $estiloColor = 'red';
                    } else {
                        $mensajeP = 'Precio: $'. $fila['precioPlatillo'];
                    }

                    echo '
                        <div class="elemento">
                            <img src="' . $fila['imagenPlatillo'] . '" alt="Imagen del platillo">
                            <h2>' . $fila['nombrePlatillo'] . '</h2>
                            <p>Categoria: Bebida<br>'. $mensajeP . '<br>Descripción: ' . $fila['descripcionPlatillo'] . '</p>
                            <div class="cont-boton">
                                <form method="POST" action="../platillo.php">
                                    <input type="hidden" name="nombrePlatillo" value="' . $fila['nombrePlatillo'] . '">
                                    <input type="hidden" name="nombreCategoria" value="Bebida">
                                    <input type="hidden" name="nivel" value="anormal">
                                    <button type="submit">Ver detalles</button>
                                </form>
                            </div>
                        </div>
                    ';
                    $stmt->close();
                }
            } else {
                echo "<h2>NO SE ENCONTRARON REGISTROS DE LOS PLATILLOS, HA SURGIDO UN PROBLEMA. DISCULPE LAS MOLESTIAS.</h2> <br>";
            }
            $conexion->close();
        ?>
        
    </main>
</body>
</html>