<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>TravelHub - Vuelos</title>
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
                <span>Vuelos</span>
            </nav>
    
            <div class="main-content">
                <!-- Filtros -->
                <aside class="filters">
                    <h2>Filtros</h2>
                    <div class="filter-group">
                        <h3>Aerolíneas</h3>
                        <div class="filter-options">
                            <label class="filter-option">
                                <input type="checkbox" class="airline-filter" value="todas" checked> Todas
                            </label>
                            <label class="filter-option">
                                <input type="checkbox" class="airline-filter" value="iberia"> Iberia
                            </label>
                            <label class="filter-option">
                                <input type="checkbox" class="airline-filter" value="vueling"> Vueling
                            </label>
                            <label class="filter-option">
                                <input type="checkbox" class="airline-filter" value="aeromexico"> Aeroméxico
                            </label>
                        </div>
                    </div>
    
                    <div class="filter-group">
                        <h3>Escalas</h3>
                        <div class="filter-options">
                            <label class="filter-option">
                                <input type="checkbox" class="escalas-filter" value="todas" checked> Todas
                            </label>
                            <label class="filter-option">
                                <input type="checkbox" class="escalas-filter" value="directo"> Directo
                            </label>
                            <label class="filter-option">
                                <input type="checkbox" class="escalas-filter" value="1escala"> 1 escala
                            </label>
                            <label class="filter-option">
                                <input type="checkbox" class="escalas-filter" value="2escalas"> 2+ escalas
                            </label>
                        </div>
                    </div>
    
                    <div class="filter-group">
                        <h3>Duración</h3>
                        <div class="filter-options">
                            <label class="filter-option">
                                <input type="checkbox" value="cualquiera" checked disabled> Cualquiera
                            </label>
                            <label class="filter-option">
                                <input type="checkbox" value="menos2h" disabled> Menos de 2h
                            </label>
                            <label class="filter-option">
                                <input type="checkbox" value="2-5h" disabled> 2-5h
                            </label>
                            <label class="filter-option">
                                <input type="checkbox" value="5-8h" disabled> 5-8h
                            </label>
                            <label class="filter-option">
                                <input type="checkbox" value="8h+" disabled> 8h+
                            </label>
                        </div>
                    </div>

                    <div class="filter-group">
                        <h3>Horario salida</h3>
                        <div class="filter-options">
                            <label class="filter-option">
                                <input type="checkbox" value="cualquiera" checked disabled> Cualquiera
                            </label>
                            <label class="filter-option">
                                <input type="checkbox" value="menos2h" disabled> Mañana
                            </label>
                            <label class="filter-option">
                                <input type="checkbox" value="2-5h" disabled> Tarde
                            </label>
                            <label class="filter-option">
                                <input type="checkbox" value="5-8h" disabled> Noche
                            </label>
                        </div>
                    </div>
                </aside>
    
                <!-- Productos -->
                <section class="products-section">
                    <h1>Vuelos disponibles</h1>
                    <div class="products-grid" id="productsGrid">
                        <?php include '../PHP/listar_vuelos.php'; ?>
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
