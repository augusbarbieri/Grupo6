<?php
require_once __DIR__ . '/../../php/config.php';
require_once __DIR__ . '/../../php/sesion.php';
require_once __DIR__ . '/../../php/mascotas.php';

// Proteger la página. Si el usuario no está logueado, lo redirige.
require_login();

// Obtener los datos del dueño y sus mascotas
$id_dueno = $_SESSION['user_id'];
$mascotas = obtenerMascotasPorDueno($id_dueno);

// Incluir el header después de toda la lógica de sesión y datos.
include_once __DIR__ . '/../../componentes/header.php';
?>

<!-- Hero -->
<section class="hero text-center text-white bg-dark py-5 mt-4">
    <div class="container">
        <h1 class="display-4 fw-bold">Mis Mascotas</h1>
        <p class="lead">🐶 Aquí están tus perritos 🐶</p>
    </div>
</section>

<div class="container mt-5 mb-5">
    <div class="d-flex justify-content-end mb-4">
        <a href="<?php echo BASE_URL; ?>paginas/dueno/formMascota.php" class="btn btn-primary">
            <i class="fas fa-plus"></i> Agregar Mascota
        </a>
    </div>

    <?php if (isset($_GET['exito']) && $_GET['exito'] === 'mascota_agregada'): ?>
        <div class="alert alert-success">Mascota agregada correctamente.</div>
    <?php endif; ?>
    <?php if (isset($_GET['exito']) && $_GET['exito'] === 'mascota_actualizada'): ?>
        <div class="alert alert-success">Mascota actualizada correctamente.</div>
    <?php endif; ?>
     <?php if (isset($_GET['exito']) && $_GET['exito'] === 'mascota_eliminada'): ?>
        <div class="alert alert-success">Mascota eliminada correctamente.</div>
    <?php endif; ?>
    <?php if (isset($_GET['error'])): ?>
        <div class="alert alert-danger">Ha ocurrido un error.</div>
    <?php endif; ?>

    <div class="row g-4">
        <?php if (empty($mascotas)): ?>
            <div class="col-12">
                <p class="text-center">Aún no has registrado ninguna mascota.</p>
            </div>
        <?php else: ?>
            <?php foreach ($mascotas as $mascota): ?>
                <div class="col-md-6 col-lg-4">
                    <div class="card h-100 shadow-sm">
                        <img src="<?php echo BASE_URL; ?>Assets/img/mascotas/<?php echo !empty($mascota['img']) ? htmlspecialchars($mascota['img']) : 'default.png'; ?>" class="card-img-top" alt="Foto de <?php echo htmlspecialchars($mascota['nombre']); ?>" style="height: 200px; object-fit: cover;">
                        <div class="card-body">
                            <h5 class="card-title"><?php echo htmlspecialchars($mascota['nombre']); ?></h5>
                            <p class="card-text"><strong>Raza:</strong> <?php echo htmlspecialchars($mascota['raza']); ?></p>
                            <p class="card-text"><strong>Tamaño:</strong> <?php echo ucfirst(htmlspecialchars($mascota['tamano'])); ?></p>
                            <p class="card-text"><strong>Observaciones:</strong> <?php echo htmlspecialchars($mascota['observaciones']); ?></p>
                        </div>
                        <div class="card-footer bg-transparent border-top-0 d-flex justify-content-end gap-2">
                             <a href="editarMascota.php?id=<?php echo $mascota['id_mascota']; ?>" class="btn btn-sm btn-outline-primary">
                                <i class="fas fa-pencil-alt"></i> Editar
                            </a>
                            <a href="eliminarMascota.php?id=<?php echo $mascota['id_mascota']; ?>" class="btn btn-sm btn-outline-danger" onclick="return confirm('¿Estás seguro de que quieres eliminar a <?php echo htmlspecialchars($mascota['nombre']); ?>?');">
                                <i class="fas fa-trash-alt"></i> Eliminar
                            </a>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        <?php endif; ?>
    </div>
</div>

<?php include_once __DIR__ . '/../../componentes/footer.php'; ?>
