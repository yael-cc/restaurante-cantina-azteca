const carritoBoton = document.querySelector('.carrito-boton');
const carritoFondo = document.querySelector('.carrito-fondo');
let carritoVisible = false;

carritoBoton.addEventListener('click', ()=> {
    carritoVisible = !carritoVisible;

    if (carritoVisible) {
        carritoFondo.style.visibility = "visible";
    }else{
        carritoFondo.style.visibility = "hidden";
    }
});

////////////////////////////// BOTONES QUITAR /////////////////////


////////////////////// ACTUALIZAR TOTAL /////////////////////

function actualizarTotal() {
    const precios = document.querySelectorAll('.renglon .precio');
    const total = document.querySelector('.precio-Total');

    let sumaTotal=0;

    Array.from(precios).forEach((precio)=>{
        sumaTotal += Number.parseFloat(precio.innerHTML.substring(1));
    });

    total.innerHTML = '$'+sumaTotal.toFixed(2);

}

////////////////////// BOTONES AGREGAR POSTRES /////////////////////
document.addEventListener("DOMContentLoaded", function() {
    const botonesAgregar = document.getElementsByClassName('compra-pedido');

    Array.from(botonesAgregar).forEach((boton) => {
        boton.addEventListener('click', evento => {
            let nombre = evento.target.closest('.cont-imagen').querySelector('.nombre');
            let precio = evento.target.closest('.cont-imagen').querySelector('.precio');
            
            agregarAlCarrito(nombre.innerHTML, precio.innerHTML);
        })
    })

    function agregarAlCarrito(nombre, precio){
        const productos = document.querySelector('.productos');
        let renglon = document.createElement('div');
        renglon.classList.add('renglon');
        renglon.innerHTML  = 
        `<p class="postre">${nombre}</p>
        <p class="precio">$${precio}</p>
        <button class="boton-quitar">Quitar</button>
        `
        
        const boton = renglon.querySelector('.boton-quitar');

        boton.addEventListener('click', removerProducto)

        productos.append(renglon);
        alert('Producto agregado al carrito.');
        actualizarTotal();
    }
});