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
    include("../recursos/pedidoActual.php");
    if (empty($_POST)) {
        header('refresh:0,url="./populares.php"');
    }

?>

<body>
    <main>
        <?php
            include("../recursos/conexion.php");

            if ($_SERVER['REQUEST_METHOD'] == 'POST') {
                $nombrePlatillo = $conexion->real_escape_string($_POST['nombrePlatillo']);
                $nombreCategoria = $_POST['nombreCategoria'];
                $nivel = $_POST['nivel'];

                $consultaSQL = "SELECT * FROM platillo WHERE nombrePlatillo = '$nombrePlatillo' LIMIT 1";
                $resultado = $conexion->query($consultaSQL);

                if ($resultado->num_rows > 0) {
                    $fila = $resultado->fetch_assoc();
                    $imagenPlatillo = str_replace('../../', '../', $fila['imagenPlatillo']);
                    if ($nivel=='normal') {
                        $imagenPlatillo = str_replace('../', '../../', $fila['imagenPlatillo']);
                    }
                
                    $idPlatillo = $fila['idPlatillo'];
                    $fechaActual = date('Y-m-d');
                    
                    $stmt = $conexion->prepare("SELECT precioPromocion FROM Promocion WHERE idPlatillo = ? AND fechaFinalPromocion >= ?");
                    $stmt->bind_param("is", $idPlatillo, $fechaActual);
                    $stmt->execute();
                    $resultadoPromocion = $stmt->get_result();

                    $mensajeP = '';
                    $estiloColor = 'black';
                    $mensajeS ='';

                    if ($resultadoPromocion->num_rows > 0) {
                        $promo = $resultadoPromocion->fetch_assoc();
                        $precioPromocion = $promo['precioPromocion'];
                        $precioNormal = $fila['precioPlatillo'];
                    
                        $mensajeP = '
                            <strong style="color: blue;">
                                Precio: $
                                <p class="precio" style="display: inline;">' . $precioPromocion . '</p>
                                <span style="color: blue;"> --> PROMOCIÓN</span>
                            </strong>
                            <br>
                            <i style="text-decoration: line-through; color: orange;">
                                <strong>Precio normal: $' . $precioNormal . '</strong>
                            </i>
                        ';
                    } else {
                        $mensajeP = 'Precio: $<p class="precio" style="display: inline;">' . $fila['precioPlatillo'] . '</p>';
                    }
                    $mensajeCompra = '';

                    if(isset($_SESSION['usuario'])){
                        $mensajeCompra = '<form action="procesar_pedido.php" method="POST">
                                            <input type="hidden" name="idPedido" value="'.$idPedidoActual.'">
                                            <input type="hidden" name="idPlatillo" value="'.$idPlatillo.'">
                                            <input type="hidden" name="cantidad" value="1">
                                            <button type="submit" class="compra-pedido">Agregar a mi<br>pedido</button>
                                        </form>';
                    }else{
                        $mensajeCompra = '<h3>INICIA SESION PARA PODER COMPRAR PLATILLOS</h3>';
                    }

                    
                    echo '
                        <div class="elemento">
                            <div class="cont-imagen">
                                <img src="'.$imagenPlatillo.'" alt="">
                                <div>
                                    <h2 class="nombre">'.$fila['nombrePlatillo'].'</h2><br>
                                    <h3 class="linea">Categoria: </h3><p class="linea">'.$nombreCategoria.'</p><br><br>
                                    '.$mensajeP.'<br><br>
                                    <h3 class="linea">Descripción: </h3><p class="linea">'.$fila['descripcionPlatillo'].'</p><br><br><br><br>
                                    <div class="cont-boton">
                                        '.$mensajeCompra.'
                                    </div>
                                </div>
                            </div>
                        </div>
                        <script src="../recursos/carrito.js"></script>';
                } else {
                    echo "<h2>No se encontraron registros del platillo, ha surgido un problema. Disculpe las molestias.</h2> <br>";
                }
            }
        ?>
    </main>
</body>

</html>