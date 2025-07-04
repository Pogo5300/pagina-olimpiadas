<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>TravelHub - Autos</title>
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
                <span>Autos</span>
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
                                <input type="checkbox" value="económico" disabled> Económico
                            </label>
                            <label class="filter-option">
                                <input type="checkbox" value="mediano" disabled> Mediano
                            </label>
                            <label class="filter-option">
                                <input type="checkbox" value="suv" disabled> SUV
                            </label>
                            <label class="filter-option">
                                <input type="checkbox" value="aeromexico" disabled> Africa
                            </label>
                            <label class="filter-option">
                                <input type="checkbox" value="premium" disabled> Premium
                            </label>
                            <label class="filter-option">
                                <input type="checkbox" value="van" disabled> Van
                            </label>
                        </div>
                    </div>
    
                    <div class="filter-group">
                        <h3>Transmisión</h3>
                        <div class="filter-options">
                            <label class="filter-option">
                                <input type="checkbox" value="todas" checked disabled> Todas
                            </label>
                            <label class="filter-option">
                                <input type="checkbox" value="automática" disabled>Automática
                            </label>
                            <label class="filter-option">
                                <input type="checkbox" value="Manual" disabled>Manual
                            </label>
                            
                        </div>
                    </div>
    
                    <div class="filter-group">
                        <h3>Compañía</h3>
                        <div class="filter-options">
                            <label class="filter-option">
                                <input type="checkbox" value="cualquiera" checked disabled> Todas
                            </label>
                            <label class="filter-option">
                                <input type="checkbox" value="EmpresaA" disabled> Empresa A
                            </label>
                            <label class="filter-option">
                                <input type="checkbox" value="EmpresaB" disabled> Empresa B
                            </label>
                            <label class="filter-option">
                                <input type="checkbox" value="EmpresaC" disabled> Empresa C
                            </label>
                            
                        </div>
                    </div>

                    <div class="filter-group">
                        <h3>Características</h3>
                        <div class="filter-options">
                            <label class="filter-option">
                                <input type="checkbox" value="todas" checked disabled> Todas
                            </label>
                            <label class="filter-option">
                                <input type="checkbox" value="A/C" disabled> A/C
                            </label>
                            <label class="filter-option">
                                <input type="checkbox" value="GPS" disabled> GPS
                            </label>
                            <label class="filter-option">
                                <input type="checkbox" value="asientos-para-niños" disabled> Asientos para niños
                            </label>
                        </div>
                    </div>
                </aside>
    
                <!-- Productos -->
                <section class="products-section">
                    <h1>Autos disponibles</h1>
                    <div class="products-grid" id="productsGrid">
                        <?php include '../PHP/listar_autos.php'; ?>
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