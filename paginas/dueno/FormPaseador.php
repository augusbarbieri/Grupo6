<?php
require_once __DIR__ . '/../../php/config.php'; // Defines BASE_URL
include_once __DIR__ . '/../../componentes/header.php';
?>

<!-- Hero-->
<section class="hero">
    <h1 class="display-4 fw-bold">Guarda cupo para tu proximo paseo</h1>
    <p class="lead">Queres pasear con el paseador X</p>
    <img src="<?php echo BASE_URL; ?>Assets/img/walker1.jpg" class="rounded-circle border mb-3" width="200" height="200" padding=60>
</section>
<div class="container mt-5">
    <h2 class="mb-4">Agregar Mascota</h2>
    <form id="formMascota">
        <!-- Nombre -->
        <div class="mb-3">
            <label for="nombre" class="form-label">Pone el nombre de tu mascota</label>
            <input type="text" class="form-control" id="nombre" name="nombre" required>
        </div>


        <!-- Botón -->
        <div class="d-grid">
            <a type="submit" class="btn btn-primary" href="<?php echo BASE_URL; ?>paginas/dueno/landingUsuario.php">Agregar al paseo</a>
        </div>
    </form>
</div>

<?php include_once __DIR__ . '/../../componentes/footer.php'; ?>
