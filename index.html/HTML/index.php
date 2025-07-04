<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>TravelHub - Inicio</title>
    <link rel="stylesheet" href="../CSS/header.css">
    <link rel="stylesheet" href="../CSS/style.css">
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

    <!-- Hero Section (seccion encabezado) -->
    <section class="hero">
        <div class="hero-image">
            <img src="../imagenes/Fondo-header.jpg" alt="Destino paradisíaco">
        </div>
        <div class="hero-overlay">
            <div class="container">
                <div class="hero-content">
                    <h1>Descubre el mundo a tu manera</h1>
                    <p>Encuentra los mejores destinos, alojamientos y experiencias para tu próxima aventura</p>
                    <a href="#vista" class="btn btn-primary" id="explorar-btn">Explorar ahora</a>
                </div>
            </div>
        </div>
    </section>

    <!-- Vuelos que ofrecemos -->
    <section class="featured-destinations" id="vista">
        <div class="container">
            <div class="section-header">
                <h2>Vuelos que ofrecemos</h2>
                <a href="vuelos.php" class="view-all">Ver todos</a>
            </div>
            <div class="destinations-grid">
                <div class="card">
                    <div class="card-image">
                        <img src="../imagenes/paris.jpg" alt="París, Francia">
                        <div class="card-badge">Popular</div>
                    </div>
                    <div class="card-content">
                        <h3 class="card-title">París, Francia</h3>
                        <p class="card-description">La ciudad del amor y la luz</p>
                    </div>
                </div>
                
                <div class="card">
                    <div class="card-image">
                        <img src="https://images.unsplash.com/photo-1540959733332-eab4deabeeaf?w=400&h=300&fit=crop" alt="Tokio, Japón">
                        <div class="card-badge">Tendencia</div>
                    </div>
                    <div class="card-content">
                        <h3 class="card-title">Tokio, Japón</h3>
                        <p class="card-description">Tradición y modernidad en armonía</p>
                    </div>
                </div>
                
                <div class="card">
                    <div class="card-image">
                        <img src="https://images.unsplash.com/photo-1496442226666-8d4d0e62e6e9?w=400&h=300&fit=crop" alt="Nueva York, EE.UU.">
                        <div class="card-badge">Destacado</div>
                    </div>
                    <div class="card-content">
                        <h3 class="card-title">Nueva York, EE.UU.</h3>
                        <p class="card-description">La ciudad que nunca duerme</p>
                    </div>
                </div>
                
                <div class="card">
                    <div class="card-image">
                        <img src="https://images.unsplash.com/photo-1507525428034-b723cf961d3e?w=400&h=300&fit=crop" alt="Cancún, México">
                        <div class="card-badge">Oferta</div>
                    </div>
                    <div class="card-content">
                        <h3 class="card-title">Cancún, México</h3>
                        <p class="card-description">Playas paradisíacas y cultura maya</p>
                    </div>
                </div>
                
                <div class="card">
                    <div class="card-image">
                        <img src="https://images.unsplash.com/photo-1552832230-c0197dd311b5?w=400&h=300&fit=crop" alt="Roma, Italia">
                        <div class="card-badge">Cultural</div>
                    </div>
                    <div class="card-content">
                        <h3 class="card-title">Roma, Italia</h3>
                        <p class="card-description">Historia milenaria y gastronomía</p>
                    </div>
                </div>
                
                <div class="card">
                    <div class="card-image">
                        <img src="https://images.unsplash.com/photo-1537953773345-d172ccf13cf1?w=400&h=300&fit=crop" alt="Bali, Indonesia">
                        <div class="card-badge">Exótico</div>
                    </div>
                    <div class="card-content">
                        <h3 class="card-title">Bali, Indonesia</h3>
                        <p class="card-description">Templos, playas y naturaleza exótica</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Ofertas especiales -->
    <section class="special-offers">
        <div class="container">
            <div class="section-header">
                <h2>Ofertas especiales</h2>
                <a href="ofertas.php" class="view-all">Ver todas</a>
            </div>
            <div class="offers-grid">
                <div class="card">
                    <div class="card-image">
                        <img src="https://images.unsplash.com/photo-1590523741831-ab7e8b8f9c7f?w=400&h=300&fit=crop" alt="Escapada a Cancún">
                        <div class="discount-badge">-28%</div>
                    </div>
                    <div class="card-content">
                        <h3 class="card-title">Escapada a Cancún</h3>
                        <p class="card-description">7 noches en resort todo incluido con vuelos</p>
                        <div class="card-price">
                            <span class="original-price">€1,800</span>
                            <span class="current-price">€1,299</span>
                        </div>
                    </div>
                </div>
                
                <div class="card">
                    <div class="card-image">
                        <img src="../imagenes/madrid.jpg" alt="Vuelo directo a Madrid">
                        <div class="discount-badge">-26%</div>
                    </div>
                    <div class="card-content">
                        <h3 class="card-title">Vuelo directo a Madrid</h3>
                        <p class="card-description">Vuelo redondo con equipaje incluido</p>
                        <div class="card-price">
                            <span class="original-price">€950</span>
                            <span class="current-price">€699</span>
                        </div>
                    </div>
                </div>
                
                <div class="card">
                    <div class="card-image">
                        <img src="https://images.unsplash.com/photo-1467269204594-9661b134dd2b?w=400&h=300&fit=crop" alt="Tour por Europa">
                        <div class="discount-badge">-24%</div>
                    </div>
                    <div class="card-content">
                        <h3 class="card-title">Tour por Europa</h3>
                        <p class="card-description">10 días visitando 5 países con guía</p>
                        <div class="card-price">
                            <span class="original-price">€2,500</span>
                            <span class="current-price">€1,899</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!--  FOOTER  -->
    <footer class="footer">
        <?php include 'footer.php'; ?>
    </footer>

    <!--  CARRITO -->
    <?php include 'carrito.php'; ?>
</body>
</html>