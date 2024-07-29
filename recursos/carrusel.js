document.addEventListener("DOMContentLoaded", function() {
    fetch('listar_imagenes.php')
        .then(response => response.json())
        .then(archivo => {
            let imagenesPequenias = archivo.chicas;
            let imagenesGrandes = archivo.grandes;

            let currentIndex = 0;

            function cambiarImagenes() {
                currentIndex = (currentIndex + 1) % imagenesGrandes.length;
                document.getElementById("imagen-pequenia").src = imagenesPequenias[currentIndex % imagenesPequenias.length];
                document.getElementById("imagen-pequenia2").src = imagenesPequenias[(currentIndex + 1) % imagenesPequenias.length];
                document.getElementById("imagen-grande").src = imagenesGrandes[currentIndex];
            }
            cambiarImagenes();
            setInterval(cambiarImagenes, 2000);
        })
        .catch(error => console.error('Error:', error));
});