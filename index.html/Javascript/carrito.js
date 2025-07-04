function toggleCart(forceState) {
    const sidebar = document.getElementById('cartSidebar');
    const overlay = document.getElementById('cartOverlay');

    // Permite forzar abrir/cerrar si forceState es true/false
    if (typeof forceState === 'boolean') {
        if (forceState) {
            sidebar.classList.add('open');
            overlay.classList.add('open');
        } else {
            sidebar.classList.remove('open');
            overlay.classList.remove('open');
        }
        return;
    }

    // Si no se fuerza, alterna el estado
    sidebar.classList.toggle('open');
    overlay.classList.toggle('open');
}

// Cerrar el carrito al hacer clic en el overlay o en la X
document.addEventListener('DOMContentLoaded', function () {
    document.getElementById('cartOverlay').addEventListener('click', function () {
        toggleCart(false);
    });

    // Si usas varias X, asegúrate de que todas cierren el carrito
    document.querySelectorAll('.close-cart').forEach(function(btn) {
        btn.addEventListener('click', function () {
            toggleCart(false);
        });
    });
});


function showLoginModal() {
    document.getElementById('loginModal').style.display = 'flex';
}
function closeLoginModal() {
    document.getElementById('loginModal').style.display = 'none';
}

// Escuchar clicks en los botones "Añadir al carrito"
document.addEventListener('DOMContentLoaded', function() {
    document.querySelectorAll('.add-to-cart-btn').forEach(btn => {
        btn.addEventListener('click', function() {
            if (!window.isLoggedIn) {
                showLoginModal();
                return;
            }
            const product = {
                id: parseInt(btn.getAttribute('data-id')),
                nombre: btn.getAttribute('data-nombre'),
                precio: parseFloat(btn.getAttribute('data-precio')),
                imagen: btn.getAttribute('data-imagen')
            };
            addToCart(product);
        });
    });

    updateCartSidebar();
});

// Utilidades para el carrito en localStorage
const CART_KEY = "carrito";

// Leer carrito
function getCart() {
    return JSON.parse(localStorage.getItem(CART_KEY)) || [];
}

// Guardar carrito
function setCart(cart) {
    localStorage.setItem(CART_KEY, JSON.stringify(cart));
    // Dispara un evento personalizado
    window.dispatchEvent(new Event('cart-updated'));
}

// Agregar producto al carrito
function addToCart(product) {
    let cart = getCart();
    const index = cart.findIndex(item => item.id === product.id);
    if (index !== -1) {
        cart[index].cantidad += 1;
    } else {
        cart.push({...product, cantidad: 1});
    }
    setCart(cart);
    updateCartSidebar();
}

// Eliminar producto
function removeFromCart(id) {
    let cart = getCart().filter(item => item.id !== id);
    setCart(cart);
    updateCartSidebar();
}

// Cambiar cantidad
function updateQuantity(id, delta) {
    let cart = getCart();
    const index = cart.findIndex(item => item.id === id);
    if (index !== -1) {
        cart[index].cantidad += delta;
        if (cart[index].cantidad < 1) {
            cart.splice(index, 1);
        }
        setCart(cart);
        updateCartSidebar();
    }
}

// Renderizar el carrito en el sidebar, mostrando imagen y botones SVG
function updateCartSidebar() {
    const cart = getCart();
    const cartContent = document.getElementById('cartContent');
    const cartCount = document.getElementById('cartCount');
    const cartTotal = document.getElementById('cartTotal');

    if (!cartContent || !cartCount || !cartTotal) return;

    cartCount.textContent = cart.reduce((sum, item) => sum + item.cantidad, 0);

    if (cart.length === 0) {
        cartContent.innerHTML = `<div class="empty-cart">
            <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                <circle cx="9" cy="21" r="1"/>
                <circle cx="20" cy="21" r="1"/>
                <path d="M1 1h4l2.68 13.39a2 2 0 0 0 2 1.61h9.72a2 2 0 0 0 2-1.61L23 6H6"/>
            </svg>
            <p>Tu carrito está vacío</p>
            <p>Explora nuestras ofertas y añade productos</p>
        </div>`;
        cartTotal.textContent = "Total: €0";
        return;
    }

    cartContent.innerHTML = cart.map(item => `
        <div class="cart-item">
            <div class="cart-item-img">
                <img src="${item.imagen}" alt="${item.nombre}" onerror="this.onerror=null;this.src='https://via.placeholder.com/60?text=No+Img';" />
            </div>
            <div class="cart-item-info">
                <span class="cart-item-name">${item.nombre}</span>
                <span class="cart-item-price">€${item.precio.toFixed(2)}</span>
                <div class="cart-item-controls">
                    <button class="cart-btn-qty" onclick="updateQuantity(${item.id}, -1)" aria-label="Restar">
                        <svg width="20" height="20" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                            <line x1="5" y1="12" x2="19" y2="12"/>
                        </svg>
                    </button>
                    <span class="cart-item-cantidad">${item.cantidad}</span>
                    <button class="cart-btn-qty" onclick="updateQuantity(${item.id}, 1)" aria-label="Sumar">
                        <svg width="20" height="20" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                            <line x1="12" y1="5" x2="12" y2="19"/>
                            <line x1="5" y1="12" x2="19" y2="12"/>
                        </svg>
                    </button>
                    <button class="cart-btn-remove" onclick="removeFromCart(${item.id})" aria-label="Eliminar">
                        <svg width="20" height="20" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                            <polyline points="3 6 5 6 21 6"/>
                            <path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h2a2 2 0 0 1 2 2v2"/>
                            <line x1="10" y1="11" x2="10" y2="17"/>
                            <line x1="14" y1="11" x2="14" y2="17"/>
                        </svg>
                    </button>
                </div>
            </div>
        </div>
    `).join('');

    const total = cart.reduce((sum, item) => sum + item.precio * item.cantidad, 0);
    cartTotal.textContent = `Total: €${total.toFixed(2)}`;
}

function showEmptyCartModal() {
    document.getElementById('emptyCartModal').style.display = 'flex';
}
function closeEmptyCartModal() {
    document.getElementById('emptyCartModal').style.display = 'none';
}

function goToCheckout() {
    const cart = getCart();
    if (!cart || cart.length === 0) {
        showEmptyCartModal();
        return;
    }
    window.location.href = 'checkout.php';
}