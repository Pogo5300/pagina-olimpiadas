// Función para cerrar el modal de éxito
function closeSuccessModal() {
    document.getElementById('success-modal').style.display = 'none';
}
// Verifica que el DOM esté listo antes de agregar el listener
document.addEventListener('DOMContentLoaded', function() {
    // Oculta el modal al inicio
    document.getElementById('success-modal').style.display = 'none';

    // Genera número de pedido al cargar
    const orderNumber = generateOrderNumber();
    document.getElementById('order-number').textContent = orderNumber;

    renderOrderItems();
    // Asegúrate de que el botón existe antes de agregar el listener
    var btn = document.getElementById('confirm-order');
    if (!btn) {
        console.error("No se encontró el botón #confirm-order");
        return;
    }

    btn.addEventListener('click', async function() {
         alert("¡El botón funciona!"); // Verifica que esto aparezca
        const nombre = "<?php echo htmlspecialchars($nombre); ?>";
        const apellido = "<?php echo htmlspecialchars($apellido); ?>";
        const email = "<?php echo htmlspecialchars($email); ?>";
        const usuario_id = "<?php echo isset($_SESSION['id_usuario']) ? intval($_SESSION['id_usuario']) : 0; ?>";
        const cart = getCart();
        if (!cart.length) return alert("Carrito vacío");

        // Generar datos de pedido
        const total = window.orderTotalValue || cart.reduce((sum, item) => sum + item.precio * item.cantidad, 0);
        const metodo_pago = "Efectivo";
        const codigo_verificacion = Math.floor(100000 + Math.random() * 900000).toString();
        const numero_pedido = generateOrderNumber();

        // AJAX para guardar el pedido
        const response = await fetch('../PHP/guardar_pedido.php', {
          method: 'POST',
          headers: { 'Content-Type': 'application/json' },
          body: JSON.stringify({
            usuario_id,
            total,
            metodo_pago,
            codigo_verificacion,
            carrito: cart
          })
        });
        const result = await response.json();

        if (result.success) {
          // Rellenar y mostrar el modal
          document.getElementById('success-title').innerText = "¡Tu pedido fue realizado con éxito!";
          document.getElementById('success-text').innerText = "Hemos procesado tu solicitud correctamente.";
          document.getElementById('confirmation-email').innerText = email;
          document.getElementById('confirmation-order').innerText = result.pedido_codigo || numero_pedido;
          document.getElementById('confirmation-total').innerText = total.toFixed(2);
          document.getElementById('confirmation-code').innerText = codigo_verificacion;

          document.getElementById('success-modal').style.display = 'flex';
          // Limpiar carrito SOLO si el pedido fue guardado
          localStorage.removeItem("carrito");
          renderOrderItems();
        } else {
          alert("Hubo un error al guardar el pedido. Intenta nuevamente.");
        }
    });
});


//
function getCart() {
    return JSON.parse(localStorage.getItem("carrito")) || [];
}

function renderOrderItems() {
    const orderItems = document.getElementById('order-items');
    const orderTotal = document.getElementById('order-total');
    if (!orderItems || !orderTotal) return;
    orderItems.innerHTML = "";
    let total = 0;
    const cart = getCart();
    if (cart.length === 0) {
        orderItems.innerHTML = "<p>Tu carrito está vacío.</p>";
        orderTotal.textContent = "$0.00";
        window.orderTotalValue = 0;
        return;
    }
    cart.forEach(item => {
        const itemTotal = item.precio * item.cantidad;
        total += itemTotal;
        orderItems.innerHTML += `
            <div class="order-item">
                <div class="item-image"><img src="${item.imagen || 'https://via.placeholder.com/32'}" style="width:78px;height:62px;border-radius:6px;"></div>
                <div class="item-details">
                    <div class="item-name">${item.nombre}</div>
                    <div class="item-description">${item.descripcion || ""}</div>
                    <div class="item-quantity">Cantidad: ${item.cantidad}</div>
                </div>
                <div class="item-price">$${itemTotal.toFixed(2)}</div>
            </div>
        `;
    });
    orderTotal.textContent = `$${total.toLocaleString(undefined, {minimumFractionDigits: 2, maximumFractionDigits: 2})}`;
    window.orderTotalValue = total;
}

function generateOrderNumber() {
    const now = new Date();
    const year = now.getFullYear();
    const rand = Math.floor(100 + Math.random()*900);
    return `TV-${year}-${rand}`;
}

function generateVerificationCode() {
    return Math.floor(100000 + Math.random() * 900000);
}

function updateFinishOrderBtn() {
    const cart = getCart();
    const finishBtn = document.getElementById('confirm-order');
    if (!finishBtn) return;
    if (!cart.length) {
        finishBtn.disabled = true;
        finishBtn.classList.add('disabled');
    } else {
        finishBtn.disabled = false;
        finishBtn.classList.remove('disabled');
    }
}

// Ejecutar al cargar la página de checkout
document.addEventListener('DOMContentLoaded', function() {
    // Escucha cada vez que el carrito cambia
    window.addEventListener('cart-updated', function() {
        renderOrderItems();
        updateFinishOrderBtn();
    });
});



