<?php
require_once __DIR__ . '/config.php';
require_once __DIR__ . '/conexion.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id_paseador = isset($_POST['id_paseador']) ? (int)$_POST['id_paseador'] : 0;
    $nombre = trim($_POST['nombre']);
    $apellido = trim($_POST['apellido']);
    $email = trim($_POST['email']);
    $telefono = trim($_POST['telefono']);
    $zona = trim($_POST['zona']);
    $disponibilidad = trim($_POST['disponibilidad']);
    $estado = trim($_POST['estado']);
    $bio = trim($_POST['bio']);

    if ($id_paseador > 0 && !empty($nombre) && !empty($apellido) && !empty($email)) {
        $conn = conectarBDManadas();

        if ($conn) {
            $stmt = $conn->prepare("UPDATE paseador SET nombre = ?, apellido = ?, email = ?, telefono = ?, zona = ?, disponibilidad = ?, estado = ?, bio = ? WHERE id_paseador = ?");
            $stmt->bind_param("ssssssssi", $nombre, $apellido, $email, $telefono, $zona, $disponibilidad, $estado, $bio, $id_paseador);

            if ($stmt->execute()) {
                // Redirigir a la lista de paseadores con un mensaje de éxito
                header("Location: " . BASE_URL . "paginas/admin/adminPaseadores.php?status=success");
            } else {
                // Redirigir con un mensaje de error
                header("Location: " . BASE_URL . "paginas/admin/adminPaseadores.php?status=error");
            }

            $stmt->close();
            cerrarBDConexion($conn);
        } else {
            // Error de conexión
            header("Location: " . BASE_URL . "paginas/admin/adminPaseadores.php?status=db_error");
        }
    } else {
        // Datos inválidos
        header("Location: " . BASE_URL . "paginas/admin/adminPaseadores.php?status=invalid_data");
    }
    exit;
} else {
    // Redirigir si no es POST
    header("Location: " . BASE_URL . "paginas/admin/adminPaseadores.php");
    exit;
}
?>
