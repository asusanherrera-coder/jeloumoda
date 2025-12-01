// =================================================================
// Archivo: carrito.js
// Descripción: Contiene las funciones para la gestión del carrito
// de compras utilizando localStorage y la redirección al pago.
// =================================================================

/**
 * Carga el carrito desde localStorage.
 * Si no hay carrito guardado, devuelve un array vacío.
 * @returns {Array} El array de productos en el carrito.
 */
function cargarCarrito() {
    try {
        const carritoGuardado = localStorage.getItem('carritoJelouModa');
        return carritoGuardado ? JSON.parse(carritoGuardado) : [];
    } catch (error) {
        console.error("Error al cargar el carrito desde localStorage:", error);
        return [];
    }
}

/**
 * Guarda el carrito en localStorage.
 * @param {Array} carrito - El array de productos del carrito a guardar.
 */
function guardarCarrito(carrito) {
    try {
        localStorage.setItem('carritoJelouModa', JSON.stringify(carrito));
    } catch (error) {
        console.error("Error al guardar el carrito en localStorage:", error);
    }
}

/**
 * Actualiza el contador de productos en el ícono del carrito en el header.
 */
function actualizarContadorCarrito() {
    const carrito = cargarCarrito();
    const contador = document.querySelector('.cart-count');
    if (contador) {
        const totalItems = carrito.reduce((sum, producto) => sum + producto.cantidad, 0);
        contador.textContent = totalItems;
        contador.style.display = totalItems > 0 ? 'flex' : 'none';
    }
}

/**
 * Agrega un producto al carrito o incrementa su cantidad si ya existe.
 * @param {Object} producto - El objeto del producto a añadir.
 */
function agregarProductoAlCarrito(producto) {
    let carrito = cargarCarrito();
    const productoExistente = carrito.find(item => item.id === producto.id);

    if (productoExistente) {
        productoExistente.cantidad += producto.cantidad;
    } else {
        carrito.push(producto);
    }

    guardarCarrito(carrito);
    actualizarContadorCarrito();
    console.log("Producto añadido al carrito:", producto);
}

/**
 * Elimina un producto del carrito.
 * @param {string} idProducto - El ID del producto a eliminar.
 */
function eliminarProductoDelCarrito(idProducto) {
    let carrito = cargarCarrito();
    const nuevoCarrito = carrito.filter(item => item.id !== idProducto);
    guardarCarrito(nuevoCarrito);
    renderizarCarrito(); // Vuelve a renderizar el carrito después de eliminar
}

/**
 * Incrementa la cantidad de un producto en el carrito.
 * @param {string} idProducto - El ID del producto.
 */
function incrementarCantidad(idProducto) {
    let carrito = cargarCarrito();
    const producto = carrito.find(item => item.id === idProducto);
    if (producto) {
        producto.cantidad++;
        guardarCarrito(carrito);
        renderizarCarrito(); // Vuelve a renderizar el carrito
    }
}

/**
 * Decrementa la cantidad de un producto en el carrito.
 * @param {string} idProducto - El ID del producto.
 */
function decrementarCantidad(idProducto) {
    let carrito = cargarCarrito();
    const producto = carrito.find(item => item.id === idProducto);
    if (producto && producto.cantidad > 1) {
        producto.cantidad--;
        guardarCarrito(carrito);
        renderizarCarrito(); // Vuelve a renderizar el carrito
    } else if (producto && producto.cantidad === 1) {
        // Elimina el producto si la cantidad llega a 1 y se intenta decrementar
        eliminarProductoDelCarrito(idProducto);
    }
}

/**
 * Muestra una notificación temporal cuando se añade un producto al carrito.
 * NOTA: Reemplazar el `console.log` por un modal personalizado para una mejor UX.
 * @param {string} nombreProducto - El nombre del producto añadido.
 */
function mostrarNotificacion(nombreProducto) {
    // console.log(`"${nombreProducto}" se ha añadido al carrito.`);
    // En lugar de un alert, se recomienda usar un modal o una notificación flotante.
    // Ejemplo (pseudocódigo): showModal(`"${nombreProducto}" se ha añadido al carrito.`);
}

/**
 * Renderiza el contenido del carrito en la página.
 */
function renderizarCarrito() {
    const carrito = cargarCarrito();
    const carritoContainer = document.getElementById('carrito-container');
    const carritoResumen = document.getElementById('carrito-resumen');

    if (!carritoContainer || !carritoResumen) return;

    if (carrito.length > 0) {
        carritoContainer.innerHTML = '';
        let total = 0;
        
        carrito.forEach(producto => {
            const item = document.createElement('div');
            item.classList.add('carrito-item');
            // NOTA: La generación de HTML con innerHTML puede ser insegura.
            // Para un proyecto más grande, se recomienda usar document.createElement.
            item.innerHTML = `
                <div class="carrito-item-info">
                    <img src="/IMG/PRODUCTOS/${producto.imagen}" alt="${producto.nombre}" style="width: 80px; height: auto; border-radius: 8px;">
                    <div>
                        <p><strong>${producto.nombre}</strong></p>
                        <p>Talla: ${producto.talla}</p>
                        <p>Precio: S/ ${producto.precio.toFixed(2)}</p>
                        <div class="cantidad-controles">
                            <button class="decrease-btn" data-id="${producto.id}">-</button>
                            <span>${producto.cantidad}</span>
                            <button class="increase-btn" data-id="${producto.id}">+</button>
                        </div>
                    </div>
                </div>
                <div class="item-actions">
                    <p>Subtotal: S/ ${(producto.precio * producto.cantidad).toFixed(2)}</p>
                    <button class="eliminar-producto" data-id="${producto.id}">Eliminar</button>
                </div>
            `;
            carritoContainer.appendChild(item);
            total += producto.precio * producto.cantidad;
        });

        const resumenHTML = `
            <h2>Resumen del Pedido</h2>
            <p>Total a pagar: <strong>S/ ${total.toFixed(2)}</strong></p>
            <button id="proceder-pago" class="generar-boleta-button">Proceder al Pago</button>
        `;
        carritoResumen.innerHTML = resumenHTML;

        // Actualiza el contador del carrito después de renderizar
        actualizarContadorCarrito();

    } else {
        carritoContainer.innerHTML = '<p>Tu carrito de compras está vacío.</p>';
        carritoResumen.innerHTML = '';
        actualizarContadorCarrito();
    }
}

// =================================================================
// Lógica principal: Listeners de eventos
// =================================================================
document.addEventListener('DOMContentLoaded', () => {
    // Renderiza el carrito cuando la página carga
    if (document.getElementById('carrito-page')) {
        renderizarCarrito();
    }
    
    // Listener de eventos para los botones de la página del carrito
    const carritoContainer = document.getElementById('carrito-container');
    if (carritoContainer) {
        carritoContainer.addEventListener('click', (e) => {
            const target = e.target;
            const idProducto = target.dataset.id;

            if (target.classList.contains('eliminar-producto')) {
                eliminarProductoDelCarrito(idProducto);
            } else if (target.classList.contains('increase-btn')) {
                incrementarCantidad(idProducto);
            } else if (target.classList.contains('decrease-btn')) {
                decrementarCantidad(idProducto);
            }
        });
    }

    // Listener para el botón "Proceder al Pago"
    document.addEventListener('click', (e) => {
        if (e.target.id === 'proceder-pago') {
            // Redirige a la página de pago
            window.location.href = 'pago.php';
        }
    });

    // Listener para los botones "Añadir al Carrito" en otras páginas (ej. Catalogo.php)
    document.body.addEventListener('click', (e) => {
        if (e.target.classList.contains('add-to-cart-button')) {
            const button = e.target;
            const producto = {
                id: button.dataset.id,
                nombre: button.dataset.nombre,
                precio: parseFloat(button.dataset.precio),
                imagen: button.dataset.imagen,
                cantidad: 1
            };
            agregarProductoAlCarrito(producto);
            mostrarNotificacion(producto.nombre);
        }
    });
});
