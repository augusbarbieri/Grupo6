<?php
require_once "db.php";
require_once "session.php";

// Validar que el método sea POST
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    http_response_code(405); // Method Not Allowed
    echo 'Método no permitido.';
    exit();
}

// Sanitizar y validar entrantes
$email = trim($_POST['email'] ?? '');
$password = $_POST['password'] ?? '';

if (empty($email) || empty($password)) {
    // Redirección con mensaje de error
    header("Location: ../paginas/inicio-sesion.html?error=campos_vacios");
    exit();
}

$conn = conectarBDManadas();
if (!$conn) {
    // Es mejor no dar detalles del error de BD al usuario final
    header("Location: ../paginas/inicio-sesion.html?error=interno");
    exit();
}

// Búsqueda unificada de usuarios en las tres tablas
$sql = "
    (SELECT id_admin AS id, email, password, nombre, apellido, NULL AS img, 'admin' AS role FROM admin WHERE email = ?)
    UNION ALL
    (SELECT id_paseador AS id, email, password, nombre, apellido, img, 'paseador' AS role FROM paseador WHERE email = ?)
    UNION ALL
    (SELECT id_usuario AS id, email, password, nombre, apellido, img, 'usuario' AS role FROM usuarios WHERE email = ?)
    LIMIT 1
";

$stmt = $conn->prepare($sql);
// Vincular el mismo email a los tres placeholders
$stmt->bind_param('sss', $email, $email, $email);
$stmt->execute();
$res = $stmt->get_result();

if ($res && $res->num_rows === 1) {
    $row = $res->fetch_assoc();

    // Usar password_verify para comparar contraseñas hasheadas
    if (password_verify($password, $row['password'])) {
        $id = $row['id'];
        $name = trim(($row['nombre'] ?? '') . ' ' . ($row['apellido'] ?? ''));
        $img = $row['img'] ?? null;
        $role = $row['role'];

        // Crear la sesión y redirigir
        crearSesion('email', $email, $role, $id, $name, $img);

        // Redirección post-login según el rol
        $redirect_url = '../paginas/inicio-sesion.html?error=rol_desconocido'; // Fallback
        if ($role === 'admin') {
            $redirect_url = '../paginas/admin/inicio.php';
        } elseif ($role === 'paseador') {
            $redirect_url = '../paginas/paseador/inicio.php';
        } elseif ($role === 'usuario') {
            $redirect_url = '../paginas/usuarios/inicio.php';
        }
        header("Location: " . $redirect_url);
        exit();
    }
}

// Si las credenciales son inválidas o el usuario no existe
cerrarBDConexion($conn);
header("Location: ../paginas/inicio-sesion.html?error=credenciales_invalidas");
exit();
