<?php
require_once __DIR__ . '/../../php/config.php';
require_once __DIR__ . '/../../php/sesion.php';
require_once __DIR__ . '/../../php/conexion.php';
require_once __DIR__ . '/../../php/usuarios.php';

// session_start() está en sesion.php, así que no es necesario llamarlo de nuevo.
// Sin embargo, necesitamos controlar que haya una sesión activa.
// La función require_login() ya se encarga de redirigir si no hay sesión.
require_login();

// Conectar a la base de datos
$conn = conectarBDManadas();

// Obtener el ID del usuario de la sesión
$id_usuario = $_SESSION['user_id'];

// Obtener los datos del usuario
$usuario = obtenerUsuarioPorId($conn, $id_usuario);

// Incluir el header
include_once __DIR__ . '/../../componentes/header.php';
?>

<!-- Hero Section -->
<div class="hero-profile">
    <div class="container">
        <h1>Este es tu perfil, <?php echo htmlspecialchars($usuario['nombre']); ?></h1>
        <p>Administra tu información y gestiona tus datos personales 🐾</p>
    </div>
</div>

<!-- Profile Content -->
<div class="container profile-container">
    <?php
    if (isset($_GET['exito']) && $_GET['exito'] == '1') {
        echo '<div class="alert alert-success" role="alert">¡Tus datos se han actualizado correctamente!</div>';
    }
    ?>
    <div class="profile-card">
        <div class="profile-header">
            <img src="<?php echo BASE_URL . htmlspecialchars($usuario['img'] ?? 'Assets/img/Usuario.jpg'); ?>" alt="Foto de perfil" class="profile-img">
        </div>
        <div class="profile-body">
            <div class="profile-info-item">
                <span>Nombre</span>
                <p><?php echo htmlspecialchars($usuario['nombre']); ?></p>
            </div>
            <div class="profile-info-item">
                <span>Apellido</span>
                <p><?php echo htmlspecialchars($usuario['apellido']); ?></p>
            </div>
            <div class="profile-info-item">
                <span>Email</span>
                <p><?php echo htmlspecialchars($usuario['email']); ?></p>
            </div>
            <div class="profile-info-item">
                <span>Teléfono</span>
                <p><?php echo htmlspecialchars($usuario['telefono']); ?></p>
            </div>
            <div class="profile-info-item">
                <span>Dirección</span>
                <p><?php echo htmlspecialchars($usuario['direccion']); ?></p>
            </div>
        </div>
        <div class="profile-actions">
            <a href="<?php echo BASE_URL; ?>paginas/dueno/editarPerfil.php" class="btn btn-primary">Editar mis datos</a>
            <a href="<?php echo BASE_URL; ?>auth/logout.php" class="btn btn-secondary">Cerrar Sesión</a>
        </div>
    </div>
</div>

<?php include_once __DIR__ . '/../../componentes/footer.php'; ?>
