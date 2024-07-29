
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
    <link rel="stylesheet" href="../estilos/reservacion.css">
</head>

<?php
    include("general.php");
?>

<body>
    <main>
        <section class="formulario-reservacion">
            <h1>Formulario para Reservaciones</h1>
            <hr>
            <br><br>
            <form action="manejo-reservaciones.php" method="post">
                <label for="Cantidad">Cantidad de personas: </label>
                <input type="number" name="cantidad" id="cantidad" required>
                <br>
                <label for="comentario">Comentarios adicionales: </label>
                <br>
                <textarea name="comentario" id="comentario" cols="50" rows="10" placeholder="Ingresa comentarios adicionales en caso de ser necesario."></textarea>
                <br>
                <label for="fecha">Fecha para la reservación:</label>
                <br>
                <input type="datetime-local" name="fechaR" id="fechaR" required>
                <br>
                <input type="submit" name="reservar" id="reservar" value="Reservar">
            </form>

        </section>
    
    </main>

</body>
</html>