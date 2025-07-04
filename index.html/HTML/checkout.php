<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>TravelHub - Reserva</title>
    <link rel="stylesheet" href="../CSS/header.css">
    <link rel="stylesheet" href="../CSS/checkout.css">
    <link rel="stylesheet" href="../CSS/footer.css">
    <link rel="stylesheet" href="../CSS/carrito.css">
    <link rel="icon" href="../imagenes/icono.png">
    <script src="../Javascript/menuUsuario.js"></script>
    <script src="../Javascript/carrito.js"></script>
    <script src="../Javascript/checkout.js"></script>
</head>
<body>
    <!-- HEADER -->
    <header class="header">
        <?php include 'header.php'; ?>
    </header>

    <main class="checkout">
    <div class="container">
        <div class="container-header">
            <h1>Finalizar Compra</h1>
            <p>Revisa tu pedido y elige tu método de pago preferido</p>
        </div>

        <div class="content">
            <div class="section">
                <h2>Resumen de tu compra</h2>
                <div class="cart-summary" id="checkout-cart"></div>
            </div>

            <div class="section">
                <h2>Elige método de pago</h2>
                <form id="payment-method-form" class="payment-form">
                    <label class="payment-option selected">
                        <input type="radio" name="payment" value="cash" checked>
                        <div class="payment-info">
                            <div class="payment-title">Efectivo</div>
                            <div class="payment-description">Retiro por caja - Paga al recoger tu pedido</div>
                        </div>
                        <div class="payment-icon">💵</div>
                    </label>

                    <label class="payment-option">
                        <input type="radio" name="payment" value="card">
                        <div class="payment-info">
                            <div class="payment-title">Tarjeta de Crédito/Débito</div>
                            <div class="payment-description">Pago seguro con Visa, Mastercard, American Express</div>
                        </div>
                        <div class="payment-icon">💳</div>
                    </label>

                    <button type="submit" class="submit-btn" id="finish-order-btn">Finalizar Pedido</button>
                </form>

                <div id="payment-result" class="result"></div>
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