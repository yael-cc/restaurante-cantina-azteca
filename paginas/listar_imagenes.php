<?php
function listarImagenes($carpeta) {
    $imagenes = array();

    if (is_dir($carpeta)) {
        if ($dh = opendir($carpeta)) {
            while (($file = readdir($dh)) !== false) {
                if (preg_match('/\.(jpg|jpeg|png|webp|avif)$/i', $file)) {
                    $imagenes[] = "$carpeta/$file";
                }
            }
            closedir($dh);
        }
    }
    return $imagenes;
}

$imagenesChicas = listarImagenes('../imagenes/galeria');
$imagenesGrandes = listarImagenes('../imagenes');

// Devolver la lista de imágenes como JSON
header('Content-Type: application/json');
echo json_encode(['chicas' => $imagenesChicas, 'grandes' => $imagenesGrandes]);
?>
