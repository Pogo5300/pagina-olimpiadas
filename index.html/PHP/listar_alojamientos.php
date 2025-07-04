<?php
require_once "Conexion.php";
$conexion=Conexion();

$sql = "SELECT * FROM productos WHERE categoria = 'alojamiento'";
$result = $conexion->query($sql);

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        ?>
        <div class="product-card" data-id="product-<?php echo $row['id']; ?>">
            <img src="<?php echo htmlspecialchars($row['imagen']); ?>" alt="<?php echo htmlspecialchars($row['nombre']); ?>" class="product-image" loading="lazy">
            <div class="product-content">
                <div class="product-header">
                    <h3 class="product-title"><?php echo htmlspecialchars($row['nombre']); ?></h3>
                </div>
                <p class="product-description"><?php echo htmlspecialchars($row['descripcion']); ?></p>
                <div class="product-features">
                    <?php
                    $features = explode(',', $row['features']);
                    foreach($features as $feature) {
                        echo '<span class="feature-tag">' . htmlspecialchars(trim($feature)) . '</span>';
                    }
                    ?>
                </div>
                <div class="product-pricing">
                    <!-- Si tienes precio original y precio actual, cámbialo aquí -->
                    <span class="current-price"><?php echo $row['precio']; ?> €</span>
                    <!--<span class="discount-badge">-25%</span>-->
                </div>
                <button 
                    class="add-to-cart-btn"
                    data-id="<?php echo $row['id']; ?>"
                    data-nombre="<?php echo htmlspecialchars($row['nombre'], ENT_QUOTES); ?>"
                    data-precio="<?php echo $row['precio']; ?>"
                    data-imagen="<?php echo htmlspecialchars($row['imagen'], ENT_QUOTES); ?>">
                    Añadir al carrito
                </button>
            </div>
        </div>
        <?php
    }
} else {
    echo '<p>No hay alojamientos disponibles.</p>';
}
?>
