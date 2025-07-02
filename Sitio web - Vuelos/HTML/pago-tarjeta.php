<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>TravelHub - Reserva</title>
    <link rel="stylesheet" href="../CSS/header.css">
    <link rel="stylesheet" href="../CSS/pago-tarjeta.css">
    <link rel="stylesheet" href="../CSS/footer.css">
    <link rel="stylesheet" href="../CSS/carrito.css">
    <link rel="icon" href="../imagenes/icono.png">
    <script src="../Javascript/menuUsuario.js"></script>
    <script src="../Javascript/carrito.js"></script>
</head>
<body>
    <!-- HEADER -->
    <header class="header">
        <?php include 'header.php'; ?>
    </header>

    <main class="checkout">
    <div class="checkout__content">
        <!-- Payment Card -->
        <section class="payment-card">
            <header class="payment-card__header">
                <div class="payment-card__title">
                    <svg class="payment-card__icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                        <rect x="1" y="4" width="22" height="16" rx="2" ry="2"/>
                        <line x1="1" y1="10" x2="23" y2="10"/>
                    </svg>
                    Información de Pago Seguro
                </div>
                <p class="payment-card__description">Completa los datos de tu tarjeta para finalizar la reserva</p>
            </header>
            
            <div class="payment-card__content">
                <form class="payment-form" id="paymentForm">
                    <div class="form-field">
                        <label class="form-field__label" for="cardNumber">Número de Tarjeta</label>
                        <input class="form-field__input" type="text" id="cardNumber" placeholder="1234 5678 9012 3456" maxlength="19">
                    </div>
                    
                    <div class="form-field">
                        <label class="form-field__label" for="cardName">Nombre en la Tarjeta</label>
                        <input class="form-field__input" type="text" id="cardName" placeholder="Como aparece en tu tarjeta">
                    </div>
                    
                    <div class="form-row">
                        <div class="form-field">
                            <label class="form-field__label" for="expiry">Fecha de Vencimiento</label>
                            <input class="form-field__input" type="text" id="expiry" placeholder="MM/AA" maxlength="5">
                        </div>
                        <div class="form-field">
                            <label class="form-field__label" for="cvv">CVV</label>
                            <input class="form-field__input" type="text" id="cvv" placeholder="123" maxlength="4">
                        </div>
                    </div>
                </form>
            </div>
        </section>

        <!-- Summary Card -->
        <section class="summary-card">
            <header class="summary-card__header">
                <h2 class="summary-card__title">Resumen de Reserva</h2>
            </header>
            
            <div class="summary-card__content">
                <div class="summary-list">
                    <div class="summary-item">
                        <span class="summary-item__label">Subtotal</span>
                        <span class="summary-item__amount">$1,004.00</span>
                    </div>
                    <div class="summary-item">
                        <span class="summary-item__label">Impuestos y tasas</span>
                        <span class="summary-item__amount">$120.48</span>
                    </div>
                    <div class="summary-separator"></div>
                    <div class="summary-item summary-item--total">
                        <span class="summary-item__label">Total</span>
                        <span class="summary-item__amount">$1,124.48</span>
                    </div>
                </div>

                <div class="security-badge">
                    <div class="security-badge__header">
                        <svg class="security-badge__icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                            <rect x="3" y="11" width="18" height="11" rx="2" ry="2"/>
                            <circle cx="12" cy="16" r="1"/>
                            <path d="m7 11V7a5 5 0 0 1 10 0v4"/>
                        </svg>
                        <span class="security-badge__text">Pago 100% Seguro</span>
                    </div>
                    <p class="security-badge__description">Tu información está protegida con encriptación SSL de 256 bits</p>
                </div>

                <ul class="benefits-list">
                    <li class="benefits-list__item">Confirmación inmediata por email</li>
                    <li class="benefits-list__item">Cancelación gratuita hasta 24h antes</li>
                    <li class="benefits-list__item">Soporte 24/7 durante tu viaje</li>
                </ul>
            </div>
            
            <footer class="summary-card__footer">
                <button class="btn btn--primary btn--full-width" onclick="processPayment()">
                    Confirmar Reserva - $1,124.48
                </button>
            </footer>
        </section>
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