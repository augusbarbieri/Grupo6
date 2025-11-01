<?php
require_once "../../auth/session.php";
$email = controlarSesion();
controlarRol('usuario');

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