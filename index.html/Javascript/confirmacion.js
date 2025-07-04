// Asume que el carrito está guardado en localStorage con clave "carrito"
function mostrarResumenPedido() {
    const carrito = JSON.parse(localStorage.getItem("carrito")) || [];
    const orderItemsDiv = document.querySelector('.order-items');
    const orderTotalDiv = document.querySelector('.order-total .total-amount');

    if (!carrito.length) {
        orderItemsDiv.innerHTML = "<p>Tu carrito está vacío.</p>";
        orderTotalDiv.textContent = "$0.00";
        return;
    }

    orderItemsDiv.innerHTML = carrito.map(item => `
        <div class="order-item">
            <div class="item-image">
                <img src="${item.imagen}" alt="${item.nombre}" width="40" height="40" style="border-radius:8px;object-fit:cover;">
            </div>
            <div class="item-details">
                <div class="item-name">${item.nombre}</div>
                <div class="item-description">${item.descripcion || ''}</div>
                <div class="item-quantity">Cantidad: ${item.cantidad}</div>
            </div>
            <div class="item-price">$${(item.precio * item.cantidad).toFixed(2)}</div>
        </div>
    `).join('');

    const total = carrito.reduce((s, i) => s + i.precio * i.cantidad, 0);
    orderTotalDiv.textContent = `$${total.toLocaleString('es-AR', {minimumFractionDigits: 2})}`;
}
document.addEventListener("DOMContentLoaded", mostrarResumenPedido);


document.getElementById('confirm-order').addEventListener('click', function() {
    // Aquí puedes enviar los datos al backend usando fetch/AJAX (opcional)
    // fetch('/api/confirmar-pedido.php', { ... })

    // Limpiar el carrito
    localStorage.removeItem('carrito');

    // Mostrar mensaje de éxito y ocultar el botón
    document.getElementById('confirmation-section').style.display = 'none';
    document.getElementById('success-message').style.display = 'block';

    // Si quieres, puedes actualizar el código de pedido y email en el mensaje de éxito dinámicamente
});