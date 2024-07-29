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

</head>
<body>
    <header>
        <p id="logo-titulo"> <img src=../imagenes/logo_ca.png alt="Logo">Cantina<br>azteca</p>
        <?php
            session_start();
            if(isset($_SESSION['usuario'])){
                include('../recursos/conexion.php');
                
                //
                $consultaSQL = "SELECT fotoUsuario FROM usuario WHERE nombreUsuarioLogin = '".$_SESSION['usuario']."'";
                $resultado = $conexion->query($consultaSQL);
            
                if ($resultado->num_rows > 0) {
                    while ($fila = $resultado->fetch_assoc()) {
                        $rutaFoto = $fila['fotoUsuario'];
                    }
                } else {
                    echo "<h2>No se encontro el usuario.</h2> <br>";
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
</html>