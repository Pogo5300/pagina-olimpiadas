<?php
    session_start();
    
    if (isset($_SESSION['nombre']) && isset($_SESSION['apellido'])) {
        $iniciales = strtoupper(substr($_SESSION['nombre'], 0, 1) . substr($_SESSION['apellido'], 0, 1));
        echo json_encode([
            'logueado' => true,
            'iniciales' => $iniciales
        ]);
    } else {
        echo json_encode([
            'logueado' => false
        ]);
    }
?>
