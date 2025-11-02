<?php
require_once __DIR__ . '/../../php/config.php';
require_once __DIR__ . '/../../php/sesion.php';
require_once __DIR__ . '/../../php/conexion.php';
require_once __DIR__ . '/../../php/usuarios.php';

// session_start() está en sesion.php, así que no es necesario llamarlo de nuevo.
// Sin embargo, necesitamos controlar que haya una sesión activa.
// La función controlarSesion() ya se encarga de redirigir si no hay sesión.
controlarSesion();

// Conectar a la base de datos
$conn = conectarBDManadas();

// Obtener el ID del usuario de la sesión
$id_usuario = $_SESSION['user_id'];

// Obtener los datos del usuario
$usuario = obtenerUsuarioPorId($conn, $id_usuario);

// Incluir el header
include_once __DIR__ . '/../../componentes/header.php';
?>

<!-- Hero -->
<section class="hero text-center text-white bg-dark py-5 mt-3">
    <div class="container">
        <h1 class="display-4 fw-bold">Este es tu perfil, <?php echo htmlspecialchars($usuario['nombre']); ?></h1>
        <p class="lead">Administra tu información y gestiona tus datos personales 🐾</p>
    </div>
</section>

<!-- Contenedor Perfil centrado -->
<div class="container mt-5 mb-5">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <?php
            if (isset($_GET['exito']) && $_GET['exito'] == '1') {
                echo '<div class="alert alert-success" role="alert">¡Tus datos se han actualizado correctamente!</div>';
            }
            ?>
            <div class="card shadow-sm">
                <div class="card-header bg-dark text-white text-center">
                    <h2>Tu Información Personal</h2>
                </div>
                <div class="card-body p-4">
                    <div class="row align-items-center">
                        <div class="col-md-4 text-center">
                            <img src="<?php echo BASE_URL; ?>Assets/img/Usuario.jpg" alt="Foto de perfil" class="img-fluid rounded-circle border mb-3" style="width: 150px; height: 150px;">
                        </div>
                        <div class="col-md-8">
                            <ul class="list-group list-group-flush">
                                <li class="list-group-item"><strong>Nombre:</strong> <?php echo htmlspecialchars($usuario['nombre']); ?></li>
                                <li class="list-group-item"><strong>Apellido:</strong> <?php echo htmlspecialchars($usuario['apellido']); ?></li>
                                <li class="list-group-item"><strong>Email:</strong> <?php echo htmlspecialchars($usuario['email']); ?></li>
                                <li class="list-group-item"><strong>Teléfono:</strong> <?php echo htmlspecialchars($usuario['telefono']); ?></li>
                                <li class="list-group-item"><strong>Dirección:</strong> <?php echo htmlspecialchars($usuario['direccion']); ?></li>
                            </ul>
                        </div>
                    </div>
                    <div class="text-center mt-4">
                        <a href="<?php echo BASE_URL; ?>paginas/dueno/editarPerfil.php" class="btn btn-primary">
                            <i class="fas fa-pencil-alt"></i> Editar mis datos
                        </a>
                        <a href="<?php echo BASE_URL; ?>auth/logout.php" class="btn btn-danger ms-2">
                            <i class="fas fa-sign-out-alt"></i> Cerrar Sesión
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?php include_once __DIR__ . '/../../componentes/footer.php'; ?>
