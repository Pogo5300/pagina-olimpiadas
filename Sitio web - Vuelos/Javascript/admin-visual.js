// Solo funcionalidades visuales, sin arrays ni localStorage

document.addEventListener('DOMContentLoaded', function() {
    // Mostrar nombre admin (puedes completar esto con datos reales si los tienes en sesión)
    document.getElementById('admin-name').textContent = "Administrador";

    // Mostrar fecha actual
    const today = new Date();
    const options = { year: 'numeric', month: 'long', day: 'numeric' };
    document.getElementById('current-date').textContent = today.toLocaleDateString('es-ES', options);

    setupEventListeners();
    showSection('dashboard'); // Mostrar dashboard por defecto
});

function setupEventListeners() {
    // Navegación entre secciones
    document.querySelectorAll('.nav-link').forEach(link => {
        link.addEventListener('click', function(e) {
            e.preventDefault();
            const section = this.getAttribute('data-section');
            showSection(section);
        });
    });

    // Enlaces "ver todos"
    document.querySelectorAll('.view-all').forEach(link => {
        link.addEventListener('click', function(e) {
            e.preventDefault();
            const section = this.getAttribute('data-section');
            showSection(section);
        });
    });

    // Menú lateral responsive
    document.getElementById('sidebar-toggle').addEventListener('click', () => {
        document.querySelector('.sidebar').classList.toggle('show');
    });

    // Botón cerrar sesión (puedes agregar aquí el fetch/logout real)
    document.getElementById('logout-btn').addEventListener('click', (e) => {
        e.preventDefault();
        // window.location.href = 'logout.php'; // Ejemplo
        showToast('Sesión cerrada exitosamente.', 'info');
        document.body.innerHTML = "<h1>Sesión Cerrada</h1><p>Has cerrado sesión. <a href='admin.php'>Volver a ingresar</a></p>";
    });

    // Botón nuevo producto
    document.getElementById('add-product-btn').addEventListener('click', () => showProductModal());

    // Cerrar modales
    document.querySelectorAll('.close-modal').forEach(btn => btn.addEventListener('click', closeAllModals));
    document.getElementById('cancel-product').addEventListener('click', closeAllModals);
    document.getElementById('close-order-details').addEventListener('click', closeAllModals);

    // Toast
    document.querySelector('.toast-close').addEventListener('click', hideToast);

    // Modal de confirmación
    document.getElementById('confirm-cancel').addEventListener('click', closeAllModals);

    // Notificaciones visuales
    document.getElementById('notification-icon').addEventListener('click', toggleNotificationDropdown);
    document.getElementById('mark-all-read').addEventListener('click', (e) => {
        e.preventDefault();
        // Aquí pondrás la lógica real de marcar como leídas si usas backend
        showToast('Todas las notificaciones marcadas como leídas.', 'info');
    });
    document.addEventListener('click', function(event) {
        const dropdown = document.getElementById('notification-dropdown');
        const icon = document.getElementById('notification-icon');
        if (dropdown.classList.contains('show') && !icon.contains(event.target) && !dropdown.contains(event.target)) {
            dropdown.classList.remove('show');
        }
    });
}

// Solo visual: muestra la sección indicada y activa el menú
function showSection(sectionName) {
    document.querySelectorAll('.content-section').forEach(s => s.style.display = 'none');
    document.getElementById(`${sectionName}-section`).style.display = 'block';
    document.querySelectorAll('.nav-link').forEach(l => l.classList.remove('active'));
    document.querySelector(`.nav-link[data-section="${sectionName}"]`).classList.add('active');
    // Aquí puedes llamar a funciones AJAX de carga correspondientes, ejemplo:
    // if (sectionName === 'products') cargarProductos();
}

// Modales y Toast
function closeAllModals() {
    document.querySelectorAll('.modal').forEach(modal => modal.style.display = 'none');
}

function showProductModal() {
    // Vaciar campos del formulario (puedes adaptarlo si editas)
    document.getElementById('product-form').reset();
    document.getElementById('modal-title').textContent = "Nuevo Producto";
    document.getElementById('product-modal').style.display = 'block';
}

function showToast(message, type = 'success') {
    const toast = document.getElementById('toast');
    const toastIcon = toast.querySelector('.toast-icon i');
    const toastIconDiv = toast.querySelector('.toast-icon');
    document.getElementById('toast-message').textContent = message;
    toastIcon.className = '';
    toastIconDiv.className = 'toast-icon';
    if (type === 'success') {
        toastIcon.classList.add('fas', 'fa-check-circle');
        toastIconDiv.classList.add('bg-success');
    } else if (type === 'error') {
        toastIcon.classList.add('fas', 'fa-times-circle');
        toastIconDiv.classList.add('error');
    } else if (type === 'info') {
        toastIcon.classList.add('fas', 'fa-info-circle');
        toastIconDiv.classList.add('info');
    }
    toast.classList.add('show');
    setTimeout(() => {
        toast.classList.remove('show');
    }, 3000);
}
function hideToast() {
    document.getElementById('toast').classList.remove('show');
}

function toggleNotificationDropdown() {
    document.getElementById('notification-dropdown').classList.toggle('show');
}

// Modal de confirmación (ejemplo visual, puedes adaptar para usarlo con AJAX en el futuro)
function showConfirmModal(message, onConfirm) {
    document.getElementById('confirm-message').textContent = message;
    document.getElementById('confirm-modal').style.display = 'block';
    const confirmOkBtn = document.getElementById('confirm-ok');
    // Clonar y reemplazar para evitar múltiples listeners
    const newConfirmOkBtn = confirmOkBtn.cloneNode(true);
    confirmOkBtn.parentNode.replaceChild(newConfirmOkBtn, confirmOkBtn);
    newConfirmOkBtn.addEventListener('click', () => {
        onConfirm();
        closeAllModals();
    });
}