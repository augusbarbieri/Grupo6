<?php
require_once __DIR__ . '/../../php/config.php'; // Defines BASE_URL
include_once __DIR__ . '/../../componentes/header.php';
?>

<!-- Hero -->
<section class="hero text-center text-white bg-dark py-5 mt-3">
    <div class="container">
        <h1 class="display-4 fw-bold">Este es tu perfil</h1>
        <p class="lead">Administra tu información y gestiona tus datos personales 🐾</p>
    </div>
</section>

<!-- Contenedor Perfil centrado -->
<div class="perfil-container">
    <div class="perfil-card text-center bg-light p-4 rounded shadow">
        <img src="<?php echo BASE_URL; ?>Assets/img/Usuario.jpg" alt="Foto de perfil" class="rounded-circle border d-block mx-auto mb-3" width="200" height="200">

        <!-- Input para cambiar el nombre -->
        <input type="text" class="form-control mb-3" placeholder="Mi nombre">

        <!-- Botón logout -->
        <button class="btn btn-danger w-100" onclick="window.location.href='<?php echo BASE_URL; ?>auth/logout.php'">
            Logout
        </button>
    </div>
</div>

<?php include_once __DIR__ . '/../../componentes/footer.php'; ?>
