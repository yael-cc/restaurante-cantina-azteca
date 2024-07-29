
<?php
    include("conexion.php");
    $sql = "SELECT * FROM usuario";
    $result = $conexion->query($sql);

    if ($result->num_rows > 0) {
        while($row = $result->fetch_assoc()) {
            echo "ID: " . $row["idUsuario"]. " - Nombre: " . $row["nombreUsuario"]. " " . $row["apellidoUsuario"]. "<br>";
        }
    } else {
        echo "0 resultados<br>";
    }

?>