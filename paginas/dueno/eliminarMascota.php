<?php
require_once __DIR__ . '/../../php/config.php';
require_once __DIR__ . '/../../php/sesion.php';
require_once __DIR__ . '/../../php/mascotas.php';

// Proteger la página. Si el usuario no está logueado, lo redirige.
require_login();

$id_dueno = $_SESSION['user_id'];
$id_mascota = filter_input(INPUT_GET, 'id', FILTER_VALIDATE_INT);

if (!$id_mascota) {
    header('Location: perfilUsuarioMisMascotas.php?error=invalido');
    exit;
}

$mascota = obtenerMascotaPorId($id_mascota);

// Verificar que la mascota pertenece al dueño actual
if (!$mascota || $mascota['id_dueno'] != $id_dueno) {
    header('Location: perfilUsuarioMisMascotas.php?error=no_autorizado');
    exit;
}

if (eliminarMascota($id_mascota)) {
    header('Location: perfilUsuarioMisMascotas.php?exito=mascota_eliminada');
    exit;
} else {
    header('Location: perfilUsuarioMisMascotas.php?error=error_eliminar');
    exit;
}
?>