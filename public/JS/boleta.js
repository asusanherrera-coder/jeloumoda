document.addEventListener("DOMContentLoaded", function () {
    const generarBoletaBtn = document.getElementById("generar-boleta");
    if (!generarBoletaBtn) return;

    generarBoletaBtn?.addEventListener("click", () => {
        // Obtener productos del localStorage
        const carrito = JSON.parse(localStorage.getItem("carrito")) || [];

        if (carrito.length === 0) {
            alert("Tu carrito está vacío. Agrega productos antes de generar la boleta.");
            return;
        }

        const fecha = new Date().toLocaleDateString();
        let total = 0;

        const productos = carrito.map(item => {
            const subtotal = item.precio * item.cantidad;
            total += subtotal;
            return {
                nombre: item.nombre,
                cantidad: item.cantidad,
                precio: item.precio,
            };
        });

        const contenido = `
            <div style="padding: 20px; font-family: Arial;">
                <h2 style="text-align: center;">Jelou Moda</h2>
                <p><strong>Fecha:</strong> ${fecha}</p>
                <p><strong>Cliente:</strong> Cliente genérico</p>
                <table style="width: 100%; border-collapse: collapse; margin-top: 10px;">
                    <thead>
                        <tr>
                            <th style="border: 1px solid #000; padding: 5px;">Producto</th>
                            <th style="border: 1px solid #000; padding: 5px;">Cantidad</th>
                            <th style="border: 1px solid #000; padding: 5px;">Precio</th>
                        </tr>
                    </thead>
                    <tbody>
                        ${productos.map(prod => `
                            <tr>
                                <td style="border: 1px solid #000; padding: 5px;">${prod.nombre}</td>
                                <td style="border: 1px solid #000; padding: 5px;">${prod.cantidad}</td>
                                <td style="border: 1px solid #000; padding: 5px;">S/ ${(prod.precio * prod.cantidad).toFixed(2)}</td>
                            </tr>`).join('')}
                    </tbody>
                </table>
                <h3 style="text-align: right; margin-top: 10px;">Total: S/ ${total.toFixed(2)}</h3>
            </div>
        `;

        const ventana = window.open("", "Boleta", "width=800,height=600");
        ventana.document.write(`<html><head><title>Boleta</title></head><body>${contenido}</body></html>`);
        ventana.document.close();

        setTimeout(() => {
            ventana.print();
        }, 1000);
    });
});