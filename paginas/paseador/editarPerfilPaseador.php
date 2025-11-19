<?php
require_once __DIR__ . '/../../php/config.php';
require_once __DIR__ . '/../../php/sesion.php';
require_once __DIR__ . '/../../php/conexion.php';
require_once __DIR__ . '/../../php/paseadores.php';

require_login();

// Asegurarse de que el usuario sea un paseador.
if ($_SESSION['role'] !== 'paseador') {
    header("Location: " . BASE_URL . "paginas/inicio-sesion.php");
    exit;
}

$conn = conectarBDManadas();
$id_paseador = $_SESSION['user_id'];
$paseador = obtenerPaseadorPorId($conn, $id_paseador);
$mensaje = ''; // Para futuros mensajes de error o éxito.

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nombre = $_POST['nombre'] ?? $paseador['nombre'];
    $apellido = $_POST['apellido'] ?? $paseador['apellido'];
    $email = $_POST['email'] ?? $paseador['email'];
    $telefono = $_POST['telefono'] ?? $paseador['telefono'];

    if (actualizarPaseador($conn, $id_paseador, $nombre, $apellido, $email, $telefono)) {
        header("Location: " . BASE_URL . "paginas/paseador/perfilPaseador.php?exito=1");
        exit;
    } else {
        $mensaje = '<div class="alert alert-danger" role="alert">Error al actualizar los datos.</div>';
    }
}

include_once __DIR__ . '/../../componentes/header.php';
?>

<!-- Hero Section -->
<div class="hero-profile">
    <div class="container">
        <h1>Editar Perfil</h1>
        <p>Actualiza tu información personal aquí 🐾</p>
    </div>
</div>

<!-- Profile Edit Content -->
<div class="container profile-container">
    <div class="profile-card">
        <?php echo $mensaje; ?>
        <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="POST" enctype="multipart/form-data">
            <div class="profile-header">
                <img src="<?php echo BASE_URL . 'Assets/img/Usuario.jpg'; ?>" alt="Foto de perfil" class="profile-img">
                <div class="mt-3">
                    <label for="img" class="btn btn-secondary">Cambiar Foto (Próximamente)</label>
                    <input type="file" name="img" id="img" class="d-none" disabled>
                </div>
            </div>
            <div class="profile-body">
                <div class="profile-info-item">
                    <span>Nombre</span>
                    <input type="text" class="form-control" name="nombre" value="<?php echo htmlspecialchars($paseador['nombre']); ?>">
                </div>
                <div class="profile-info-item">
                    <span>Apellido</span>
                    <input type="text" class="form-control" name="apellido" value="<?php echo htmlspecialchars($paseador['apellido']); ?>">
                </div>
                <div class="profile-info-item">
                    <span>Email</span>
                    <input type="email" class="form-control" name="email" value="<?php echo htmlspecialchars($paseador['email']); ?>">
                </div>
                <div class="profile-info-item">
                    <span>Teléfono</span>
                    <input type="text" class="form-control" name="telefono" value="<?php echo htmlspecialchars($paseador['telefono']); ?>">
                </div>
            </div>
            <div class="profile-actions">
                <button type="submit" class="btn btn-primary">Guardar Cambios</button>
                <a href="<?php echo BASE_URL; ?>paginas/paseador/perfilPaseador.php" class="btn btn-secondary">Cancelar</a>
            </div>
        </form>
    </div>
</div>

<style>
    .profile-info-item input.form-control {
        margin: 0;
        border: none;
        background: transparent;
        padding-left: 0;
    }
    .profile-info-item.full-width {
        grid-column: 1 / -1;
    }
    .d-none {
        display: none;
    }
</style>

<?php include_once __DIR__ . '/../../componentes/footer.php'; ?>
