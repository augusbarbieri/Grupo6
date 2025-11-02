<?php
// Incluir el archivo de sesión de forma segura
require_once __DIR__ . '/sesion.php';

// La función cerrarSesion se encarga de destruir la sesión
// y redirigir al usuario a la página de inicio de sesión.
cerrarSesion();
