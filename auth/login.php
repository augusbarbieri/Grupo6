<?php
require_once "db.php"; // Ahora apunta al archivo local que redirige a conexion.php
require_once "session.php";

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

function verificar_password($plain, $stored)
{
    return password_verify($plain, $stored) || $plain === $stored;
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
        $id = $row['id_admin'] ?? null;
        $name = trim(($row['nombre'] ?? '') . ' ' . ($row['apellido'] ?? '')) ?: null;
        crearSesion('email', $email, 'admin', $id, $name, null);
    } else {
        echo 'Credenciales inválidas. <a href="../paginas/inicio-sesion.html">Volver</a>';
        exit();
    }
}

// 2) Buscar en tabla paseador
$sql = "SELECT * FROM paseador WHERE TRIM(email) = TRIM(?) LIMIT 1";
$stmt = $conn->prepare($sql);
$stmt->bind_param('s', $email);
$stmt->execute();
$res = $stmt->get_result();

// Debug: mostrar búsqueda en tabla paseador
echo "Buscando paseador con email: " . htmlspecialchars($email) . "<br>";
if (!$res) {
    echo "Error en la consulta de paseador<br>";
} else {
    echo "Encontradas " . $res->num_rows . " filas en tabla paseador<br>";
    if ($res->num_rows === 1) {
        $row = $res->fetch_assoc(); // Guardamos el resultado una sola vez
        echo "Password almacenada: " . htmlspecialchars($row['password']) . "<br>";
        echo "Verificación de password: " . (verificar_password($password, $row['password']) ? "OK" : "FALLO") . "<br>";

        if (verificar_password($password, $row['password'])) {
            // Usamos los datos del $row que ya tenemos
            $id = $row['id_paseador'] ?? null;
            $name = trim(($row['nombre'] ?? '') . ' ' . ($row['apellido'] ?? ''));
            $img = $row['img'] ?? null;

            // Debug: mostrar los datos que vamos a usar para la sesión
            echo "Debug - Datos de sesión:<br>";
            echo "ID: " . ($id ?? 'null') . "<br>";
            echo "Name: " . ($name ?? 'null') . "<br>";
            echo "Image: " . ($img ?? 'null') . "<br>";

            crearSesion('email', $email, 'paseador', $id, $name, $img);
            exit();
        }
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

cerrarBDConexion($conn);
echo 'Usuario no encontrado. <a href="../paginas/registro.html">Registrarse</a> o <a href="../paginas/inicio-sesion.html">Volver al login</a>';
