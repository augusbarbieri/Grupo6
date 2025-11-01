<?php
require_once __DIR__ . '/../../php/config.php'; // Defines BASE_URL
include_once __DIR__ . '/../../componentes/header.php';
?>

<!-- Hero-->
<section class="hero">
    <h1 class="display-4 fw-bold">Mascota guardada</h1>
    <p class="lead">Volve a la pagina principal</p>

</section>
<div class="container mt-5">
    <h2 class="mb-4">Agregar Mascota</h2>
    <form id="formMascota">
        <!-- Botón -->
        <div class="d-grid">
            <a href="<?php echo BASE_URL; ?>paginas/dueno/landingUsuario.php" class="btn btn-primary d-grid">Volver</a>
        </div>
        <div class="mb-3">
        </div>

        <?php include_once __DIR__ . '/../../componentes/footer.php'; ?>
