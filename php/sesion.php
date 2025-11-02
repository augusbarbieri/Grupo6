<?php
// Incluir la configuración para tener disponible BASE_URL
require_once __DIR__ . '/config.php';

// Iniciar la sesión solo si no está ya iniciada.
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

/**
 * Crea la sesión de usuario guardando sus datos.
 * Esta función NO redirige. La redirección debe manejarse
 * en el script que la llama (ej: login.php).
 */
function crearSesion($email, $role, $user_id, $name, $img) {
    $_SESSION['email'] = $email;
    $_SESSION['role'] = strtolower($role);
    $_SESSION['user_id'] = $user_id;
    $_SESSION['user_name'] = $name;
    $_SESSION['user_img'] = $img;
}

/**
 * Cierra la sesión del usuario y lo redirige al login.
 */
function cerrarSesion() {
    session_unset();
    session_destroy();

    // Redirecciona a la página de login.
    header("Location: " . BASE_URL . "paginas/inicio-sesion.php");
    exit();
}

/**
 * Verifica si el usuario ha iniciado sesión.
 * @return bool True si está logueado, false si no.
 */
function is_logged_in() {
    return isset($_SESSION['user_id']);
}

/**
 * Función para proteger páginas. Si el usuario no está logueado,
 * lo redirige a la página de inicio de sesión.
 */
function require_login() {
    if (!is_logged_in()) {
        header("Location: " . BASE_URL . "paginas/inicio-sesion.php");
        exit();
    }
}

function get_user_role() {
    return $_SESSION['role'] ?? null;
}
