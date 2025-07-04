// Variables para los filtros actuales
let searchTerm = "";
let category = "";
let sort = "name-asc";

// Listeners
document.getElementById("product-search").addEventListener("input", function(e) {
    searchTerm = e.target.value.trim();
    cargarProductos();
});
document.getElementById("category-filter").addEventListener("change", function(e) {
    category = e.target.value;
    cargarProductos();
});
document.getElementById("sort-products").addEventListener("change", function(e) {
    sort = e.target.value;
    cargarProductos();
});

// Función para cargar productos con filtros
function cargarProductos() {
    const params = new URLSearchParams({
        search: searchTerm,
        category: category,
        sort: sort
    });

    fetch("../PHP/listar_productos.php?" + params)
        .then(r => r.json())
        .then(productos => {
            let html = "";
            productos.forEach(p => {
                html += `
                <tr>
                    <td>${p.id}</td>
                    <td>${p.nombre}</td>
                    <td>${p.descripcion}</td>
                    <td>${p.precio}</td>
                    <td><img src="${p.imagen}" alt="${p.nombre}" width="60"></td>
                    <td>${p.categoria}</td>
                    <td>${p.features}</td>
                    <td>
                        <button class="btn-delete" onclick="borrarProducto(${p.id})">Borrar</button>
                    </td>
                    <td><!-- acciones --></td>
                </tr>`;
            });
            document.getElementById("products-table-body").innerHTML = html;
        });
}

// Inicial
document.addEventListener("DOMContentLoaded", cargarProductos);

function borrarProducto(id) {
    if (!confirm("¿Seguro que quieres borrar este producto?")) return;

    fetch('../PHP/borrar_producto.php', {
        method: 'POST',
        headers: { 'Content-Type': 'application/x-www-form-urlencoded' },
        body: 'id=' + encodeURIComponent(id)
    })
    .then(r => r.json())
    .then(resp => {
        if (resp.success) {
            cargarProductos();
        } else {
            alert('Error al borrar: ' + resp.error);
        }
    })
    .catch(e => alert('Error de conexión: ' + e));
}