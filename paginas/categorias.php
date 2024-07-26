

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

            $consultaSQL = "SELECT * FROM Categoria";
            $resultado = $conexion->query($consultaSQL);

            if ($resultado->num_rows > 0) {
                while ($fila = $resultado->fetch_assoc()) {
                    echo '
                        <div class="elemento">
                            <img src="' . $fila["imagenCategoria"] . '" alt="Imagen representativa">
                            <h2>' . $fila["nombreCategoria"] . '</h2>
                            <p>' . $fila["descripcionCategoria"] . '</p>
                            <div class="cont-boton">
                                <button> <a href="categorias/' . $fila["nombreCategoria"] . '.php">Ir a ' . $fila["nombreCategoria"] . '</a> </button>
                            </div>
                        </div>
                    ';
                }
            } else {
                echo "<h2>NO SE ENCONTRARON REGISTROS DE LAS CATEGORIAS, HA SURGIDO UN PROBLEMA. DISCULPE LAS MOLESTIAS.</h2> <br>";
            }
        ?>
    </main>
</body>
</html>