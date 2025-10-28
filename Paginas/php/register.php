<?php
require_once __DIR__ . '/db.php';

function redirectWithMessage(array $params, string $baseUrl = '../Register.html'): void
{
    $query = http_build_query($params);
    header('Location: ' . $baseUrl . ($query ? '?' . $query : ''));
    exit;
}

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    redirectWithMessage(['error' => 'Método de acceso no permitido.']);
}

$nombre = trim($_POST['nombre'] ?? '');
$apellido = trim($_POST['apellido'] ?? '');
$email = trim($_POST['email'] ?? '');
$telefono = trim($_POST['telefono'] ?? '');
$direccion = trim($_POST['direccion'] ?? '');
$password = $_POST['password'] ?? '';
$confirmPassword = $_POST['confirmar_password'] ?? '';

if ($nombre === '' || $apellido === '' || $email === '' || $telefono === '' || $direccion === '' || $password === '' || $confirmPassword === '') {
    redirectWithMessage(['error' => 'Todos los campos son obligatorios.']);
}

if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    redirectWithMessage(['error' => 'El email ingresado no es válido.']);
}

if ($password !== $confirmPassword) {
    redirectWithMessage(['error' => 'Las contraseñas no coinciden.']);
}

try {
    $connection = getDbConnection();
} catch (mysqli_sql_exception $exception) {
    redirectWithMessage(['error' => 'No se pudo conectar a la base de datos.']);
}

try {
    $emailExistsStmt = $connection->prepare('SELECT 1 FROM usuarios WHERE email = ? LIMIT 1');
    $emailExistsStmt->bind_param('s', $email);
    $emailExistsStmt->execute();
    $emailExistsStmt->store_result();

    if ($emailExistsStmt->num_rows > 0) {
        $emailExistsStmt->close();
        redirectWithMessage(['error' => 'El email ingresado ya se encuentra registrado.']);
    }
    $emailExistsStmt->close();

    $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
    $fechaRegistro = date('Y-m-d');
    $imagenPorDefecto = 'https://example.com/default-user.png';

    $insertStmt = $connection->prepare(
        'INSERT INTO usuarios (nombre, apellido, email, password, telefono, direccion, fecha_registro, img) VALUES (?, ?, ?, ?, ?, ?, ?, ?)'
    );
    $insertStmt->bind_param(
        'ssssssss',
        $nombre,
        $apellido,
        $email,
        $hashedPassword,
        $telefono,
        $direccion,
        $fechaRegistro,
        $imagenPorDefecto
    );
    $insertStmt->execute();
    $insertStmt->close();
} catch (mysqli_sql_exception $exception) {
    closeDbConnection($connection ?? null);
    redirectWithMessage(['error' => 'Ocurrió un error al registrar el usuario.']);
}

closeDbConnection($connection ?? null);
redirectWithMessage(['registered' => 'Registro exitoso. Ya podés iniciar sesión.'], '../login.html');
