<?php
session_start();

function crearSesion($email, $role, $user_id, $name, $img) {
    $_SESSION['email'] = $email;
    $_SESSION['role'] = strtolower($role);
    $_SESSION['user_id'] = $user_id;
    $_SESSION['user_name'] = $name;
    $_SESSION['user_img'] = $img;
}

function cerrarSesion() {
    session_unset();
    session_destroy();
    header("Location: ../paginas/inicio-sesion.php");
    exit();
}

function is_logged_in() {
    return isset($_SESSION['email']);
}

function get_user_role() {
    return $_SESSION['role'] ?? null;
}
