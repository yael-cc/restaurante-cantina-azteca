<?php 

include '../recursos/conexion.php';
include 'general.php';


if (empty($_POST)){
    redireccionar('Prohibido','reservaciones.php');
    return;
}
$sqlIDUsuario="SELECT idUsuario from usuario where nombreUsuarioLogin = '".$_SESSION['usuario']."'";
$resultado = $conexion->query($sqlIDUsuario);

if ($resultado->num_rows > 0) {
    while ($fila = $resultado->fetch_assoc()) {
        $idUsuario = $fila['idUsuario'];
    }
} else {
    echo "<h2>Error durante la busqueda</h2> <br>";
}

$cantidad = $_POST['cantidad'];
$comentarios=$_POST['comentario'];
$fecha=$_POST['fechaR'];
$fechaActual=validar(date('Y-m-d H:i:s'));
$estado='Pendiente';

if(!$conexion){
    redireccionar('Error en la conexion','reservaciones.php');
}else{
    $sqlInsercion="insert into reservacion (idUsuario,cantidadPersonas,comentarioAdicional,fechaSolicitud,fechaReservacion) values ('$idUsuario','$cantidad','$comentarios','$fechaActual','$fecha')";
    $resultadoInsercion = mysqli_query($conexion,$sqlInsercion);
}



if($resultadoInsercion){
    redireccionar('Datos guardados correctamente','reservaciones.php');

}else{
    redireccionar('Error: '.mysqli_error($conexion),'reservaciones.php');
}



//funciones
function validar($texto){
    $texto = trim($texto);
    $texto=stripslashes($texto);
    $texto=htmlspecialchars($texto);
    return $texto;

}

function redireccionar($mensaje,$dir){
       
  
    echo '<h1 style="text-align:center">'.$mensaje.'</h1>';
    echo '<h4 style="text-align:center> Redireccionando....</h4>';

    header('refresh:3,url='.$dir);
}


?>