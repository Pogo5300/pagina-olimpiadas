// Enviar nuevo producto
document.getElementById('product-form').addEventListener('submit', function(e) {
    e.preventDefault();
    const formData = new FormData();
    formData.append('nombre', document.getElementById('product-name-input').value);
    formData.append('descripcion', document.getElementById('product-description-input').value);
    formData.append('precio', document.getElementById('product-price-input').value);
    formData.append('imagen', document.getElementById('product-image-input').value);
    formData.append('categoria', document.getElementById('product-category-input').value);
    formData.append('features', document.getElementById('product-features-input').value);

    fetch('../PHP/guardar_producto.php', {
        method: 'POST',
        body: formData
    })
    .then(r => r.json())
    .then(response => {
        if(response.success) {
            cargarProductos();
            // Cierra el modal, muestra notificación, etc.
        } else {
            alert('Error: ' + response.error);
        }
    });
});

// Cargar productos en la tabla
function cargarProductos() {
    fetch('../PHP/listar_productos.php')
        .then(r => r.json())
        .then(productos => {
            let html = '';
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
                    <td><!-- botones editar/borrar --></td>
                </tr>`;
            });
            document.getElementById('products-table-body').innerHTML = html;
        });
}
document.addEventListener('DOMContentLoaded', cargarProductos);