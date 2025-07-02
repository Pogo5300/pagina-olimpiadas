<?php
session_start();
if (!isset($_SESSION['rol']) || $_SESSION['rol'] !== 'admin') {
    echo json_encode(['success' => false, 'error' => 'No autorizado']);
    exit();
}
require_once "Conexion.php";
$conexion = Conexion();

$id = intval($_POST['id']);
if ($id <= 0) {
    echo json_encode(['success' => false, 'error' => 'ID inválido']);
    exit();
}

$sql = "DELETE FROM productos WHERE id = ?";
$stmt = $conexion->prepare($sql);
$stmt->bind_param("i", $id);

if ($stmt->execute()) {
    echo json_encode(['success' => true]);
} else {
    echo json_encode(['success' => false, 'error' => $stmt->error]);
}
?>