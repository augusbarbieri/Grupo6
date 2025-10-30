<?php
// Logout: usa la función cerrarSesion definida en sesion.php
include "sesion.php"; // incluye session_start() y cerrarSesion()

// Cerrar sesión para la clave 'email'
cerrarSesion('email');
