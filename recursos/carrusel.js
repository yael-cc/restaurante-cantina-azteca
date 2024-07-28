
let cronometro;
let imagenNumero = 0;
cronometro = setInterval(siguienteImagen, 3000);

let carrusel = document.querySelector('.carrusel');
let carruselBotones = document.getElementsByClassName('carrusel-btn');

Array.from(carruselBotones).forEach((boton, indice) => {
    boton.addEventListener('click', () => {
        
        let left = indice * -100;
        carrusel.style.left = left + '%';
        imagenNumero = indice;

        clearInterval(cronometro);
        cronometro = setInterval(siguienteImagen, 3000);
        
    });
});

function siguienteImagen() {
    imagenNumero = ++imagenNumero % carruselBotones.length;  
    carrusel.style.left = imagenNumero * -100 + '%';
}


