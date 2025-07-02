<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>TravelHub - Paquetes</title>
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
                <span>Paquetes</span>
            </nav>
    
            <div class="main-content">
                <!-- Filtros -->
                <aside class="filters">
                    <h2>Filtros</h2>
                    <div class="filter-group">
                        <h3>Destino</h3>
                        <div class="filter-options">
                            <label class="filter-option">
                                <input type="checkbox" value="todas" checked disabled> Todos
                            </label>
                            <label class="filter-option">
                                <input type="checkbox" value="europa" disabled> Europa
                            </label>
                            <label class="filter-option">
                                <input type="checkbox" value="asia" disabled> Asia
                            </label>
                            <label class="filter-option">
                                <input type="checkbox" value="america" disabled> America
                            </label>
                            <label class="filter-option">
                                <input type="checkbox" value="africa" disabled> Africa
                            </label>
                            <label class="filter-option">
                                <input type="checkbox" value="oceania" disabled> Oceania
                            </label>
                        </div>
                    </div>
    
                    <div class="filter-group">
                        <h3>Duracion</h3>
                        <div class="filter-options">
                            <label class="filter-option">
                                <input type="checkbox" value="cualquiera" checked disabled> Cualquiera
                            </label>
                            <label class="filter-option">
                                <input type="checkbox" value=" 3-5dias" disabled> 3 - 5 dias
                            </label>
                            <label class="filter-option">
                                <input type="checkbox" value="6-9dias" disabled> 6 - 9 dias
                            </label>
                            <label class="filter-option">
                                <input type="checkbox" value="10-15dias" disabled> 10 - 15 dias
                            </label>
                            <label class="filter-option">
                                <input type="checkbox" value=" 15+dias" disabled> 15+ dias
                            </label>
                        </div>
                    </div>
    
                    <div class="filter-group">
                        <h3>Tipo</h3>
                        <div class="filter-options">
                            <label class="filter-option">
                                <input type="checkbox" value="todos" checked disabled> Todos
                            </label>
                            <label class="filter-option">
                                <input type="checkbox" value="familiar" disabled> Familiar
                            </label>
                            <label class="filter-option">
                                <input type="checkbox" value="aventura" disabled> Aventura
                            </label>
                            <label class="filter-option">
                                <input type="checkbox" value="romantico" disabled> Romantico
                            </label>
                            <label class="filter-option">
                                <input type="checkbox" value="cultura" disabled> Cultural
                            </label>
                        </div>
                    </div>
                </aside>
    
                <!-- Productos -->
                <section class="products-section">
                    <h1>Paquetes disponibles</h1>
                    <div class="products-grid" id="productsGrid">
                        <?php include '../PHP/listar_paquetes.php'; ?>
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