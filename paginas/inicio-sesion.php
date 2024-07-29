<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="../estilos/index.css">
</head>
<body>
    <form action="iniciar-sesion.php" method="post" class="login">
        <label for="user">Usuario</label>
        <input type="text" name="user" id="user">
        <label for="password">Contraseña</label>
        <input type="password" name="password" id="password">
        <button type="submit">Iniciar Sesión</button>
        <a href="acerca-de.php">Regresar</a>
    </form>
</body>
</html>