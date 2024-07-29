

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cantina Azteca</title>
    <link rel="stylesheet" href="../estilos/menu.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Irish+Grover&display=swap" rel="stylesheet">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,100..900;1,100..900&display=swap" rel="stylesheet">
</head>

<?php
    include("general.php");
?>

<body>
    <main>
        <?php
            include("../recursos/conexion.php");

            $fechaActual = date('Y-m-d'); // Fecha actual en formato YYYY-MM-DD

            $consultaSQL = "SELECT * FROM Platillo WHERE idPlatillo IN (SELECT idPlatillo FROM Promocion WHERE fechaFinalPromocion >= ?) ORDER BY nombrePlatillo";
            $stmt = $conexion->prepare($consultaSQL);
            $stmt->bind_param("s", $fechaActual);
            $stmt->execute();
            $resultado = $stmt->get_result();

            if ($resultado->num_rows > 0) {
                while ($fila = $resultado->fetch_assoc()) {
                    $idCategoria = $fila['idCategoria'];
                    $nombreCategoriaSQL = "SELECT nombreCategoria FROM Categoria WHERE idCategoria = ?";
                    $conexionCategoria = $conexion->prepare($nombreCategoriaSQL);
                    $conexionCategoria->bind_param("i", $idCategoria);
                    $conexionCategoria->execute();
                    $nombreCategoriaResultado = $conexionCategoria->get_result();
                    
                    $nombreCategoria = '';
                    if ($nombreCategoriaResultado->num_rows > 0) {
                        $categoriaRow = $nombreCategoriaResultado->fetch_assoc();
                        $nombreCategoria = $categoriaRow['nombreCategoria'];
                    }

                    $idPlatillo = $fila['idPlatillo'];
                    
                    $conexionPromocion = $conexion->prepare("SELECT precioPromocion FROM Promocion WHERE idPlatillo = ? AND fechaFinalPromocion >= ?");
                    $conexionPromocion->bind_param("is", $idPlatillo, $fechaActual);
                    $conexionPromocion->execute();
                    $resultadoPromocion = $conexionPromocion->get_result();

                    $mensajeP = '';
                    $estiloColor = 'black';

                    if ($resultadoPromocion->num_rows > 0) {
                        $promo = $resultadoPromocion->fetch_assoc();
                        $precio = $promo['precioPromocion'];
                        $mensajeP = '<strong style="color: blue;"> Precio: $' . $precio . ' -->  PROMOCIÓN</strong> <br> <i style="text-decoration: line-through; color: orange;"><strong>Precio normal: $' . $fila['precioPlatillo'] . '</strong></i>';
                        $estiloColor = 'red';
                    } else {
                        $mensajeP = 'Precio: $' . $fila['precioPlatillo'];
                    }

                    echo '
                        <div class="elemento">
                            <img src="' . str_replace('../../', '../', $fila['imagenPlatillo']) . '" alt="Imagen del platillo">
                            <h2>' . $fila['nombrePlatillo'] . '</h2>
                            <p>Categoria: ' . $nombreCategoria . '<br>' . $mensajeP . '<br>Descripción: ' . $fila['descripcionPlatillo'] . '</p>
                            <div class="cont-boton">
                                <form method="POST" action="platillo.php">
                                    <input type="hidden" name="nombrePlatillo" value="' . $fila['nombrePlatillo'] . '">
                                    <input type="hidden" name="nombreCategoria" value="Especial">
                                    <input type="hidden" name="nivel" value="anormal">
                                    <button type="submit">Ver detalles</button>
                                </form>
                            </div>
                        </div>
                    ';
                }
            } else {
                echo "<h2>NO SE ENCONTRARON REGISTROS DE LOS PLATILLOS, HA SURGIDO UN PROBLEMA. DISCULPE LAS MOLESTIAS.</h2> <br>";
            }
        ?>
    </main>
</body>
</html>