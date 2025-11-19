<?php
require_once __DIR__ . '/../../php/config.php';
require_once __DIR__ . '/../../php/sesion.php';
require_once __DIR__ . '/../../php/conexion.php';
require_once __DIR__ . '/../../php/paseadores.php';

// La función require_login() se encarga de verificar si hay una sesión activa.
require_login();

// Asegurarse de que el usuario sea un paseador.
// Esta es una comprobación de seguridad adicional.
if ($_SESSION['role'] !== 'paseador') {
    // Redirigir a una página de error o a la página de inicio para su rol.
    header("Location: " . BASE_URL . "paginas/inicio-sesion.php");
    exit;
}


// Conectar a la base de datos
$conn = conectarBDManadas();

// Obtener el ID del paseador de la sesión
$id_paseador = $_SESSION['user_id'];

// Obtener los datos del paseador
$paseador = obtenerPaseadorPorId($conn, $id_paseador);

// Incluir el header
include_once __DIR__ . '/../../componentes/header.php';
?>

<!-- Profile Content -->
<div class="container profile-container">
    <!-- Hero Section -->
    <div class="hero-contained">
        <div class="hero-profile">
            <h1>Este es tu perfil, <?php echo htmlspecialchars($paseador['nombre']); ?></h1>
            <p>Administra tu información y gestiona tus datos personales 🐾</p>
        </div>
    </div>
    <?php
    if (isset($_GET['exito']) && $_GET['exito'] == '1') {
        echo '<div class="alert alert-success" role="alert">¡Tus datos se han actualizado correctamente!</div>';
    }
    ?>
    <div class="clean-card profile-card">
        <div class="profile-header">
            <img src="<?php echo BASE_URL . 'Assets/img/Usuario.jpg'; ?>" alt="Foto de perfil" class="profile-img">
        </div>
        <div class="profile-body">
            <div class="profile-info-item">
                <span>Nombre</span>
                <p><?php echo htmlspecialchars($paseador['nombre']); ?></p>
            </div>
            <div class="profile-info-item">
                <span>Apellido</span>
                <p><?php echo htmlspecialchars($paseador['apellido']); ?></p>
            </div>
            <div class="profile-info-item">
                <span>Email</span>
                <p><?php echo htmlspecialchars($paseador['email']); ?></p>
            </div>
            <div class="profile-info-item">
                <span>Teléfono</span>
                <p><?php echo htmlspecialchars($paseador['telefono']); ?></p>
            </div>
        </div>
        <div class="profile-actions">
            <a href="<?php echo BASE_URL; ?>paginas/paseador/editarPerfilPaseador.php" class="btn btn-primary">Editar mis datos</a>
            <a href="<?php echo BASE_URL; ?>php/logout.php" class="btn btn-secondary">Cerrar Sesión</a>
        </div>
    </div>
</div>

<?php include_once __DIR__ . '/../../componentes/footer.php'; ?>
