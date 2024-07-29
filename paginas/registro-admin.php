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
    <link rel="stylesheet" href="../estilos/acercade.css">
</head>

<?php
    include("general.php");
?>

<body>
    <main>
        <form action="registrar-admin.php" method="post" enctype="multipart/form-data">
            <label for="nombre">Nombre</label>
            <input type="text" name="nombre" id="nombre" required>
            <br>

            <label for="Apellido">Apellido</label>
            <input type="text" name="apellido" id="apellido" required>
            <br>

            <!-- no valida el tipo de archivo -->
            <label for="imagen">Foto de Pefil</label>
            <input type="file" name="imagen" id="imagen" required>
            <br>

            <label for="correo">Correo</label>
            <input type="email" name="correo" id="correo" required>
            <br>

            <label for="username">Username</label>
            <input type="text" name="username" id="username" required>
            <br>

            <label for="password">Contraseña</label>
            <input type="password" name="password" id="password" required>
            <br>

            <input type="submit" value="Registrar">
        </form>
    </main>
</body>
</html>