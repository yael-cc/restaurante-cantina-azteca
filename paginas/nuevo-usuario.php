<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Nuevo Platillo</title>
    <link rel="stylesheet" href="../estilos/estilo-formulario.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Irish+Grover&display=swap" rel="stylesheet">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,100..900;1,100..900&display=swap" rel="stylesheet">
    <?php
        include("general.php");
    ?>
</head>
<body>
    <main>
        <div class="form-container">
            <h2>Agregar Usuario</h2>
            <form action="procesar_nuevo_usuario.php" method="POST" enctype="multipart/form-data">
                <label for="nombreUsuario">Nombre:</label>
                <input type="text" id="nombreUsuario" name="nombreUsuario" required>

                <label for="apellidoUsuario">Apellido:</label>
                <input type="text" id="apellidoUsuario" name="apellidoUsuario" required>

                <label for="fotoUsuario">Foto:</label>
                <input type="file" id="fotoUsuario" name="fotoUsuario" accept=".png, .jpeg, .jpg, .webp, .avif">

                <label for="correoUsuario">Correo Electrónico:</label>
                <input type="email" id="correoUsuario" name="correoUsuario" required>

                <label for="nombreUsuarioLogin">Nombre de Usuario:</label>
                <input type="text" id="nombreUsuarioLogin" name="nombreUsuarioLogin" required>

                <label for="contrasenaUsuario">Contraseña:</label>
                <input type="password" id="contrasenaUsuario" name="contrasenaUsuario" required>

                <label for="tipoUsuario">Tipo de Usuario:</label>
                <select id="tipoUsuario" name="tipoUsuario" required>
                    <option value="cliente">Cliente</option>
                    <option value="admin">Admin</option>
                </select>

                <button type="submit" class="btn-submit">Agregar Usuario</button>
            </form>
        </div>
    </main>
</body>
</html>