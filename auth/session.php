<?php
session_start();

/**
 * Crear sesión y redirigir según el rol del usuario.
 *
 * @param string $clave    Nombre de la variable de sesión (ej. 'email')
 * @param string $valor    Valor a guardar (ej. el email)
 * @param string $role     Rol del usuario: 'usuario'|'paseador'|'admin' (case-insensitive)
 * @param int    $user_id  ID del usuario en su tabla correspondiente
 * @param string $name     Nombre completo del usuario
 * @param string $img      Ruta o URL de la imagen de perfil
 */
function crearSesion($clave, $valor, $role = 'usuario', $user_id = null, $name = null, $img = null)
{
    $_SESSION[$clave] = $valor;
    $_SESSION['role'] = strtolower($role);

    if ($user_id !== null) {
        $_SESSION['user_id'] = $user_id;
    }
    if ($name !== null) {
        $_SESSION['user_name'] = $name;
    }
    if ($img !== null) {
        $_SESSION['user_img'] = $img;
    }

    $roleLower = strtolower($role);
    if ($roleLower === 'admin' || $roleLower === 'administrador') {
        header("Location: ../paginas/admin/inicio.php");
        exit();
    } elseif ($roleLower === 'paseador') {
        header("Location: ../paginas/paseador/inicio.php");
        exit();
    } else {
        header("Location: ../paginas/dueno/inicio.php");
        exit();
    }
}

function cerrarSesion($clave)
{
    unset($_SESSION[$clave]);
    session_destroy();
    header("Location: ../paginas/inicio-sesion.html");
    exit();
}

function controlarSesion()
{
    if (!isset($_SESSION['email'])) {
        header("Location: ../paginas/inicio-sesion.html");
        exit();
    }
    return $_SESSION['email'];
}

function controlarRol($requiredRole)
{
    if (!isset($_SESSION['role']) || strtolower($_SESSION['role']) !== strtolower($requiredRole)) {
        $currentRole = $_SESSION['role'] ?? '';
        if ($currentRole === 'admin') {
            header("Location: ../paginas/admin/inicio.php");
        } elseif ($currentRole === 'paseador') {
            header("Location: ../paginas/paseador/inicio.php");
        } else {
            header("Location: ../paginas/dueno/inicio.php");
        }
        exit();
    }
    return true;
}
