<?php
    session_start();

    if (!isset($_SESSION['rol']) || $_SESSION['rol'] !== 'admin') {
        echo "Acceso denegado. Debes iniciar sesión como administrador.";
        exit();
    }

    require_once "../PHP/Conexion.php";
    $conexion = Conexion();
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Panel de Administración - TurismoPlus</title>
    <link rel="stylesheet" href="../CSS/admin-styles.css">
    <!-- Font Awesome para iconos -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="icon" href="../imagenes/icono.png">
</head>
<body>
    <div class="admin-wrapper">
        <!--  SIDEBAR  -->
        <aside class="sidebar">
            <div class="sidebar-header">
                <h2><i class="fas fa-mountain"></i> TravelHub</h2>
                <span class="admin-badge">ADMIN</span>
            </div>
            
            <div class="sidebar-user">
                <div class="user-avatar">
                    <i class="fas fa-user"></i>
                </div>
                <div class="user-info">
                    <h3 id="admin-name">Administrador</h3>
                    <p>Jefe de Ventas</p>
                </div>
            </div>
            
            <nav class="sidebar-nav">
                <ul>
                    <li>
                        <a href="#" class="nav-link active" data-section="dashboard">
                            <i class="fas fa-tachometer-alt"></i>
                            <span>Dashboard</span>
                        </a>
                    </li>
                    <li>
                        <a href="#" class="nav-link" data-section="products">
                            <i class="fas fa-suitcase"></i>
                            <span>Productos</span>
                        </a>
                    </li>
                    <li>
                        <a href="#" class="nav-link" data-section="orders">
                            <i class="fas fa-shopping-cart"></i>
                            <span>Pedidos</span>
                        </a>
                    </li>
                    <li>
                        <a href="#" class="nav-link" data-section="users">
                            <i class="fas fa-users"></i>
                            <span>Usuarios</span>
                        </a>
                    </li>
                </ul>
            </nav>
            
            <div class="sidebar-footer">
                <a href="#" id="logout-btn">
                    <i class="fas fa-sign-out-alt"></i>
                    <span>Cerrar Sesión</span>
                </a>
                <a href="index.php" class="home-link">
                    <i class="fas fa-home"></i>
                    <span>Ir al Sitio</span>
                </a>
            </div>
        </aside>

        <!--  CONTENIDO PRINCIPAL  -->
        <main class="main-content">
            <header class="top-header">
                <button id="sidebar-toggle" class="sidebar-toggle">
                    <i class="fas fa-bars"></i>
                </button>
                <div class="search-container">
                    
                </div>
                <div class="header-actions">
                    <div class="notification-bell" id="notification-icon">
                        <i class="fas fa-bell"></i>
                        <span class="notification-count" id="notification-count-badge">0</span>
                        <div class="notification-dropdown" id="notification-dropdown">
                            <div class="notification-header">
                                <h4>Notificaciones</h4>
                                <a href="#" id="mark-all-read">Marcar todas como leídas</a>
                            </div>
                            <ul class="notification-list" id="notification-list-items">
                                <!-- Las notificaciones se cargarán aquí -->
                                <li class="no-notifications">No hay notificaciones nuevas.</li>
                            </ul>
                            <div class="notification-footer">
                                <a href="#">Ver todas las notificaciones</a>
                            </div>
                        </div>
                    </div>
                    <div class="date-display">
                        <i class="fas fa-calendar"></i>
                        <span id="current-date"></span>
                    </div>
                </div>
            </header>

            <!--  Sección DASHBOARD  -->
            <section id="dashboard-section" class="content-section">
                <div class="section-header">
                    <h1>Dashboard</h1>
                    <p>Resumen general del sistema</p>
                </div>

                <div class="stats-cards">
                    <div class="stat-card">
                        <div class="stat-card-icon blue">
                            <i class="fas fa-suitcase"></i>
                        </div>
                        <div class="stat-card-info">
                            <h3>Paquetes</h3>
                            <p id="total-products">0</p>
                        </div>
                    </div>
                    <div class="stat-card">
                        <div class="stat-card-icon green">
                            <i class="fas fa-shopping-cart"></i>
                        </div>
                        <div class="stat-card-info">
                            <h3>Pedidos</h3>
                            <p id="total-orders-dash">0</p>
                        </div>
                    </div>
                    <div class="stat-card">
                        <div class="stat-card-icon purple">
                            <i class="fas fa-users"></i>
                        </div>
                        <div class="stat-card-info">
                            <h3>Usuarios</h3>
                            <p id="total-users-dash">0</p>
                        </div>
                    </div>
                    <div class="stat-card">
                        <div class="stat-card-icon orange">
                            <i class="fas fa-dollar-sign"></i>
                        </div>
                        <div class="stat-card-info">
                            <h3>Ventas</h3>
                            <p id="total-sales-dash">$0</p>
                        </div>
                    </div>
                </div>

                <div class="dashboard-grid">
                    <div class="dashboard-card">
                        <div class="card-header">
                            <h3>Últimos Pedidos</h3>
                            <a href="#" class="view-all" data-section="orders">Ver todos</a>
                        </div>
                        <div class="card-content">
                            <table class="mini-table">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Cliente</th>
                                        <th>Fecha</th>
                                        <th>Total</th>
                                        <th>Estado</th>
                                    </tr>
                                </thead>
                                <tbody id="recent-orders-table">
                                    <!-- Se cargará dinámicamente -->
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="dashboard-card">
                        <div class="card-header">
                            <h3>Paquetes Populares</h3>
                            <a href="#" class="view-all" data-section="products">Ver todos</a>
                        </div>
                        <div class="card-content">
                            <div id="popular-products">
                                <!-- Se cargará dinámicamente -->
                            </div>
                        </div>
                    </div>
                </div>
            </section>

            <!--  Sección PRODUCTOS  -->
            <section id="products-section" class="content-section" style="display: none;">
                <div class="section-header">
                    <h1>Gestión de Productos</h1>
                    <button id="add-product-btn" class="btn btn-primary">
                        <i class="fas fa-plus"></i> Nuevo Producto
                    </button>
                </div>

                <div class="filter-bar">
                    <div class="search-box">
                        <i class="fas fa-search"></i>
                        <input type="text" id="product-search" placeholder="Buscar paquetes...">
                    </div>
                    <div class="filter-options">
                        <select id="category-filter">
                            <option value="">Todas las categorías</option>
                            <option value="vuelos">Vuelos</option>
                            <option value="alojamiento">Alojamiento</option>
                            <option value="paquete">Paquete</option>
                            <option value="oferta">Oferta</option>
                            <option value="autos">Auto</option>
                        </select>
                        <select id="sort-products">
                            <option value="name-asc">Nombre (A-Z)</option>
                            <option value="name-desc">Nombre (Z-A)</option>
                            <option value="price-asc">Precio (Menor a Mayor)</option>
                            <option value="price-desc">Precio (Mayor a Menor)</option>
                        </select>
                    </div>
                </div>
    
                <div class="data-table-container">
                    <table class="data-table">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Nombre</th>
                                <th>Descripción</th>
                                <th>Precio</th>
                                <th>Imagen</th>
                                <th>Categoría</th>
                                <th>Features</th>
                                <th>Acciones</th>
                            </tr>
                        </thead>
                        <tbody id="products-table-body">
                            <!-- Se cargará dinámicamente -->
                        </tbody>
                    </table>
                </div>

                <!-- Modal para agregar/editar producto -->
                <div id="product-modal" class="modal">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h2 id="modal-title">Nuevo Producto</h2>
                            <span class="close-modal">&times;</span>
                        </div>
                        <div class="modal-body">
                            <form id="product-form">
                                <input type="hidden" id="product-id">
                                <div class="form-row">
                                    <div class="form-group">
                                        <label for="product-name-input">Nombre</label>
                                        <input type="text" id="product-name-input" required>
                                    </div>
                                    <div class="form-group">
                                        <label for="product-category-input">Categoría</label>
                                        <select id="product-category-input" required>
                                            <option value="vuelos">Vuelos</option>
                                            <option value="alojamiento">Alojamiento</option>
                                            <option value="paquete">Paquete</option>
                                            <option value="oferta">Oferta</option>
                                            <option value="autos">Autos</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-row">
                                    <div class="form-group">
                                        <label for="product-price-input">Precio</label>
                                        <input type="number" id="product-price-input" step="0.01" min="0" required>
                                    </div>
                                    <div class="form-group">
                                        <label for="product-image-input">Imagen (URL)</label>
                                        <input type="text" id="product-image-input" placeholder="https://...">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="product-features-input">Features (separados por coma)</label>
                                    <input type="text" id="product-features-input" placeholder="Piscina, Spa, Wifi">
                                </div>
                                <div class="form-group">
                                    <label for="product-description-input">Descripción</label>
                                    <textarea id="product-description-input" rows="4"></textarea>
                                </div>
                                <div class="form-actions">
                                    <button type="button" class="btn btn-secondary" id="cancel-product">Cancelar</button>
                                    <button type="submit" class="btn btn-primary">Guardar</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </section>

            <!-- Sección PEDIDOS -->
            <section id="orders-section" class="content-section" style="display: none;">
                <div class="section-header">
                    <h1>Gestión de Pedidos</h1>
                </div>

                <div class="filter-bar">
                    <div class="search-box">
                        <i class="fas fa-search"></i>
                        <input type="text" id="order-search" placeholder="Buscar por cliente...">
                    </div>
                    <div class="filter-options">
                        <select id="status-filter">
                            <option value="">Todos los estados</option>
                            <option value="Pendiente">Pendiente</option>
                            <option value="Completado">Completado</option>
                            <option value="Cancelado">Cancelado</option>
                        </select>
                        <select id="sort-orders">
                            <option value="date-desc">Fecha (Reciente primero)</option>
                            <option value="date-asc">Fecha (Antiguo primero)</option>
                            <option value="total-desc">Total (Mayor a Menor)</option>
                            <option value="total-asc">Total (Menor a Mayor)</option>
                        </select>
                    </div>
                </div>

                <div class="data-table-container">
                    <table class="data-table">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Cliente</th>
                                <th>Fecha</th>
                                <th>Total</th>
                                <th>Estado</th>
                                <th>Detalles</th>
                            </tr>
                        </thead>
                        <tbody id="orders-table-body">
                            <!-- Se cargará dinámicamente -->
                        </tbody>
                    </table>
                </div>

                <!-- Modal para ver detalles del pedido -->
                <div id="order-modal" class="modal">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h2>Detalles del Pedido</h2>
                            <span class="close-modal">&times;</span>
                        </div>
                        <div class="modal-body">
                            <div class="order-details">
                                <div class="order-info">
                                    <h3>Información del Pedido</h3>
                                    <p><strong>ID:</strong> <span id="order-id-detail"></span></p>
                                    <p><strong>Cliente:</strong> <span id="order-customer-detail"></span></p>
                                    <p><strong>Fecha:</strong> <span id="order-date-detail"></span></p>
                                    <p><strong>Estado:</strong> <span id="order-status-detail"></span></p>
                                </div>
                                <div class="order-items">
                                    <h3>Productos</h3>
                                    <table class="mini-table">
                                        <thead>
                                            <tr>
                                                <th>Producto</th>
                                                <th>Cantidad</th>
                                                <th>Precio</th>
                                                <th>Total</th>
                                            </tr>
                                        </thead>
                                        <tbody id="order-items-table">
                                            <!-- Se cargará dinámicamente -->
                                        </tbody>
                                    </table>
                                </div>
                                <div class="order-summary">
                                    <div class="summary-row">
                                        <span>Subtotal:</span>
                                        <span id="order-subtotal-detail"></span>
                                    </div>
                                    <div class="summary-row">
                                        <span>Impuestos (21%):</span>
                                        <span id="order-tax-detail"></span>
                                    </div>
                                    <div class="summary-row total">
                                        <span>Total:</span>
                                        <span id="order-total-detail"></span>
                                    </div>
                                </div>
                                <div class="order-actions">
                                    <button id="change-status-btn" class="btn btn-primary">Cambiar Estado</button>
                                    <button id="close-order-details" class="btn btn-secondary">Cerrar</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>

            <!-- Sección USUARIOS -->
            <section id="users-section" class="content-section" style="display: none;">
                <div class="section-header">
                    <h1>Gestión de Usuarios</h1>
                </div>

                <div class="filter-bar">
                    <div class="search-box">
                        <i class="fas fa-search"></i>
                        <input type="text" id="user-search" placeholder="Buscar usuarios...">
                    </div>
                    <div class="filter-options">
                        <select id="sort-users">
                            <option value="name-asc">Nombre (A-Z)</option>
                            <option value="name-desc">Nombre (Z-A)</option>
                            <option value="date-desc">Fecha de registro (Reciente primero)</option>
                            <option value="date-asc">Fecha de registro (Antiguo primero)</option>
                        </select>
                    </div>
                </div>

                <div class="data-table-container">
                    <table class="data-table">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Nombre</th>
                                <th>Email</th>
                                <th>Teléfono</th>
                                <th>Fecha Registro</th>
                                <th>Acciones</th>
                            </tr>
                        </thead>
                        <tbody id="users-table-body">
                            <!-- Se cargará dinámicamente -->
                        </tbody>
                    </table>
                </div>
            </section>

            <!-- Toast para notificaciones -->
            <div id="toast" class="toast">
                <div class="toast-icon">
                    <i class="fas fa-check-circle"></i>
                </div>
                <div class="toast-content">
                    <p id="toast-message"></p>
                </div>
                <div class="toast-close">
                    <i class="fas fa-times"></i>
                </div>
            </div>

            <!-- Modal de confirmación -->
            <div id="confirm-modal" class="modal">
                <div class="modal-content confirm-content">
                    <div class="modal-header">
                        <h2>Confirmar Acción</h2>
                    </div>
                    <div class="modal-body">
                        <p id="confirm-message">¿Estás seguro de que deseas realizar esta acción?</p>
                        <div class="confirm-actions">
                            <button id="confirm-cancel" class="btn btn-secondary">Cancelar</button>
                            <button id="confirm-ok" class="btn btn-danger">Confirmar</button>
                        </div>
                    </div>
                </div>
            </div>
        </main>
    </div>
    <script src="../Javascript/admin-visual.js"></script>
    <script src="../Javascript/agregar_producto.js"></script>
    <script src="../Javascript/admin-scriptNuevo.js"></script>
</body>
</html>