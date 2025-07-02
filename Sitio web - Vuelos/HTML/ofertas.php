<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>TravelHub - Ofertas</title>
    <link rel="stylesheet" href="../CSS/header.css">
    <link rel="stylesheet" href="../CSS/main.css">
    <link rel="stylesheet" href="../CSS/footer.css">
    <link rel="stylesheet" href="../CSS/carrito.css">
    <link rel="stylesheet" href="../CSS/modal.css">
    <link rel="icon" href="../imagenes/icono.png">
    <script src="../Javascript/menuUsuario.js"></script>
    <script src="../Javascript/session-data.js"></script>
    <script src="../Javascript/carrito.js"></script>
</head>
<body>
    <!-- HEADER -->
    <header class="header">
        <?php include 'header.php'; ?>
    </header>

    <!-- MAIN -->
    <main>
        <div class="container page-container">
            <!-- Breadcrumb -->
            <nav class="breadcrumb">
                <a href="index.php">Inicio</a>
                <span>></span>
                <span>Ofertas</span>
            </nav>
    
            <div class="main-content">
                <!-- Filtros -->
                <aside class="filters">
                    <h2>Filtros</h2>
                    <div class="filter-group">
                        <h3>Tipo</h3>
                        <div class="filter-options">
                            <label class="filter-option">
                                <input type="checkbox" value="todas" checked disabled> Todos
                            </label>
                            <label class="filter-option">
                                <input type="checkbox" value="vuelos" disabled> Vuelos
                            </label>
                            <label class="filter-option">
                                <input type="checkbox" value="alojamiento" disabled> Alojamientos
                            </label>
                            <label class="filter-option">
                                <input type="checkbox" value="auto" disabled> autos
                            </label>
               
                        </div>
                    </div>
    
                    <div class="filter-group">
                        <h3>Descuentos</h3>
                        <div class="filter-options">
                            <label class="filter-option">
                                <input type="checkbox" value="todas" checked disabled> Cualquiera
                            </label>
                            <label class="filter-option">
                                <input type="checkbox" value="10-30%" disabled> 10-30%
                            </label>
                            <label class="filter-option">
                                <input type="checkbox" value="30-50%" disabled> 30-50%
                            </label>
                           
                        </div>
                    </div>
    
                    <div class="filter-group">
                        <h3>Clima</h3>
                        <div class="filter-options">
                            <label class="filter-option">
                                <input type="checkbox" value="cualquiera" checked disabled> Todos
                            </label>
                            <label class="filter-option">
                                <input type="checkbox" value="lluvioso" disabled> Lluvioso
                            </label>
                            <label class="filter-option">
                                <input type="checkbox" value="arido" disabled> Arido
                            </label>
                            <label class="filter-option">
                                <input type="checkbox" value="mediterraneo" disabled> Mediterraneo
                            </label>
                
                        </div>
                    </div>
                </aside>
    
                <!-- Productos -->
                <section class="products-section">
                    <h1>Ofertas disponibles</h1>
                    <div class="products-grid" id="productsGrid">
                        <?php include '../PHP/listar_ofertas.php'; ?>
                    </div>
                </section>
            </div>
        </div>
    </main>

    <!--  FOOTER  -->
    <footer class="footer">
        <?php include 'footer.php'; ?>
    </footer>
    <!--  CARRITO -->
    <?php include 'carrito.php'; ?>
    <!--  MODAL  -->
    <?php include 'modal.php'; ?>
    <script>
        window.isLoggedIn = <?php echo isset($_SESSION['id_usuario']) ? 'true' : 'false'; ?>;
    </script>
</body>
</html>