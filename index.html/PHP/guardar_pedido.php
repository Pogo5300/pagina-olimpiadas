<?php
session_start();
header('Content-Type: application/json');

// Requiere conexión a la base de datos
require_once 'Conexion.php'; // tu archivo de conexión
$conexion = Conexion();

$data = json_decode(file_get_contents('php://input'), true);

// Validaciones básicas
if (
    !isset($data['usuario_id'], $data['total'], $data['metodo_pago'], $data['codigo_verificacion'])
    || !$data['usuario_id']
) {
    echo json_encode(['success' => false, 'error' => 'Datos incompletos']);
    exit;
}

$usuario_id = intval($data['usuario_id']);
$total = floatval($data['total']);
$metodo_pago = $data['metodo_pago'];
$codigo_verificacion = $data['codigo_verificacion'];
$fecha = date('Y-m-d H:i:s');
$estado = 'pendiente';

// Guardar pedido
$stmt = $conn->prepare("INSERT INTO pedidos (usuario_id, fecha, estado, total, metodo_pago, codigo_verificacion) VALUES (?, ?, ?, ?, ?, ?)");
$stmt->bind_param("issdss", $usuario_id, $fecha, $estado, $total, $metodo_pago, $codigo_verificacion);

if ($stmt->execute()) {
    $pedido_id = $stmt->insert_id;
    // Opcional: guarda los productos del pedido en otra tabla
    // foreach ($data['carrito'] as $item) { ... }
    // Puedes generar el código de pedido aquí si necesitas formato especial
    $pedido_codigo = "TV-" . date('Y') . "-" . str_pad($pedido_id, 3, "0", STR_PAD_LEFT);
    echo json_encode(['success' => true, 'pedido_id' => $pedido_id, 'pedido_codigo' => $pedido_codigo]);
} else {
    echo json_encode(['success' => false, 'error' => $stmt->error]);
}
$stmt->close();
$conn->close();
?>