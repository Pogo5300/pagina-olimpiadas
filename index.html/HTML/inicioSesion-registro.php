<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>TravelHub - Login</title>
    <link rel="stylesheet" href="../CSS/header.css">
    <link rel="stylesheet" href="../CSS/inicioSesion-registro.css">
    <link rel="stylesheet" href="../CSS/footer.css">
    <link rel="icon" href="../imagenes/icono.png">
    <script src="../Javascript/menuUsuario.js"></script>
</head>
<body>
    <!--  HEADER  -->
    <header class="header">
        <?php include 'header.php'; ?>
    </header>

    <!--  MAIN  -->
    <main class="main">
        <div class="container">
            <div class="content-grid">
                <!-- Lado izquierdo - contenido publicitario -->
                <div class="marketing-section">
                    <div class="marketing-content">
                        <h2>Descubre el mundo con nosotros</h2>
                        <p>Únete a miles de viajeros que ya han encontrado sus destinos soñados. Reserva hoteles, vuelos y experiencias únicas con la mejor atención al cliente.</p>
                    </div>

                    <!-- Features -->
                    <div class="features-grid">
                        <div class="feature-card">
                            <div class="feature-icon">
                                <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                    <path d="M20 10c0 6-8 12-8 12s-8-6-8-12a8 8 0 0 1 16 0Z"/>
                                    <circle cx="12" cy="10" r="3"/>
                                </svg>
                            </div>
                            <div class="feature-content">
                                <h3>Destinos únicos</h3>
                                <p>Más de 1000 destinos disponibles</p>
                            </div>
                        </div>

                        <div class="feature-card">
                            <div class="feature-icon">
                                <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                    <polygon points="12,2 15.09,8.26 22,9.27 17,14.14 18.18,21.02 12,17.77 5.82,21.02 7,14.14 2,9.27 8.91,8.26"/>
                                </svg>
                            </div>
                            <div class="feature-content">
                                <h3>Mejor precio</h3>
                                <p>Garantía de mejor precio</p>
                            </div>
                        </div>

                        <div class="feature-card">
                            <div class="feature-icon">
                                <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                    <path d="M16 21v-2a4 4 0 0 0-4-4H6a4 4 0 0 0-4 4v2"/>
                                    <circle cx="9" cy="7" r="4"/>
                                    <path d="m22 21-3-3m0 0a2 2 0 0 0 0-4 2 2 0 0 0 0 4"/>
                                </svg>
                            </div>
                            <div class="feature-content">
                                <h3>Atención 24/7</h3>
                                <p>Soporte en todo momento</p>
                            </div>
                        </div>

                        <div class="feature-card">
                            <div class="feature-icon">
                                <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                    <circle cx="8" cy="21" r="1"/>
                                    <circle cx="19" cy="21" r="1"/>
                                    <path d="m2.05 2.05h2l2.66 12.42a2 2 0 0 0 2 1.58h9.78a2 2 0 0 0 1.95-1.57l1.65-7.43H5.12"/>
                                </svg>
                            </div>
                            <div class="feature-content">
                                <h3>Fácil reserva</h3>
                                <p>Proceso simple y seguro</p>
                            </div>
                        </div>
                    </div>

                    <!-- Stats -->
                    <div class="stats-section">
                        <div class="stat">
                            <div class="stat-number">50K+</div>
                            <div class="stat-label">Clientes felices</div>
                        </div>
                        <div class="stat">
                            <div class="stat-number">1000+</div>
                            <div class="stat-label">Destinos</div>
                        </div>
                        <div class="stat">
                            <div class="stat-number">24/7</div>
                            <div class="stat-label">Soporte</div>
                        </div>
                    </div>
                </div>

                <!-- Lado derecho - forms -->
                <div class="auth-section">
                    <div class="auth-card">
                        <div class="auth-header">
                            <h2>Bienvenido</h2>
                            <p>Inicia sesión o crea tu cuenta para comenzar tu aventura</p>
                        </div>

                        <div class="auth-content">
                            
                            <!-- Tabs -->
                            <div class="tabs">
                                <input type="radio" id="login-tab" name="auth-tabs" 
                                <?php if (!isset($_GET['tab']) || $_GET['tab'] !== 'register') echo 'checked'; ?>>

                                <input type="radio" id="register-tab" name="auth-tabs" 
                                <?php if (isset($_GET['tab']) && $_GET['tab'] === 'register') echo 'checked'; ?>>

                                
                                <div class="tab-labels">
                                    <label for="login-tab" class="tab-label">Iniciar Sesión</label>
                                    <label for="register-tab" class="tab-label">Registrarse</label>
                                </div>
                                
                                <!-- Login Form -->
                                <div class="tab-content" id="login-content">
                                    <form class="auth-form" action="../PHP/inicioSesion.php" method="post">
                                        <div class="form-group">
                                            <label for="email">Email</label>
                                            <input type="email" id="email" name="email" placeholder="tu@email.com" required>
                                        </div>

                                        <div class="form-group">
                                            <label for="password">Contraseña</label>
                                            <input type="password" id="password" name="contrasena" placeholder="••••••••" required>
                                        </div>

                                        <?php if (isset($_GET['error'])): ?>
                                            <div style="color: red; margin-bottom: 10px;">
                                                <?= htmlspecialchars($_GET['error']) ?>
                                            </div>
                                        <?php endif; ?>
                                        <button type="submit" class="btn-primary">Iniciar Sesión</button>
                                    </form>
                                </div>

                                <!-- Register Form -->
                                <div class="tab-content" id="register-content">
                                    <form class="auth-form" action="../PHP/registro.php" method="post">
                                        <div class="form-row">
                                            <div class="form-group">
                                                <label for="firstName">Nombre</label>
                                                <input type="text" id="firstName" name="nombre" placeholder="Juan" required>
                                            </div>
                                            <div class="form-group">
                                                <label for="lastName">Apellido</label>
                                                <input type="text" id="lastName" name="apellido" placeholder="Pérez" required>
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <label for="registerEmail">Email</label>
                                            <input type="email" id="registerEmail" name="email" placeholder="tu@email.com" required>
                                        </div>

                                        <div class="form-group">
                                            <label for="registerPassword">Contraseña</label>
                                            <input type="password" id="registerPassword" name="contrasena" placeholder="••••••••" required>
                                        </div>

                                        <div class="form-group">
                                            <label for="confirmPassword">Confirmar Contraseña</label>
                                            <input type="password" id="confirmPassword" name="confirmarContraseña" placeholder="••••••••" required>
                                        </div>

                                         <!-- Mensaje de error aquí -->
                                        <?php if (isset($_GET['error'])): ?>
                                            <div style="color: red; margin-bottom: 10px;">
                                                <?= htmlspecialchars($_GET['error']) ?>
                                            </div>
                                        <?php endif; ?>
                                        <div class="checkbox-group terms">
                                            <input type="checkbox" id="terms" name="terms" required>
                                            <label for="terms">
                                                Acepto los términos y condiciones y la política de privacidad
                                            </label>
                                        </div>

                                        <button type="submit" class="btn-primary">Crear Cuenta</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>

    <!--  FOOTER  -->
    <footer class="footer">
        <?php include 'footer.php'; ?>
    </footer>
</body>
</html>
