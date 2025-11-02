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

function buscar_y_autenticar($conn, $email, $password, $tabla, $id_col, $rol, $redirect_url) {
    $sql = "SELECT * FROM $tabla WHERE email = ? LIMIT 1";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param('s', $email);
    $stmt->execute();
    $res = $stmt->get_result();

    if ($res && $res->num_rows === 1) {
        $row = $res->fetch_assoc();
        if (verificar_password($password, $row['password'])) {
            $id = $row[$id_col] ?? null;
            $name = trim(($row['nombre'] ?? '') . ' ' . ($row['apellido'] ?? '')) ?: null;
            $img = $row['img'] ?? null;
            crearSesion($email, $rol, $id, $name, $img);
            header("Location: $redirect_url");
            exit();
        } else {
            return false; // Contraseña incorrecta
        }
    }
    return null; // Usuario no encontrado en esta tabla
}

// --- Flujo de autenticación ---

// 1) Buscar en tabla admin
$admin_auth = buscar_y_autenticar($conn, $email, $password, 'admin', 'id_admin', 'admin', '../paginas/admin/inicio.php');
if ($admin_auth === true) exit();

// 2) Buscar en tabla paseador
$paseador_auth = buscar_y_autenticar($conn, $email, $password, 'paseador', 'id_paseador', 'paseador', '../paginas/paseador/inicio.php');
if ($paseador_auth === true) exit();

// 3) Buscar en tabla usuarios
$usuario_auth = buscar_y_autenticar($conn, $email, $password, 'usuarios', 'id_usuario', 'usuario', '../paginas/dueno/landingUsuario.php');
if ($usuario_auth === true) exit();

// --- Manejo de errores ---

// Si la contraseña fue incorrecta en alguna tabla
if ($admin_auth === false || $paseador_auth === false || $usuario_auth === false) {
    echo 'Credenciales inválidas. <a href="../paginas/inicio-sesion.php">Volver</a>';
} else {
    // Si no se encontró el email en ninguna tabla
    echo 'Usuario no encontrado. <a href="../paginas/registro.php">Registrarse</a> o <a href="../paginas/inicio-sesion.php">Volver al login</a>';
}

cerrarBDConexion($conn);
