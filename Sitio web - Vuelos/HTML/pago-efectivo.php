<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>TravelHub - Reserva</title>
    <link rel="stylesheet" href="../CSS/header.css">
    <link rel="stylesheet" href="../CSS/pago-efectivo.css">
    <link rel="stylesheet" href="../CSS/footer.css">
    <link rel="stylesheet" href="../CSS/carrito.css">
    <link rel="icon" href="../imagenes/icono.png">
    <script src="../Javascript/menuUsuario.js"></script>
    <script src="../Javascript/carrito.js"></script>
    <script src="../Javascript/pago-efectivo.js"></script>
</head>
<body>
    <!-- HEADER -->
    <header class="header">
        <?php include 'header.php'; ?>
    </header>

    <?php
$nombre = isset($_SESSION['nombre']) ? $_SESSION['nombre'] : '';
$apellido = isset($_SESSION['apellido']) ? $_SESSION['apellido'] : '';
$email = isset($_SESSION['email']) ? $_SESSION['email'] : '';
// Para las iniciales:
function getInitials($nombre, $apellido) {
    $iniciales = '';
    if ($nombre) $iniciales .= strtoupper($nombre[0]);
    if ($apellido) $iniciales .= strtoupper($apellido[0]);
    return $iniciales;
}
$iniciales = getInitials($nombre, $apellido);
?>
    <main>
<div class="container">
        <div class="container-header">
            <div class="header-content">
                <div>
                    <svg class="travel-icon" width="20" height="20" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path d="M2.5 19.5l19-7-19-7v6l15 1-15 1z"/></svg>
                </div>
                <h1>Confirmar tu Pedido</h1>
                <p>Revisa los detalles antes de finalizar tu compra</p>
            </div>
        </div>

        <div class="content">
            <!-- Datos del Usuario -->
            <div class="section">
                <h2 class="section-title">
                    <span><svg width="20" height="20" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><circle cx="12" cy="8" r="4"/><path d="M2 20c0-4 8-6 10-6s10 2 10 6"/></svg></span>
                    Datos del Usuario
                </h2>
                

<div class="user-info">
    <div class="user-avatar" id="user-avatar">
        <?php
        if (isset($_SESSION['nombre']) && isset($_SESSION['apellido'])) {
            echo strtoupper($_SESSION['nombre'][0] . $_SESSION['apellido'][0]); // iniciales
        } else {
            echo '??';
        }
        ?>
    </div>
    <div class="user-details">
        <h3 id="user-name">
            <?php
            if (isset($_SESSION['nombre']) && isset($_SESSION['apellido'])) {
                echo htmlspecialchars($_SESSION['nombre'] . ' ' . $_SESSION['apellido']);
            } else {
                echo 'Invitado';
            }
            ?>
        </h3>
        <p id="user-email">
            <?php
            echo isset($_SESSION['email']) ? htmlspecialchars($_SESSION['email']) : 'No logueado';
            ?>
        </p>
        <p>✓ Usuario verificado</p>
    </div>
</div>

            </div>

            <!-- Resumen del Pedido -->
            <div class="section">
                <h2 class="section-title">
                    <span><svg width="20" height="20" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><circle cx="9" cy="21" r="1"/><circle cx="20" cy="21" r="1"/><path d="M1 1h4l2.68 13.39a2 2 0 0 0 2 1.61h9.72a2 2 0 0 0 2-1.61L23 6H6"/></svg></span>
                    Resumen del Pedido
                </h2>
                <div class="order-summary">
                    <div class="order-header">
                        <h3 id="order-number">Pedido #TV-2024-001</h3>
                    </div>
                    <div class="order-items" id="order-items"></div>
                    <div class="order-total">
                        <div class="total-amount" id="order-total"></div>
                        <div class="total-label">Total a Pagar en Efectivo</div>
                    </div>
                </div>
            </div>

            <!-- Instrucciones -->
            <div class="section">
                <h2 class="section-title">
                    <span><svg width="20" height="20" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><rect x="5" y="3" width="14" height="18" rx="2"/><path d="M9 7h6"/><path d="M9 11h6"/><path d="M9 15h2"/></svg></span>
                    Instrucciones de Pago
                </h2>
                <div class="instructions">
                    <h3>
                        <span>💡</span>
                        ¿Cómo funciona el pago en efectivo?
                    </h3>
                    <ul class="instruction-list">
                        <li class="instruction-item">
                            <div class="instruction-number">1</div>
                            <div class="instruction-text">
                                Al confirmar tu pedido, recibirás un <strong>código de verificación único</strong> en tu correo electrónico.
                            </div>
                        </li>
                        <li class="instruction-item">
                            <div class="instruction-number">2</div>
                            <div class="instruction-text">
                                Dirígete a nuestra oficina con tu <strong>código de verificación</strong> y tu <strong>DNI</strong>.
                            </div>
                        </li>
                        <li class="instruction-item">
                            <div class="instruction-number">3</div>
                            <div class="instruction-text">
                                Realiza el pago en efectivo por <strong>$1,215.00</strong> y recibe tu confirmación de viaje.
                            </div>
                        </li>
                        <li class="instruction-item">
                            <div class="instruction-number">4</div>
                            <div class="instruction-text">
                                ¡Listo! Recibirás todos los documentos de viaje y podrás comenzar tu aventura.
                            </div>
                        </li>
                    </ul>
                </div>
            </div>

            <!-- Detalles Adicionales -->
            <div class="section">
                <h2 class="section-title">
                    <span><svg width="20" height="20" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><circle cx="12" cy="12" r="10"/><line x1="12" y1="16" x2="12" y2="12"/><line x1="12" y1="8" x2="12" y2="8"/></svg></span>
                    Información Importante
                </h2>
                <div class="additional-details">
                    <div class="detail-card">
                        <div class="detail-icon">🏢</div>
                        <div class="detail-title">Oficina de Retiro</div>
                        <div class="detail-text">
                            Av. Aventura 456, Local 12<br>
                            <strong>Horarios:</strong><br>
                            Lun-Vie: 9:00 - 18:00<br>
                            Sáb: 9:00 - 14:00
                        </div>
                    </div>
                    <div class="detail-card">
                        <div class="detail-icon">⏰</div>
                        <div class="detail-title">Tiempo Límite</div>
                        <div class="detail-text">
                            Tienes <strong>7 días hábiles</strong> para completar tu pago.<br>
                            Después de este tiempo, tu reserva será cancelada automáticamente.
                        </div>
                    </div>
                    <div class="detail-card">
                        <div class="detail-icon">📞</div>
                        <div class="detail-title">Soporte</div>
                        <div class="detail-text">
                            ¿Dudas o problemas?<br>
                            <strong>Tel:</strong> (555) 123-4567<br>
                            <strong>Email:</strong> soporte@travelHub.com<br>
                            <strong>WhatsApp:</strong> +1 555-987-6543
                        </div>
                    </div>
                </div>
            </div>

            <!-- Formulario de Confirmación -->
            <div class="section" id="confirmation-section">
                <button type="button" class="confirm-button" id="confirm-order">
                    🎯 Confirmar Pedido
                </button>
            </div>

            <!-- MODAL de Confirmación -->
            <div id="success-modal" class="modal" style="display:none;">
              <div class="modal-content" id="success-message">
                  <span class="close-modal" onclick="closeSuccessModal()">&times;</span>
                  <div class="success-icon">🎉</div>
                  <h2 class="confirmation-title" id="success-title"></h2>
                  <p class="confirmation-text" id="success-text"></p>
                  <div class="email-highlight">
                      📧 Revisa tu correo electrónico<br>
                      Te enviamos un código de retiro a: <strong id="confirmation-email"></strong>
                  </div>
                  <p class="confirmation-text">
                      <strong>Código de Pedido:</strong> <span id="confirmation-order"></span><br>
                      <strong>Total a Pagar:</strong> $<span id="confirmation-total"></span><br>
                      <strong>Código de Verificación:</strong> <span id="confirmation-code" style="font-size:1.2em;color:#6366f1;"></span>
                  </p>
                  <p style="color: #666; font-size: 0.9rem; margin-top: 20px;">
                      Si no recibes el correo en los próximos minutos, revisa tu carpeta de spam o contáctanos.
                  </p>
              </div>
            </div>
        </div>
    </div>
    </main>
    <!--  FOOTER  -->
    <footer class="footer">
        <?php include 'footer.php'; ?>
    </footer>

    <!--  CARRITO -->
    <?php include 'carrito.php'; ?>
</body>
</html>