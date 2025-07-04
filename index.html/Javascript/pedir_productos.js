async function loadProductsTable() {
    const res = await fetch('../PHP/obtener_productos.php');
    const productos = await res.json();
    // renderiza productos en la tabla...
}