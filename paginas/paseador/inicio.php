<?php
require_once __DIR__ . '/../../php/config.php'; // Defines BASE_URL
require_once __DIR__ . '/../../php/sesion.php';

// Proteger la página para paseadores
require_login();
if (get_user_role() !== 'paseador') {
    // Si no es paseador, redirigir a una página de error o a la página de inicio de sesión
    header("Location: " . BASE_URL . "paginas/inicio-sesion.php?error=unauthorized");
    exit();
}

include "../../componentes/header.php";
?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Panel de Paseador - Manadas</title>
</head>

<body>
    <div class="container mt-4">
        <h1>Bienvenido, Paseador</h1>
        <!-- Contenido del panel paseador -->
    </div>
</body>

</html>
