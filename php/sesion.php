<?php
// Siempre se debe llamar a session_start() al principio
// si vas a trabajar con sesiones.
session_start();

/**
 * Función para crear la sesión después del login/registro.
 * Recibe la clave (generalmente 'email') y el valor (el email del usuario).
 */
function crearSesion($clave, $valor)
{
    // 1. Guardamos el email del usuario en la variable de sesión.
    //    Esto lo "recuerda" el servidor para futuras visitas.
    $_SESSION[$clave] = $valor;

    // 2. Redireccionamos al usuario a su página principal.
    //    Usamos '../' para subir un nivel desde la carpeta 'php/'
    //    y luego entrar a 'Paginas/Usuario/'.
    header("Location: ../Paginas/Usuario/landingUsuario.html");
    exit(); // Es buena práctica llamar a exit() después de un header Location.
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
    header("Location: ../Paginas/login.html");
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
        header("Location: ../Paginas/login.html");
        exit();
    }
    return $sesionUsuario;
}

// Puedes agregar más funciones relacionadas con sesiones aquí si las necesitas.
