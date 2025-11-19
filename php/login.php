<?php
// Incluir archivos de configuración, conexión y sesión
require_once __DIR__ . '/config.php';
require_once __DIR__ . '/conexion.php';
require_once __DIR__ . '/sesion.php';

// Obtener entradas del formulario
$email = trim($_POST['email'] ?? '');
$password = $_POST['password'] ?? '';

// Validar que los campos no estén vacíos
if ($email === '' || $password === '') {
    // Idealmente, aquí se manejaría un mensaje de error más amigable
    header("Location: " . BASE_URL . "paginas/inicio-sesion.php?error=campos_vacios");
    exit();
}

// Conectar a la base de datos
$conn = conectarBDManadas();
if (!$conn) {
    // Manejar error de conexión
    header("Location: " . BASE_URL . "paginas/inicio-sesion.php?error=db_conexion");
    exit();
}

/**
 * Verifica si una contraseña en texto plano coincide con un hash
 * o con un valor de texto plano (para compatibilidad con sistemas antiguos).
 */
function verificar_password($plain, $stored) {
    return password_verify($plain, $stored) || ($plain === $stored);
}

/**
 * Busca un usuario en una tabla específica y verifica su contraseña.
 * Devuelve los datos del usuario si tiene éxito, o null si falla.
 */
function autenticar_usuario($conn, $email, $password, $tabla, $id_col) {
    $sql = "SELECT * FROM $tabla WHERE email = ? LIMIT 1";
    $stmt = $conn->prepare($sql);
    if (!$stmt) return null;

    $stmt->bind_param('s', $email);
    $stmt->execute();
    $resultado = $stmt->get_result();

    if ($resultado && $resultado->num_rows === 1) {
        $usuario = $resultado->fetch_assoc();
        if (verificar_password($password, $usuario['password'])) {
            return $usuario; // Autenticación exitosa
        }
    }
    return null; // Usuario no encontrado o contraseña incorrecta
}

// --- Flujo de Autenticación Centralizado ---
$usuario_autenticado = null;
$rol = null;
$id_col = null;

// 1. Intentar autenticar como admin
$usuario_autenticado = autenticar_usuario($conn, $email, $password, 'admin', 'id_admin');
if ($usuario_autenticado) {
    $rol = 'admin';
    $id_col = 'id_admin';
} else {
    // 2. Si no es admin, intentar como paseador
    $usuario_autenticado = autenticar_usuario($conn, $email, $password, 'paseador', 'id_paseador');
    if ($usuario_autenticado) {
        $rol = 'paseador';
        $id_col = 'id_paseador';
    } else {
        // 3. Si no, intentar como usuario normal
        $usuario_autenticado = autenticar_usuario($conn, $email, $password, 'usuarios', 'id_usuario');
        if ($usuario_autenticado) {
            $rol = 'usuario';
            $id_col = 'id_usuario';
        }
    }
}

cerrarBDConexion($conn);

// --- Manejo de Sesión y Redirección ---
if ($usuario_autenticado && $rol) {
    // Extraer datos comunes del usuario
    $id_usuario = $usuario_autenticado[$id_col];
    $nombre = trim(($usuario_autenticado['nombre'] ?? '') . ' ' . ($usuario_autenticado['apellido'] ?? ''));
    $img = $usuario_autenticado['img'] ?? null;

    // Crear la sesión sin redirigir
    crearSesion($email, $rol, $id_usuario, $nombre, $img);

    // Redirigir según el rol
    switch ($rol) {
        case 'admin':
            header("Location: " . BASE_URL . "paginas/admin/inicio.php");
            break;
        case 'paseador':
            header("Location: " . BASE_URL . "paginas/paseador/perfilPaseador.php");
            break;
        case 'usuario':
            // Redirección directa a "Mis Mascotas"
            header("Location: " . BASE_URL . "paginas/dueno/perfilUsuarioMisMascotas.php");
            break;
        default:
            // Fallback por si algo sale mal
            header("Location: " . BASE_URL . "paginas/inicio-sesion.php");
            break;
    }
    exit();
} else {
    // Si la autenticación falla, redirigir a la página de login con un error
    header("Location: " . BASE_URL . "paginas/inicio-sesion.php?error=credenciales_invalidas");
    exit();
}
