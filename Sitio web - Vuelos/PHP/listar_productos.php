<?php
session_start();
if (!isset($_SESSION['rol']) || $_SESSION['rol'] !== 'admin') {
    echo json_encode([]);
    exit();
}
require_once "Conexion.php";
$conexion = Conexion();

$search = isset($_GET['search']) ? $conexion->real_escape_string($_GET['search']) : '';
$category = isset($_GET['category']) ? $conexion->real_escape_string($_GET['category']) : '';
$sort = isset($_GET['sort']) ? $_GET['sort'] : 'name-asc';

// Build SQL
$sql = "SELECT id, nombre, descripcion, precio, imagen, categoria, features FROM productos WHERE 1";

if ($search !== '') {
    $sql .= " AND (nombre LIKE '%$search%' OR descripcion LIKE '%$search%' OR features LIKE '%$search%')";
}
if ($category !== '') {
    $sql .= " AND categoria = '$category'";
}

// Ordenamiento
switch ($sort) {
    case 'name-asc':
        $sql .= " ORDER BY nombre ASC";
        break;
    case 'name-desc':
        $sql .= " ORDER BY nombre DESC";
        break;
    case 'price-asc':
        $sql .= " ORDER BY precio ASC";
        break;
    case 'price-desc':
        $sql .= " ORDER BY precio DESC";
        break;
    default:
        $sql .= " ORDER BY id DESC";
}

$res = $conexion->query($sql);
$datos = [];
while($row = $res->fetch_assoc()) {
    $datos[] = $row;
}
echo json_encode($datos);
?>