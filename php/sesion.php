<?php
// Incluir la configuración para tener disponible BASE_URL
require_once __DIR__ . '/config.php';

// Siempre se debe llamar a session_start() al principio
// si vas a trabajar con sesiones.
session_start();

/**
 * Función para crear la sesión después del login/registro.
 * Recibe la clave (generalmente 'email') y el valor (el email del usuario).
 */
/**
 * Crear sesión y redirigir según el rol del usuario.
 *
 * @param string $clave  Nombre de la variable de sesión (ej. 'email')
 * @param string $valor  Valor a guardar (ej. el email)
 * @param string $role   Rol del usuario: 'usuario'|'paseador'|'admin' (case-insensitive)
 */
function crearSesion($clave, $valor, $role = 'usuario', $user_id = null, $name = null, $img = null)
{
    // Guardamos el email (o la clave que se indique) y el rol en la sesión.
    $_SESSION[$clave] = $valor;
    $_SESSION['role'] = strtolower($role);

    // Guardar id y datos básicos en sesión si se pasan
    if ($user_id !== null) {
        $_SESSION['user_id'] = $user_id;
    }
    if ($name !== null) {
        $_SESSION['user_name'] = $name;
    }
    if ($img !== null) {
        $_SESSION['user_img'] = $img;
    }

    // Redirigimos según el rol, usando BASE_URL para rutas absolutas
    $roleLower = strtolower($role);
    if ($roleLower === 'admin' || $roleLower === 'administrador') {
        header("Location: " . BASE_URL . "paginas/admin/inicio.php");
        exit();
    } elseif ($roleLower === 'paseador') {
        header("Location: " . BASE_URL . "paginas/paseador/inicio.php");
        exit();
    } else {
        // Por defecto, dueño de mascota
        header("Location: " . BASE_URL . "paginas/dueno/inicio.php");
        exit();
    }
}

/**
 * Función para cerrar la sesión (Logout).
 * La usaremos más adelante cuando implementes el botón de "Cerrar Sesión".
 */
function cerrarSesion($clave)
{
    // Elimina la variable clave en sesión.
    unset($_SESSION[$clave]);

    // Elimina todos los datos de la sesión.
    session_destroy();

    // Redirecciona a la página de login.
    header("Location: " . BASE_URL . "paginas/inicio-sesion.php");
    exit();
}

/**
 * Función para verificar si hay una sesión activa.
 * La usaremos en páginas protegidas (como el perfil) para
 * asegurarnos de que el usuario esté logueado.
 */
function controlarSesion()
{
    $sesionUsuario = NULL;
    // Verifica si la variable de sesión 'email' existe.
    if (isset($_SESSION['email'])) {
        // Si existe, la retornamos.
        $sesionUsuario = $_SESSION['email'];
    } else {
        // Si no existe, significa que el usuario no está logueado.
        // Lo redirigimos a la página de login.
        header("Location: " . BASE_URL . "paginas/inicio-sesion.php");
        exit();
    }
    return $sesionUsuario;
}

// Puedes agregar más funciones relacionadas con sesiones aquí si las necesitas.
