<?php
// Login handler: valida credenciales en admin, paseador o usuarios
include "conexion.php";
include "sesion.php"; // session_start() está aquí

// Obtener entradas
$email = trim($_POST['email'] ?? '');
$password = $_POST['password'] ?? '';

if ($email === '' || $password === '') {
    echo 'Faltan campos. <a href="../paginas/inicio-sesion.html">Volver al login</a>';
    exit();
}

$conn = conectarBDManadas();
if (!$conn) {
    echo 'Error de conexión a la base de datos.';
    exit();
}

// Helper para verificar contraseña (soporta hashes y texto plano heredado)
function verificar_password($plain, $stored)
{
    if (password_verify($plain, $stored)) {
        return true;
    }
    // fallback: comparar texto simple (base de datos legacy)
    if ($plain === $stored) {
        return true;
    }
    return false;
}

// 1) Buscar en tabla admin
$sql = "SELECT * FROM admin WHERE email = ? LIMIT 1";
$stmt = $conn->prepare($sql);
$stmt->bind_param('s', $email);
$stmt->execute();
$res = $stmt->get_result();
if ($res && $res->num_rows === 1) {
    $row = $res->fetch_assoc();
    if (verificar_password($password, $row['password'])) {
        // crear sesión y redirigir a Admin
        $id = $row['id_admin'] ?? null;
        $name = trim(($row['nombre'] ?? '') . ' ' . ($row['apellido'] ?? '')) ?: null;
        // admin table doesn't have img in dump; pass null
        crearSesion('email', $email, 'admin', $id, $name, null);
    } else {
        echo 'Credenciales inválidas. <a href="../paginas/inicio-sesion.html">Volver</a>';
        exit();
    }
}

// 2) Buscar en tabla paseador
$sql = "SELECT * FROM paseador WHERE email = ? LIMIT 1";
$stmt = $conn->prepare($sql);
$stmt->bind_param('s', $email);
$stmt->execute();
$res = $stmt->get_result();
if ($res && $res->num_rows === 1) {
    $row = $res->fetch_assoc();
    if (verificar_password($password, $row['password'])) {
        $id = $row['id_paseador'] ?? null;
        $name = trim(($row['nombre'] ?? '') . ' ' . ($row['apellido'] ?? '')) ?: null;
        $img = $row['img'] ?? null;
        crearSesion('email', $email, 'paseador', $id, $name, $img);
    } else {
        echo 'Credenciales inválidas. <a href="../paginas/inicio-sesion.html">Volver</a>';
        exit();
    }
}

// 3) Buscar en tabla usuarios
$sql = "SELECT * FROM usuarios WHERE email = ? LIMIT 1";
$stmt = $conn->prepare($sql);
$stmt->bind_param('s', $email);
$stmt->execute();
$res = $stmt->get_result();
if ($res && $res->num_rows === 1) {
    $row = $res->fetch_assoc();
    if (verificar_password($password, $row['password'])) {
        $id = $row['id_usuario'] ?? null;
        $name = trim(($row['nombre'] ?? '') . ' ' . ($row['apellido'] ?? '')) ?: null;
        $img = $row['img'] ?? null;
        crearSesion('email', $email, 'usuario', $id, $name, $img);
    } else {
        echo 'Credenciales inválidas. <a href="../paginas/inicio-sesion.html">Volver</a>';
        exit();
    }
}

// Si llegamos acá, no se encontró el email en ninguna tabla
echo 'Usuario no encontrado. <a href="../paginas/registro.html">Registrarse</a> o <a href="../paginas/inicio-sesion.html">Volver al login</a>';
cerrarBDConexion($conn);
