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
            <h2>Crear Nuevo Platillo</h2>
            <form action="procesar_nuevo_platillo.php" method="POST" enctype="multipart/form-data">
                <label for="nombrePlatillo">Nombre del Platillo:</label>
                <input type="text" id="nombrePlatillo" name="nombrePlatillo" required>

                <label for="precioPlatillo">Precio del Platillo:</label>
                <input type="number" id="precioPlatillo" name="precioPlatillo" step="0.01" min="0.01" required>

                <label for="descripcionPlatillo">Descripción del Platillo:</label>
                <textarea id="descripcionPlatillo" name="descripcionPlatillo" required></textarea>

                <label for="categoriaPlatillo">Categoría del Platillo:</label>
                <select id="categoriaPlatillo" name="categoriaPlatillo" required>
                    <option value="1">Desayunos</option>
                    <option value="2">Comidas</option>
                    <option value="3">Postres</option>
                    <option value="4">Bebidas</option>
                    <option value="5">Cenas</option>
                    <option value="6">Especiales</option>
                </select>

                <label for="estadoPlatillo">Estado del Platillo:</label>
                <select id="estadoPlatillo" name="estadoPlatillo" required>
                    <option value="1">Activo</option>
                    <option value="2">Inactivo</option>
                </select>

                <label for="imagenPlatillo">Imagen del Platillo:</label>
                <input type="file" id="imagenPlatillo" name="imagenPlatillo" accept=".png, .jpeg, .jpg, .webp, .avif" required>

                <button type="submit" class="btn-submit">Agregar Platillo</button>
            </form>
        </div>
    </main>
</body>
</html>