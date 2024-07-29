<?php
    function validar($texto){
        $texto = trim($texto);
        $texto=stripslashes($texto);
        $texto=htmlspecialchars($texto);
        return $texto;
    
    }
    
    function redireccionar($mensaje,$dir){
        echo '<h1 style="text-align:center">'.$mensaje.'</h1>';
        echo '<h4 style="text-align:center> Redireccionando....</h4>';
    
        header('refresh:2,url='.$dir);
    }

    function subir_imagen($archivo){
        if(empty($archivo)){
            echo "<script>alert('Archivo vacio')</script>";
            return null;
        }

        $nombre = $archivo['name'];
        $origen = $archivo['tmp_name'];
        $tama = $archivo['size'];
        $tipo = $archivo['type'];
        $error = $archivo['error'];

        $extensiones = array('jpg', 'jpeg', 'png');

        $nombre_y_ext = explode('.', $nombre);//regresa un arreglo como split de java

        $extension = strtolower(end($nombre_y_ext));

        if(!in_array($extension, $extensiones)){
            echo "<script>alert('Archivo no valido')</script>";
            return null;
        }
        if($error > 0){
            echo "<script>alert('Error en la carga')</script>";
            return null;
        }

        $nombre_nuevo = uniqid('', true) . '.' . $extension;
        $destino = "../imagenes/usuarios/" . $nombre_nuevo;
        move_uploaded_file($origen, $destino);

        echo "<script>alert('La imagen se subio correctamente')</script>";
        return $destino;
    }

    function conectar(){
        DEFINE('SERVIDOR', 'localhost');
        DEFINE('USUARIO', 'root');
        DEFINE('PASSWORD', '');
        DEFINE('BD', 'restaurante');

        $resultado = mysqli_connect(SERVIDOR, USUARIO, PASSWORD, BD);

        return $resultado;
    }
?>