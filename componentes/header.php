<?php
// Header include para landings. La página que incluye debe definir $basePath
if (!isset($basePath)) {
    $basePath = '../'; // por defecto, un nivel arriba
}

// Valores básicos desde sesión
$email = $_SESSION['email'] ?? '';
$role = isset($_SESSION['role']) ? strtolower($_SESSION['role']) : '';

// Datos a mostrar en header
$displayName = $_SESSION['user_name'] ?? null;
$displayImg = $_SESSION['user_img'] ?? null;

// Si no tenemos nombre o img en sesión, consultamos la BD
$userId = $_SESSION['user_id'] ?? null;
if (($displayName === null || $displayImg === null) && $userId !== null) {
    include_once __DIR__ . '/db.php';
    $conn = conectarBDManadas();
    if ($conn) {
        if ($role === 'paseador') {
            $sql = 'SELECT nombre, apellido, img FROM paseador WHERE id_paseador = ? LIMIT 1';
            $stmt = $conn->prepare($sql);
            $stmt->bind_param('i', $userId);
            $stmt->execute();
            $res = $stmt->get_result();
            if ($res && $row = $res->fetch_assoc()) {
                if ($displayName === null) {
                    $displayName = trim(($row['nombre'] ?? '') . ' ' . ($row['apellido'] ?? '')) ?: $email;
                }
                if ($displayImg === null) {
                    $displayImg = $row['img'] ?? null;
                }
            }
        } elseif ($role === 'admin') {
            $sql = 'SELECT nombre, apellido FROM admin WHERE id_admin = ? LIMIT 1';
            $stmt = $conn->prepare($sql);
            $stmt->bind_param('i', $userId);
            $stmt->execute();
            $res = $stmt->get_result();
            if ($res && $row = $res->fetch_assoc()) {
                if ($displayName === null) {
                    $displayName = trim(($row['nombre'] ?? '') . ' ' . ($row['apellido'] ?? '')) ?: $email;
                }
            }
        } else {
            $sql = 'SELECT nombre, apellido, img FROM usuarios WHERE id_usuario = ? LIMIT 1';
            $stmt = $conn->prepare($sql);
            $stmt->bind_param('i', $userId);
            $stmt->execute();
            $res = $stmt->get_result();
            if ($res && $row = $res->fetch_assoc()) {
                if ($displayName === null) {
                    $displayName = trim(($row['nombre'] ?? '') . ' ' . ($row['apellido'] ?? '')) ?: $email;
                }
                if ($displayImg === null) {
                    $displayImg = $row['img'] ?? null;
                }
            }
        }
        cerrarBDConexion($conn);
    }
}

// Fallbacks
if (empty($displayName)) {
    $displayName = $email ?: 'Usuario';
}
if (empty($displayImg)) {
    // Use repository-correct casing for Assets folder to avoid case-sensitivity issues on Linux
    $displayImg = $basePath . 'Assets/img/default.png';
}

// Debug
error_log("Base Path: " . $basePath);
error_log("Display Image Path: " . $displayImg);

// Links según rol
$homeLink = '';
$menuItems = [];
if ($role === 'admin') {
    // Rutas hacia las páginas estandarizadas dentro de /paginas/
    $homeLink = $basePath . 'paginas/admin/inicio.php';
    $menuItems = [
        ['text' => 'Paseadores', 'link' => $basePath . 'paginas/admin/paseadores.php'],
        ['text' => 'Clientes', 'link' => $basePath . 'paginas/admin/clientes.php']
    ];
} elseif ($role === 'paseador') {
    $homeLink = $basePath . 'paginas/paseador/inicio.php';
    $menuItems = [
        ['text' => 'Mis Paseos', 'link' => $basePath . 'paginas/paseador/paseos.php'],
        ['text' => 'Mi Perfil', 'link' => $basePath . 'paginas/paseador/perfil.php']
    ];
} else {
    // Carpeta 'usuarios' para dueños de mascotas
    $homeLink = $basePath . 'paginas/usuarios/inicio.php';
    $menuItems = [
        ['text' => 'Mis Mascotas', 'link' => $basePath . 'paginas/usuarios/mascotas.php'],
        ['text' => 'Mi Perfil', 'link' => $basePath . 'paginas/usuarios/perfil.php']
    ];
}
?>

<!-- HEADER dinámico -->
<header class="mb-auto w-100 bg-primary text-white">
    <nav class="navbar navbar-expand-lg navbar-dark bg-primary">
        <div class="container-fluid">
            <a class="navbar-brand d-flex align-items-center" href="<?= $homeLink ?>">
                <img src="<?= $basePath ?>Assets/img/logo.png" alt="Logo" class="site-logo me-2" style="height:40px;">
                <span>Manadas</span>
            </a>

            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarMain">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarMain">
                <ul class="navbar-nav me-auto">
                    <?php foreach ($menuItems as $item): ?>
                        <li class="nav-item">
                            <a class="nav-link text-white" href="<?= $item['link'] ?>"><?= htmlspecialchars($item['text']) ?></a>
                        </li>
                    <?php endforeach; ?>
                </ul>

                <ul class="navbar-nav">
                    <li class="nav-item d-flex align-items-center me-3">
                        <img src="<?= htmlspecialchars($displayImg) ?>" alt="Avatar"
                            class="rounded-circle me-2" style="width:40px;height:40px;object-fit:cover;">
                        <div class="d-flex flex-column">
                            <span class="nav-link text-white p-0"><?= htmlspecialchars($displayName) ?></span>
                            <small class="text-white-50"><?= strtoupper(htmlspecialchars($role)) ?></small>
                        </div>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link fw-bold text-white" href="<?= $basePath ?>auth/logout.php">Cerrar sesión</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
</header>