<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>TravelHub - Alojamientos</title>
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
    <!--  HEADER  -->
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
                <span>Alojamientos</span>
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
                                <input type="checkbox" value="iberia" disabled> Hotel
                            </label>
                            <label class="filter-option">
                                <input type="checkbox" value="vueling" disabled> Apartamento
                            </label>
                            <label class="filter-option">
                                <input type="checkbox" value="aeromexico" disabled> Resort
                            </label>
                            <label class="filter-option">
                                <input type="checkbox" value="aeromexico" disabled> Hostal
                            </label>
                        </div>
                    </div>
    
                    <div class="filter-group">
                        <h3>Estrellas</h3>
                        <div class="filter-options">
                            <label class="filter-option">
                                <input type="checkbox" value="todas" checked disabled> Todas
                            </label>
                            <label class="filter-option">
                                <input type="checkbox" value="directo" disabled> 5 estrellas
                            </label>
                            <label class="filter-option">
                                <input type="checkbox" value="1escala" disabled> 4 estrellas
                            </label>
                            <label class="filter-option">
                                <input type="checkbox" value="2escalas" disabled> 3 estrellas
                            </label>
                            <label class="filter-option">
                                <input type="checkbox" value="2escalas" disabled> 2 estrellas
                            </label>
                        </div>
                    </div>
    
                    <div class="filter-group">
                        <h3>Servicios</h3>
                        <div class="filter-options">
                            <label class="filter-option">
                                <input type="checkbox" value="cualquiera" checked disabled> Todos
                            </label>
                            <label class="filter-option">
                                <input type="checkbox" value="menos2h" disabled> Piscina
                            </label>
                            <label class="filter-option">
                                <input type="checkbox" value="2-5h" disabled> Wifi gratis
                            </label>
                            <label class="filter-option">
                                <input type="checkbox" value="5-8h" disabled> Desayuno incluido
                            </label>
                            <label class="filter-option">
                                <input type="checkbox" value="8h+" disabled> Estacionamiento gratis
                            </label>
                        </div>
                    </div>

                    <div class="filter-group">
                        <h3>Precio</h3>
                        <div class="filter-options">
                            <label class="filter-option">
                                <input type="checkbox" value="cualquiera" checked disabled> Cualquiera
                            </label>
                            <label class="filter-option">
                                <input type="checkbox" value="menos2h" disabled> Economico
                            </label>
                            <label class="filter-option">
                                <input type="checkbox" value="2-5h" disabled> Moderado
                            </label>
                            <label class="filter-option">
                                <input type="checkbox" value="5-8h" disabled> Lujo
                            </label>
                        </div>
                    </div>
                </aside>
    
                <!-- Productos -->
                <section class="products-section">
                    <h1>Alojamientos disponibles</h1>
                    <div class="products-grid" id="productsGrid">
                        <?php include '../PHP/listar_alojamientos.php'; ?>
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