<?php
require_once __DIR__ . '/../../php/config.php';
require_once __DIR__ . '/../../php/sesion.php';
require_once __DIR__ . '/../../php/conexion.php';
require_once __DIR__ . '/../../php/usuarios.php';

controlarSesion();

$conn = conectarBDManadas();
$id_usuario = $_SESSION['user_id'];
$mensaje = '';

// Si el formulario se envió, procesar los datos
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nombre = $_POST['nombre'] ?? '';
    $apellido = $_POST['apellido'] ?? '';
    $email = $_POST['email'] ?? '';
    $telefono = $_POST['telefono'] ?? '';
    $direccion = $_POST['direccion'] ?? '';

    if (actualizarUsuario($conn, $id_usuario, $nombre, $apellido, $email, $telefono, $direccion)) {
        // Redirigir al perfil si la actualización fue exitosa
        header("Location: " . BASE_URL . "paginas/dueno/perfilUsuario.php?exito=1");
        exit;
    } else {
        $mensaje = '<div class="alert alert-danger" role="alert">Error al actualizar los datos. Por favor, inténtelo de nuevo.</div>';
    }
}

// Obtener los datos actuales del usuario para mostrarlos en el formulario
$usuario = obtenerUsuarioPorId($conn, $id_usuario);

include_once __DIR__ . '/../../componentes/header.php';
?>

<!-- Hero -->
<section class="hero text-center text-white bg-dark py-5 mt-3">
    <div class="container">
        <h1 class="display-4 fw-bold">Editar Perfil</h1>
        <p class="lead">Actualiza tu información personal aquí.</p>
    </div>
</section>

<div class="container mt-5 mb-5">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card shadow-sm">
                <div class="card-header bg-dark text-white text-center">
                    <h2>Modificar mis Datos</h2>
                </div>
                <div class="card-body p-4">
                    <?php echo $mensaje; ?>
                    <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="POST">
                        <div class="mb-3">
                            <label for="nombre" class="form-label">Nombre</label>
                            <input type="text" class="form-control" id="nombre" name="nombre" value="<?php echo htmlspecialchars($usuario['nombre']); ?>" required>
                        </div>
                        <div class="mb-3">
                            <label for="apellido" class="form-label">Apellido</label>
                            <input type="text" class="form-control" id="apellido" name="apellido" value="<?php echo htmlspecialchars($usuario['apellido']); ?>" required>
                        </div>
                        <div class="mb-3">
                            <label for="email" class="form-label">Email</label>
                            <input type="email" class="form-control" id="email" name="email" value="<?php echo htmlspecialchars($usuario['email']); ?>" required>
                        </div>
                        <div class="mb-3">
                            <label for="telefono" class="form-label">Teléfono</label>
                            <input type="text" class="form-control" id="telefono" name="telefono" value="<?php echo htmlspecialchars($usuario['telefono']); ?>" required>
                        </div>
                        <div class="mb-3">
                            <label for="direccion" class="form-label">Dirección</label>
                            <input type="text" class="form-control" id="direccion" name="direccion" value="<?php echo htmlspecialchars($usuario['direccion']); ?>" required>
                        </div>
                        <div class="text-center">
                            <button type="submit" class="btn btn-primary"><i class="fas fa-save"></i> Guardar Cambios</button>
                            <a href="<?php echo BASE_URL; ?>paginas/dueno/perfilUsuario.php" class="btn btn-secondary ms-2">Cancelar</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<?php include_once __DIR__ . '/../../componentes/footer.php'; ?>
