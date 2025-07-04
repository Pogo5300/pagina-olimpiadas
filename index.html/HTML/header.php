    <div class="header-container">
        <nav class="nav">
            <a href="index.php" class="logo">TravelHub</a>
            <ul class="nav-links">
                <li><a href="vuelos.php">Vuelos</a></li>
                <li><a href="alojamientos.php">Alojamientos</a></li>
                <li><a href="paquetes.php">Paquetes</a></li>
                <li><a href="ofertas.php">Ofertas</a></li>
                <li><a href="autos.php">Autos</a></li>
            </ul>
            <div class="header-actions">
                <!-- Menu de usuario -->
                <?php
session_start();
?>

<div class="user-menu">
    <?php if (isset($_SESSION['nombre']) && isset($_SESSION['apellido'])): ?>
        <!-- Si el usuario está logueado -->
        <button class="user-btn" id="userBtn">
            <?php
                $iniciales = strtoupper($_SESSION['nombre'][0] . $_SESSION['apellido'][0]);
                echo "<span class='user-initials'>$iniciales</span>";
            ?>
        </button>
        <div class="user-dropdown" id="userDropdown">
            <a href="../PHP/cerrarSesion.php">Cerrar sesión</a>
        </div>
    <?php else: ?>
        <!-- Si el usuario no está logueado -->
        <button class="user-btn" id="userBtn">
            <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                <path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"/>
                <circle cx="12" cy="7" r="4"/>
            </svg>
        </button>
        <div class="user-dropdown" id="userDropdown">
            <a href="inicioSesion-registro.php?tab=login">Iniciar sesión</a>
            <a href="inicioSesion-registro.php?tab=register">Registrarse</a>
        </div>
    <?php endif; ?>
</div>

                
                <!-- Carrito -->
                <button class="cart-btn" onclick="toggleCart()">
                    <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                        <circle cx="9" cy="21" r="1"/>
                        <circle cx="20" cy="21" r="1"/>
                        <path d="M1 1h4l2.68 13.39a2 2 0 0 0 2 1.61h9.72a2 2 0 0 0 2-1.61L23 6H6"/>
                    </svg>
                    Carrito
                    <span class="cart-count" id="cartCount">0</span>
                </button>
            </div>
        </nav>
    </div>
