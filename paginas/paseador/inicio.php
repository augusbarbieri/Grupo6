<?php
require_once __DIR__ . '/../../php/config.php'; // Defines BASE_URL
require_once "../../auth/session.php";
$email = controlarSesion();
controlarRol('paseador');

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
