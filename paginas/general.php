<!-- Esto incluye el encabezado, pie de pagina y el panel de navegacion -->

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cantina Azteca</title>
    <link rel="stylesheet" href="../estilos/general-estilo.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Irish+Grover&display=swap" rel="stylesheet">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,100..900;1,100..900&display=swap" rel="stylesheet">
    <?php
        include("../recursos/pedidoActual.php");
        include("inicar-sesion.php");
    ?>
</head>
<body>
    <?php
        include("../recursos/conexion.php");
        
        if ($conexion->connect_error) {
            die("Error en la conexión: " . $conexion->connect_error);
        }

        $consultaSQL = "SELECT pp.idPlatillo, pp.cantidad, p.nombrePlatillo, p.precioPlatillo
                        FROM pedidoplatillo pp
                        JOIN Platillo p ON pp.idPlatillo = p.idPlatillo
                        WHERE pp.idPedido = ?";
        $stmt = $conexion->prepare($consultaSQL);
        $stmt->bind_param("i", $idPedidoActual);
        $stmt->execute();
        $resultado = $stmt->get_result();

        $productosHTML = '';
        $total = 0;

        if ($resultado->num_rows > 0) {
            while ($fila = $resultado->fetch_assoc()) {
                $idPlatillo = $fila['idPlatillo'];
                $nombrePlatillo = htmlspecialchars($fila['nombrePlatillo']);
                $precioPlatillo = htmlspecialchars($fila['precioPlatillo']);
                $cantidad = htmlspecialchars($fila['cantidad']);
                $sql = "SELECT idEstadoPreparacion FROM Pedido WHERE idPedido = $idPedidoActual";
                $result = $conexion->query($sql);

                if ($result->num_rows > 0) {
                    $row = $result->fetch_assoc();
                    $idEstadoPreparacion = $row['idEstadoPreparacion'];

                    $subtotal = $precioPlatillo * $cantidad;
                    $total += $subtotal;

                    if ($idEstadoPreparacion == '1') {
                        $productosHTML .= '
                            <div class="renglon">
                                <p class="postre">' . $nombrePlatillo . '</p>
                                <p class="precio">$' . number_format($precioPlatillo * $cantidad, 2) . '</p>
                                <form action="actualizar_pedido.php" method="POST" style="display:inline;">
                                    <input type="hidden" name="idPlatillo" value="' . $idPlatillo . '">
                                    <input type="hidden" name="idPedido" value="' . $idPedidoActual . '">
                                    <input type="number" name="cantidad" value="' . $cantidad . '" min="1" class="input-cantidad">
                                    <button type="submit" name="accion" value="actualizar" class="boton-actualizar">Actualizar</button>
                                    <button type="submit" name="accion" value="quitar" class="boton-quitar">Quitar</button>
                                </form>
                            </div>
                        ';
                    } elseif ($idEstadoPreparacion == '3') {
                        $productosHTML .= '
                            <div class="renglon">
                                <p class="postre">' . $nombrePlatillo . '</p>
                                <p class="precio">$' . number_format($precioPlatillo * $cantidad, 2) . '</p>
                                <form action="actualizar_pedido.php" method="POST" style="display:inline;">
                                    <input type="hidden" name="idPlatillo" value="' . $idPlatillo . '">
                                    <input type="hidden" name="idPedido" value="' . $idPedidoActual . '">
                                    <input type="number" name="cantidad" value="' . $cantidad . '" min="1" class="input-cantidad" disabled>
                                    <p style="font-size:1rem;">El pedido ya se ha realizado, debe pasar por él para poder realizar más pedidos.</p>
                                </form>
                            </div>
                        ';
                    }
            }   }
        } else {
            $productosHTML = '<p style="font-size:1rem;">No has agregado platillos a tu pedido actual.</p>';
        }

        $totalFormatted = number_format($total, 2);

        $stmt->close();
        $conexion->close();
    ?>


    <div class="carrito-fondo">
        <div class="carrito-ventana">
            <?php echo 'ID del pedido: ' . htmlspecialchars($idPedidoActual) . '.'; ?>
            <p class="titulo">Carrito de Compras</p>

            <div class="encabezado-detalle">
                <p class="columna-producto" style="font-size:1rem">Producto</p>
                <p class="columna-precio" style="font-size:1rem">Precio</p>
            </div>

            <div class="productos">
                <?php echo $productosHTML; ?>
            </div>

            <div class="total">
                <p>Total</p>
                <p class="precio-Total" style="font-size:1rem">$<?php echo $totalFormatted; ?></p>
            </div>

            <?php 
                if($idEstadoPreparacion=='1'){
                    echo '<form style="padding:0; margin:0;" action="realizar_compra.php" method="POST" style="display:inline;">
                        <input type="hidden" name="idPedido" value="'.$idPedidoActual.'">
                        <button type="submit" class="boton boton-compra">Realizar Compra</button>
                    </form>';
                }
            ?>
        </div>
    </div>


    <header>
        <p id="logo-titulo"> <img src=../imagenes/logo/logo_ca.png alt="Logo">Cantina<br>azteca</p>
        <?php
            session_start();
            if(isset($_SESSION['usuario'])){
                include('../recursos/conexion.php');
                echo '<img class="carrito-boton" src="../imagenes/logo/cart.png" alt="">';
                $consultaSQL = "SELECT fotoUsuario FROM usuario WHERE nombreUsuarioLogin = '".$_SESSION['usuario']."'";
                $resultado = $conexion->query($consultaSQL);
            
                if ($resultado->num_rows > 0) {
                    while ($fila = $resultado->fetch_assoc()) {
                        $rutaFoto = $fila['fotoUsuario'];
                    }
                } else {
                    echo "<h2>No se encontro el usuario.</h2> <br>";
                    $rutaFoto = '../imagenes/usuarios/usuario.png';
                }
                // 

                echo "<p id='nombre-usuario'>  <img src='$rutaFoto' alt='usuario'>".$_SESSION['usuario']."</p>";
            }else{
                echo '<p id="nombre-usuario"><a href="inicio-sesion.php">Iniciar Sesión</a></p>';
            }
        ?>
    </header>
    <nav>
        <h2><a href="../paginas/populares.php">Populares</a></h2>
        <h2><a href="../paginas/categorias.php">Categorias</a></h2>
        <h3><a href="../paginas/categorias/desayunos.php">Desayunos</a></h3>
        <h3><a href="../paginas/categorias/comidas.php">Comidas</a></h3>
        <h3><a href="../paginas/categorias/postres.php">Postres</a></h3>
        <h3><a href="../paginas/categorias/bebidas.php">Bebidas</a></h3>
        <h3><a href="../paginas/categorias/cenas.php">Cenas</a></h3>
        <h3><a href="../paginas/categorias/especiales.php">Especiales</a></h3>
        <h2><a href="../paginas/promociones.php">Promociones</a></h2>
        <h2><a href="../paginas/galeria.php">Galeria</a></h2>
        <h2><a href="../paginas/reservaciones.php">Reservaciones</a></h2>
        <h2><a href="../paginas/pedidos.php">Mis pedidos</a></h2>
        <h2><a href="../paginas/acerca-de.php">Acerca de...</a></h2>
        <?php
            if(isset($_SESSION['usuario'])){
                if($_SESSION['tipo']=='admin'){
                    echo '<h2><a href="../paginas/registro-admin.php">Registrar Admin</a></h2>';
                }
                echo '<h2><a href="../paginas/cerrar-sesion.php">Cerrar Sesión</a></h2>';
            }
        ?>
    </nav>
    
    <footer>
        <p>Todos los derechos reservados Cantina Azteca &copy;</p>
    </footer>
</body>
<script src="../recursos/carrito.js"></script>
</html>