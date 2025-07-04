<div class="cart-overlay" id="cartOverlay"></div>
<div class="cart-sidebar" id="cartSidebar">
    <div class="cart-header">
        <h3>Tu carrito</h3>
        <button class="close-cart" onclick="toggleCart()">
            X
        </button>
    </div>
    <div class="cart-content" id="cartContent">
        <div class="empty-cart">
            <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                <circle cx="9" cy="21" r="1"/>
                <circle cx="20" cy="21" r="1"/>
                <path d="M1 1h4l2.68 13.39a2 2 0 0 0 2 1.61h9.72a2 2 0 0 0 2-1.61L23 6H6"/>
            </svg>
            <p>Tu carrito está vacío</p>
            <p>Explora nuestras ofertas y añade productos</p>
        </div>
    </div>
    <div class="cart-footer">
        <div class="cart-total" id="cartTotal">
            Total: €0
        </div>
        <button class="cart-btn" onclick="goToCheckout()">
            Proceder al pago
        </button>
    </div>
</div>

<div id="emptyCartModal" class="modal" style="display:none;">
  <div class="modal-content">
    <span class="close-modal" onclick="closeEmptyCartModal()">&times;</span>
    <h3>¡Tu carrito está vacío!</h3>
    <p>Por favor, agrega productos al carrito antes de proceder al pago.</p>
    <button class="modal-login-btn" onclick="closeEmptyCartModal()">Entendido</button>
  </div>
</div>