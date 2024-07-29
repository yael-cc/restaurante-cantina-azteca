<?php
    include("general.php");
    include("../recursos/conexion.php");

    if ($conexion->connect_error) {
        die("Error en la conexión: " . $conexion->connect_error);
    }

    function mostrarTabla($consultaSQL) {
        global $conexion;

        $resultado = $conexion->query($consultaSQL);

        echo '<main>';
        echo '<link rel="stylesheet" href="../estilos/estilo-formulario.css">';
        if ($resultado->num_rows > 0) {
            echo '<table class="styled-table" border="1">';
            echo '<thead><tr style= "text-align:center;">';

            echo '<th>ID</th>';
            echo '<th>Nombre</th>';
            echo '<th>Apellido</th>';
            echo '<th>Foto</th>';
            echo '<th>Correo</th>';
            echo '<th>UserName</th>';
            echo '<th>Tipo de usuario</th>';

            echo '</tr></thead>';
            echo '<tbody>';
            while ($fila = $resultado->fetch_assoc()) {
                echo '<tr style= "text-align:center;">';
                foreach ($fila as $dato) {
                    echo '<td>' . htmlspecialchars($dato) . '</td>';
                }
                echo '</tr>';
            }

            echo '</tbody></table>';
        } else {
            echo "No se encontraron datos en la tabla.";
        }
        echo '</main>';
    }
    

    $parametroConsulta = 'SELECT idUsuario, nombreUsuario, apellidoUsuario, fotoUsuario, correoUsuario, nombreUsuarioLogin, tipoUsuario FROM usuario';
    mostrarTabla($parametroConsulta);

    $conexion->close();
?>