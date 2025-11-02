<?php
require_once __DIR__ . '/php/config.php';
require_once __DIR__ . '/php/sesion.php';

if (is_logged_in()) {
    header('Location: ' . BASE_URL . 'paginas/dueno/perfilUsuarioMisMascotas.php');
    exit;
}

include_once __DIR__ . '/componentes/header.php';
?>

<div class="container">
    <h1>Bienvenido a Manadas</h1>
    <p>La mejor plataforma para conectar dueños de mascotas con paseadores de confianza.</p>
</div>

<?php include_once __DIR__ . '/componentes/footer.php'; ?>
