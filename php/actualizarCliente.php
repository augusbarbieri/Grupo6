<?php
require_once __DIR__ . '/config.php';
require_once __DIR__ . '/conexion.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id_usuario = isset($_POST['id_usuario']) ? (int)$_POST['id_usuario'] : 0;
    $nombre = trim($_POST['nombre']);
    $apellido = trim($_POST['apellido']);
    $email = trim($_POST['email']);
    $telefono = trim($_POST['telefono']);
    $direccion = trim($_POST['direccion']);

    if ($id_usuario > 0 && !empty($nombre) && !empty($apellido) && !empty($email)) {
        $conn = conectarBDManadas();

        if ($conn) {
            $stmt = $conn->prepare("UPDATE usuarios SET nombre = ?, apellido = ?, email = ?, telefono = ?, direccion = ? WHERE id_usuario = ?");
            $stmt->bind_param("sssssi", $nombre, $apellido, $email, $telefono, $direccion, $id_usuario);

            if ($stmt->execute()) {
                // Redirigir a la lista de clientes con un mensaje de éxito
                header("Location: " . BASE_URL . "paginas/admin/adminClientes.php?status=success");
            } else {
                // Redirigir con un mensaje de error
                header("Location: " . BASE_URL . "paginas/admin/adminClientes.php?status=error");
            }

            $stmt->close();
            cerrarBDConexion($conn);
        } else {
            // Error de conexión
            header("Location: " . BASE_URL . "paginas/admin/adminClientes.php?status=db_error");
        }
    } else {
        // Datos inválidos
        header("Location: " . BASE_URL . "paginas/admin/adminClientes.php?status=invalid_data");
    }
    exit;
} else {
    // Redirigir si no es POST
    header("Location: " . BASE_URL . "paginas/admin/adminClientes.php");
    exit;
}
?>
