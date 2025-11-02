<?php
require_once __DIR__ . '/../../php/config.php';
require_once __DIR__ . '/../../php/sesion.php';
require_once __DIR__ . '/../../php/mascotas.php';

// Proteger la página. Si el usuario no está logueado, lo redirige.
require_login();

$id_dueno = $_SESSION['user_id'];
$id_mascota = filter_input(INPUT_GET, 'id', FILTER_VALIDATE_INT);
$mensaje = '';

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

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nombre = $_POST['nombre'] ?? '';
    $raza = $_POST['raza'] ?? '';
    $tamano = $_POST['tamano'] ?? '';
    $observaciones = $_POST['observaciones'] ?? '';
    $img = $_FILES['img'] ?? null;

    if (!empty($nombre) && !empty($tamano)) {
        if (actualizarMascota($id_mascota, $nombre, $raza, $tamano, $observaciones, $img)) {
            header('Location: perfilUsuarioMisMascotas.php?exito=mascota_actualizada');
            exit;
        } else {
            $mensaje = 'Error al actualizar la mascota. Por favor, intenta de nuevo.';
        }
    } else {
        $mensaje = 'Por favor, completa todos los campos requeridos.';
    }
}

include_once __DIR__ . '/../../componentes/header.php';
?>

<div class="container mt-5 mb-5">
    <h2 class="mb-4">Editar Mascota</h2>

    <?php if ($mensaje): ?>
        <div class="alert alert-danger" role="alert">
            <?php echo htmlspecialchars($mensaje); ?>
        </div>
    <?php endif; ?>

    <form action="editarMascota.php?id=<?php echo $id_mascota; ?>" method="POST" enctype="multipart/form-data">
        <div class="mb-3">
            <label for="nombre" class="form-label">Nombre</label>
            <input type="text" class="form-control" id="nombre" name="nombre" value="<?php echo htmlspecialchars($mascota['nombre']); ?>" required>
        </div>
        <div class="mb-3">
            <label for="raza" class="form-label">Raza</label>
            <input type="text" class="form-control" id="raza" name="raza" value="<?php echo htmlspecialchars($mascota['raza']); ?>">
        </div>
        <div class="mb-3">
            <label for="tamano" class="form-label">Tamaño</label>
            <select class="form-select" id="tamano" name="tamano" required>
                <option value="pequeno" <?php echo $mascota['tamano'] === 'pequeno' ? 'selected' : ''; ?>>Pequeño</option>
                <option value="mediano" <?php echo $mascota['tamano'] === 'mediano' ? 'selected' : ''; ?>>Mediano</option>
                <option value="grande" <?php echo $mascota['tamano'] === 'grande' ? 'selected' : ''; ?>>Grande</option>
            </select>
        </div>
        <div class="mb-3">
            <label for="observaciones" class="form-label">Observaciones</label>
            <textarea class="form-control" id="observaciones" name="observaciones" rows="3"><?php echo htmlspecialchars($mascota['observaciones']); ?></textarea>
        </div>
        <div class="mb-3">
            <label for="img" class="form-label">Foto actual</label>
            <div>
                <img src="<?php echo BASE_URL; ?>Assets/img/mascotas/<?php echo !empty($mascota['img']) ? htmlspecialchars($mascota['img']) : 'default.png'; ?>" alt="Foto actual" width="150">
            </div>
            <label for="img" class="form-label mt-2">Cambiar foto</label>
            <input class="form-control" type="file" id="img" name="img" accept="image/*">
        </div>
        <div class="d-grid">
            <button type="submit" class="btn btn-primary">Guardar Cambios</button>
        </div>
    </form>
</div>

<?php include_once __DIR__ . '/../../componentes/footer.php'; ?>
