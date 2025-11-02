<?php
require_once __DIR__ . '/../../php/config.php';
require_once __DIR__ . '/../../php/sesion.php';
require_once __DIR__ . '/../../php/mascotas.php';

// Proteger la página. Si el usuario no está logueado, lo redirige.
require_login();

$id_dueno = $_SESSION['user_id'];
$mensaje = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nombre = $_POST['nombre'] ?? '';
    $raza = $_POST['raza'] ?? '';
    $tamano = $_POST['tamano'] ?? '';
    $observaciones = $_POST['observaciones'] ?? '';
    $img = $_FILES['img'] ?? null;

    if (!empty($nombre) && !empty($tamano)) {
        if (agregarMascota($id_dueno, $nombre, $raza, $tamano, $observaciones, $img)) {
            header('Location: ' . BASE_URL . 'paginas/dueno/perfilUsuarioMisMascotas.php?exito=mascota_agregada');
            exit;
        } else {
            $mensaje = 'Error al agregar la mascota. Por favor, intenta de nuevo.';
        }
    } else {
        $mensaje = 'Por favor, completa todos los campos requeridos.';
    }
}

include_once __DIR__ . '/../../componentes/header.php';
?>

<div class="container mt-5 mb-5">
    <h2 class="mb-4">Agregar Mascota</h2>

    <?php if ($mensaje): ?>
        <div class="alert alert-danger" role="alert">
            <?php echo htmlspecialchars($mensaje); ?>
        </div>
    <?php endif; ?>

    <form action="formMascota.php" method="POST" enctype="multipart/form-data">
        <div class="mb-3">
            <label for="nombre" class="form-label">Nombre de la mascota *</label>
            <input type="text" class="form-control" id="nombre" name="nombre" required>
        </div>
        <div class="mb-3">
            <label for="raza" class="form-label">Raza</label>
            <input type="text" class="form-control" id="raza" name="raza">
        </div>
        <div class="mb-3">
            <label for="tamano" class="form-label">Tamaño *</label>
            <select class="form-select" id="tamano" name="tamano" required>
                <option value="">Selecciona el tamaño</option>
                <option value="pequeno">Pequeño</option>
                <option value="mediano">Mediano</option>
                <option value="grande">Grande</option>
            </select>
        </div>
        <div class="mb-3">
            <label for="observaciones" class="form-label">Observaciones</label>
            <textarea class="form-control" id="observaciones" name="observaciones" rows="3"></textarea>
        </div>
        <div class="mb-3">
            <label for="img" class="form-label">Foto de la mascota</label>
            <input class="form-control" type="file" id="img" name="img" accept="image/*">
        </div>
        <div class="d-grid">
            <button type="submit" class="btn btn-primary">Agregar Mascota</button>
        </div>
    </form>
</div>

<?php include_once __DIR__ . '/../../componentes/footer.php'; ?>
