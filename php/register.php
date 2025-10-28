<?php
// 1. Incluimos nuestros archivos
include "conexion.php";
include "sesion.php"; // session_start() ya está aquí

// Obtener y limpiar entradas
$nombre     = trim($_POST['nombre'] ?? '');
$apellido   = trim($_POST['apellido'] ?? '');
$email      = trim($_POST['email'] ?? '');
$telefono   = trim($_POST['telefono'] ?? '');
$direccion  = trim($_POST['direccion'] ?? '');
$password   = $_POST['password'] ?? '';
$password_r = $_POST['password_r'] ?? '';

// Validaciones básicas
if ($nombre === '' || $apellido === '' || $email === '' || $password === '' || $password_r === '') {
    echo 'Faltan campos obligatorios. <a href="../Paginas/Register.html">Volver</a>';
    exit();
}

if ($password !== $password_r) {
    echo 'Las contraseñas no coinciden. <a href="../Paginas/Register.html">Volver</a>';
    exit();
}

// Preparar ruta de uploads (usar ruta absoluta en servidor)
$upload_dir = __DIR__ . '/../uploads/perfiles/';
if (!is_dir($upload_dir)) {
    mkdir($upload_dir, 0755, true);
}

$path_imagen_bd = "uploads/perfiles/default.png"; // por defecto
if (isset($_FILES["img"]) && $_FILES["img"]["error"] === UPLOAD_ERR_OK) {
    $nombre_original = basename($_FILES["img"]["name"]);
    $extension = strtolower(pathinfo($nombre_original, PATHINFO_EXTENSION));
    $allowed = ['jpg','jpeg','png','webp','gif'];
    if (!in_array($extension, $allowed)) {
        echo 'Tipo de archivo no permitido. <a href="../Paginas/Register.html">Volver</a>';
        exit();
    }
    // Limitar tamaño ejemplo 5MB
    if ($_FILES["img"]["size"] > 5 * 1024 * 1024) {
        echo 'Imagen demasiado grande. <a href="../Paginas/Register.html">Volver</a>';
        exit();
    }

    $nombre_unico = uniqid('pf_', true) . '.' . $extension;
    $path_completo = $upload_dir . $nombre_unico;

    if (move_uploaded_file($_FILES["img"]["tmp_name"], $path_completo)) {
        $path_imagen_bd = 'uploads/perfiles/' . $nombre_unico; // ruta relativa para guardar en BD
    } else {
        // continuar con imagen por defecto
    }
}

// Conectar DB
$conn = conectarBDManadas();
if (!$conn) {
    echo 'Error de conexión a la base de datos.';
    exit();
}

// Verificar email
$resVerEmail = verficarEmail($conn, $email);
if ($resVerEmail !== null && $resVerEmail->num_rows > 0) {
    echo 'El email ya se encuentra registrado. <a href="../Paginas/Register.html">Volver</a>';
    cerrarBDConexion($conn);
    exit();
}

// Hashear contraseña
$password_hashed = password_hash($password, PASSWORD_DEFAULT);

// Insertar usuario
$filasAfectadas = agregarUsuario($conn, $nombre, $apellido, $email, $password_hashed, $telefono, $direccion, $path_imagen_bd);

if ($filasAfectadas > 0) {
    // iniciar sesión y redirigir
    crearSesion('email', $email);
} else {
    echo 'Hubo un error al crear la cuenta. <a href="../Paginas/Register.html">Volver</a>';
}

cerrarBDConexion($conn);
?>
