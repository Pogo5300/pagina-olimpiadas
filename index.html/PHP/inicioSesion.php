<?php
session_start();
require_once "Conexion.php";
$conexion = Conexion();

$email = $_POST['email'];
$inputPassword = $_POST['contrasena'];

// Verificar si es administrador
$sqlAdmin = "SELECT * FROM administradores WHERE email = '$email'";
$resultAdmin = $conexion->query($sqlAdmin);

if ($resultAdmin && $resultAdmin->num_rows > 0) {
    $admin = $resultAdmin->fetch_assoc();

    if (password_verify($inputPassword, $admin['contraseña'])) {
        $_SESSION['rol'] = 'admin';
        $_SESSION['email'] = $admin['email']; // Puedes guardar más datos si querés
        header("Location: ../HTML/admin.php");
        exit();
    } else {
        header("Location: ../HTML/inicioSesion-registro.php?error=Contraseña+de+administrador+incorrecta&tab=login");
        exit();
    }
}

// Si no es administrador, intentar como usuario
$sql = "CALL sp_login_usuario('$email')";
$resultado = $conexion->query($sql);

if ($resultado) {
    $datos = $resultado->fetch_assoc();

    if (isset($datos['Resultado']) && $datos['Resultado'] === 'CUENTA_NO_EXISTE') {
        header("Location: ../HTML/inicioSesion-registro.php?error=La+cuenta+no+existe.+Por+favor+registrate&tab=login");
        exit();
    } else {
        $hash = $datos['contraseña'];

        if (password_verify($inputPassword, $hash)) {
            $_SESSION['id_usuario'] = $datos['id_usuario'];
            $_SESSION['nombre'] = $datos['nombre'];
            $_SESSION['apellido'] = $datos['apellido'];
            $_SESSION['email'] = $datos['email'];
            header("Location: ../HTML/index.php");
            exit();
        } else {
            header("Location: ../HTML/inicioSesion-registro.php?error=Contraseña+incorrecta&tab=login");
            exit();
        }
    }
} else {
    header("Location: ../HTML/inicioSesion-registro.php?error=Error+al+consultar+la+base+de+datos&tab=login");
    exit();
}
?>
