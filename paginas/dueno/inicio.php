<?php
require_once __DIR__ . '/../../php/config.php'; // Defines BASE_URL
require_once __DIR__ . '/../../php/sesion.php';

// Proteger la página para usuarios dueños
require_login();
$user_role = get_user_role();
if ($user_role !== 'usuario' && $user_role !== 'dueno') {
    // Si no es un usuario estándar, redirigir a la página de inicio de sesión
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
    <title>Panel de Usuario - Manadas</title>
</head>

<body>
    <div class="container mt-4">
        <h1>Bienvenido, Usuario</h1>
        <!-- Contenido del panel de usuario -->
    </div>
</body>

</html>
