<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Agregar Promoción</title>
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
            <h2>Agregar Promoción</h2>
            <form action="procesar_nueva_promocion.php" method="POST">
                <label for="idPlatillo">ID del Platillo:</label>
                <input type="number" id="idPlatillo" name="idPlatillo" required>

                <label for="precioPromocion">Precio de la Promoción:</label>
                <input type="number" id="precioPromocion" name="precioPromocion" step="0.01" min="0.01" required>

                <label for="motivoPromocion">Motivo de la Promoción:</label>
                <textarea id="motivoPromocion" name="motivoPromocion" required></textarea>

                <label for="fechaFinalPromocion">Fecha Final de la Promoción:</label>
                <input type="date" id="fechaFinalPromocion" name="fechaFinalPromocion" required>

                <button type="submit" class="btn-submit">Agregar Promoción</button>
            </form>
        </div>
    </main>
</body>
</html>