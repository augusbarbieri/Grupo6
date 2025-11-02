<?php
require_once __DIR__ . '/../../php/config.php';
require_once __DIR__ . '/../../php/sesion.php';
require_once __DIR__ . '/../../php/conexion.php';
require_once __DIR__ . '/../../php/usuarios.php';

controlarSesion();

$conn = conectarBDManadas();
$id_usuario = $_SESSION['user_id'];
$mensaje = '';
$usuario = obtenerUsuarioPorId($conn, $id_usuario);

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nombre = $_POST['nombre'] ?? $usuario['nombre'];
    $apellido = $_POST['apellido'] ?? $usuario['apellido'];
    $email = $_POST['email'] ?? $usuario['email'];
    $telefono = $_POST['telefono'] ?? $usuario['telefono'];
    $direccion = $_POST['direccion'] ?? $usuario['direccion'];
    $img_actual = $usuario['img'];

    // Lógica para manejar la subida de la foto de perfil
    if (isset($_FILES['img']) && $_FILES['img']['error'] == UPLOAD_ERR_OK) {
        $foto_temp = $_FILES['img']['tmp_name'];
        $nombre_foto = uniqid() . '-' . basename($_FILES['img']['name']);
        $ruta_destino = __DIR__ . '/../../Assets/img/usuarios/' . $nombre_foto;

        // Asegurarse de que el directorio de subida existe
        if (!is_dir(__DIR__ . '/../../Assets/img/usuarios/')) {
            mkdir(__DIR__ . '/../../Assets/img/usuarios/', 0755, true);
        }

        if (move_uploaded_file($foto_temp, $ruta_destino)) {
            $img_actual = 'Assets/img/usuarios/' . $nombre_foto;
        } else {
            $mensaje = '<div class="alert alert-danger" role="alert">Error al subir la imagen.</div>';
        }
    }

    if (empty($mensaje) && actualizarUsuario($conn, $id_usuario, $nombre, $apellido, $email, $telefono, $direccion, $img_actual)) {
        header("Location: " . BASE_URL . "paginas/dueno/perfilUsuario.php?exito=1");
        exit;
    } else if (empty($mensaje)) {
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
                <img src="<?php echo BASE_URL . htmlspecialchars($usuario['img'] ?? 'Assets/img/Usuario.jpg'); ?>" alt="Foto de perfil" class="profile-img">
                <div class="mt-3">
                    <label for="img" class="btn btn-secondary">Cambiar Foto</label>
                    <input type="file" name="img" id="img" class="d-none">
                </div>
            </div>
            <div class="profile-body">
                <div class="profile-info-item">
                    <span>Nombre</span>
                    <input type="text" class="form-control" name="nombre" value="<?php echo htmlspecialchars($usuario['nombre']); ?>">
                </div>
                <div class="profile-info-item">
                    <span>Apellido</span>
                    <input type="text" class="form-control" name="apellido" value="<?php echo htmlspecialchars($usuario['apellido']); ?>">
                </div>
                <div class="profile-info-item">
                    <span>Email</span>
                    <input type="email" class="form-control" name="email" value="<?php echo htmlspecialchars($usuario['email']); ?>">
                </div>
                <div class="profile-info-item">
                    <span>Teléfono</span>
                    <input type="text" class="form-control" name="telefono" value="<?php echo htmlspecialchars($usuario['telefono']); ?>">
                </div>
                <div class="profile-info-item full-width">
                    <span>Dirección</span>
                    <input type="text" class="form-control" name="direccion" value="<?php echo htmlspecialchars($usuario['direccion']); ?>">
                </div>
            </div>
            <div class="profile-actions">
                <button type="submit" class="btn btn-primary">Guardar Cambios</button>
                <a href="<?php echo BASE_URL; ?>paginas/dueno/perfilUsuario.php" class="btn btn-secondary">Cancelar</a>
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
