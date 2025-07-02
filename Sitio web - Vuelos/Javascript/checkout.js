function getCart() {
    return JSON.parse(localStorage.getItem("carrito")) || [];
}


document.addEventListener('DOMContentLoaded', function() {
    // ... (tu código de resumen de carrito y updateFinishOrderBtn aquí)

    const paymentForm = document.getElementById('payment-method-form');
    if (paymentForm) {
        paymentForm.addEventListener('submit', function(e) {
            e.preventDefault();
            const selected = paymentForm.querySelector('input[name="payment"]:checked');
            if (!selected) return;
            if (!getCart().length) return; // chequeo extra de seguridad

            if (selected.value === "cash") {
                window.location.href = "pago-efectivo.php";
            } else if (selected.value === "card") {
                window.location.href = "pago-tarjeta.php";
            }
        });
    }
});
function renderCheckoutCart() {
    const cart = getCart();
    const checkoutCart = document.getElementById('checkout-cart');
    if (!checkoutCart) return;
    checkoutCart.innerHTML = ""; // Limpiar

    if (!cart.length) {
        checkoutCart.innerHTML = `<p>Tu carrito está vacío.</p>`;
        return;
    }

    let subtotal = 0;
    cart.forEach(item => {
        const itemTotal = item.precio * item.cantidad;
        subtotal += itemTotal;
        checkoutCart.innerHTML += `
            <div class="cart-item">
                <div class="item-info">
                    <div class="item-name">${item.nombre}</div>
                    <div class="item-details">Cantidad: ${item.cantidad} × $${item.precio.toFixed(2)}</div>
                </div>
                <div class="item-price">$${itemTotal.toFixed(2)}</div>
            </div>
        `;
    });

    // Puedes ajustar la lógica de envío según quieras
    const envio = subtotal > 0 ? 5.00 : 0.00;
    const total = subtotal + envio;

    checkoutCart.innerHTML += `
        <div class="cart-item">
            <div class="item-info">
                <div class="item-name">Envío</div>
                <div class="item-details">Envío estándar</div>
            </div>
            <div class="item-price">$${envio.toFixed(2)}</div>
        </div>
        <div class="cart-item">
            <div class="item-info">
                <div class="item-name"><b>Total</b></div>
            </div>
            <div class="item-price"><b>$${total.toFixed(2)}</b></div>
        </div>
    `;
}

function updateFinishOrderBtn() {
    const cart = getCart();
    const finishBtn = document.getElementById('finish-order-btn');
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
    renderCheckoutCart();
    updateFinishOrderBtn();

    // Escucha cada vez que el carrito cambia
    window.addEventListener('cart-updated', function() {
        renderCheckoutCart();
        updateFinishOrderBtn();
    });
});