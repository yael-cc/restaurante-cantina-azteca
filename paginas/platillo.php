<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cantina Azteca</title>
    <link rel="stylesheet" href="../estilos/platillo.css">
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

            if ($_SERVER['REQUEST_METHOD'] == 'POST') {
                $nombrePlatillo = $conexion->real_escape_string($_POST['nombrePlatillo']);
                $nombreCategoria = $_POST['nombreCategoria'];
                $nivel = $_POST['nivel'];

                $consultaSQL = "SELECT * FROM Platillo WHERE nombrePlatillo = '$nombrePlatillo' LIMIT 1";
                $resultado = $conexion->query($consultaSQL);

                if ($resultado->num_rows > 0) {
                    $fila = $resultado->fetch_assoc();
                    $imagenPlatillo = str_replace('../../', '../', $fila['imagenPlatillo']);
                    if ($nivel=='normal') {
                        $imagenPlatillo = str_replace('../', '../../', $fila['imagenPlatillo']);
                    }
                    
                    echo '
                        <div class="elemento">
                            <div class="cont-imagen">
                                <img src="'.$imagenPlatillo.'" alt="">
                                <div>
                                    <h2>'.$fila['nombrePlatillo'].'</h2><br>
                                    <h3 class="linea">Categoria: </h3><p class="linea">'.$nombreCategoria.'</p><br><br>
                                    <h3 class="linea">Precio: </h3><p class="linea">$'.$fila['precioPlatillo'].'</p><br><br>
                                    <h3 class="linea">Descripción: </h3><p class="linea">'.$fila['descripcionPlatillo'].'</p><br><br><br><br>
                                    <div class="cont-boton">
                                        <button>Agregar a mi<br>pedido</button>
                                    </div>
                                </div>
                            </div>
                        </div>';
                } else {
                    echo "<h2>No se encontraron registros del platillo, ha surgido un problema. Disculpe las molestias.</h2> <br>";
                }
            }
        ?>
    </main>
</body>
</html>