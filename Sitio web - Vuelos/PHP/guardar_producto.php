<?php
session_start();
if (!isset($_SESSION['rol']) || $_SESSION['rol'] !== 'admin') {
    echo json_encode(['success' => false, 'error' => 'No autorizado']);
    exit();
}
require_once "Conexion.php";
$conexion = Conexion();

$nombre = $_POST['nombre'];
$descripcion = $_POST['descripcion'];
$precio = $_POST['precio'];
$imagen = $_POST['imagen'];
$categoria = $_POST['categoria'];
$features = $_POST['features'];

$sql = "INSERT INTO productos (nombre, descripcion, precio, imagen, categoria, features) VALUES (?, ?, ?, ?, ?, ?)";
$stmt = $conexion->prepare($sql);
$stmt->bind_param("ssdsss", $nombre, $descripcion, $precio, $imagen, $categoria, $features);

if ($stmt->execute()) {
    echo json_encode(['success' => true]);
} else {
    echo json_encode(['success' => false, 'error' => $stmt->error]);
}
?>