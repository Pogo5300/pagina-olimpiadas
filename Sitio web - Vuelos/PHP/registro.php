<?php
session_start();
require_once "Conexion.php";
$Conexion = Conexion();

$nombre = $_POST['nombre'];
$apellido = $_POST['apellido'];
$email = $_POST['email'];
$contrasena = $_POST['contrasena'];
$confirmarContraseña = $_POST['confirmarContraseña'];

// Validar que las contraseñas coincidan
if ($contrasena !== $confirmarContraseña) {
    header("Location: ../HTML/inicioSesion-registro.php?error=Las+contraseñas+no+coinciden&tab=register");
    exit();
}

// Validar que tenga al menos 6 caracteres
if (strlen($contrasena) < 6) {
    header("Location: ../HTML/inicioSesion-registro.php?error=La+contraseña+debe+tener+al+menos+6+caracteres&tab=register");
    exit();
}

// Validar que no sean todos los caracteres iguales (ej: "aaaaaa" o "111111")
if (preg_match('/^(.)\\1*$/', $contrasena)) {
    header("Location: ../HTML/inicioSesion-registro.php?error=La+contraseña+no+puede+tener+todos+los+caracteres+iguales&tab=register");
    exit();
}


// Hashear la contraseña
$contrasenaHash = password_hash($contrasena, PASSWORD_DEFAULT);

$sql = "CALL sp_insertar_usuario('$nombre','$apellido','$email','$contrasenaHash')";

if (mysqli_query($Conexion, $sql)) {
    // Limpiar resultados previos del CALL
    while (mysqli_more_results($Conexion)) {
        mysqli_next_result($Conexion);
    }

    $consulta = "SELECT id_usuario, nombre, apellido FROM Usuarios WHERE email = '$email'";
    $resultado = mysqli_query($Conexion, $consulta);

    if ($fila = mysqli_fetch_assoc($resultado)) {
        $_SESSION['id_usuario'] = $fila['id_usuario'];
        $_SESSION['nombre'] = $fila['nombre'];
        $_SESSION['apellido'] = $fila['apellido'];
        $_SESSION['email'] = $email;

        // Registro exitoso
        header("Location: ../HTML/index.php");
    	exit();
    }

} else {
    echo "<script>
        alert('Error en el registro: " . mysqli_error($Conexion) . "');
        window.location.href = '../HTML/index.php';
    </script>";
    exit();
}
?>
