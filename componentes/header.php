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
    // 'dueno' es la carpeta en español para los usuarios/propietarios
    $homeLink = $basePath . 'paginas/dueno/inicio.php';
    $menuItems = [
        ['text' => 'Mis Mascotas', 'link' => $basePath . 'paginas/dueno/mascotas.php'],
        ['text' => 'Mi Perfil', 'link' => $basePath . 'paginas/dueno/perfil.php']
    ];
}
?>

<!-- HEADER dinámico -->
<header class="site-header mb-auto w-100">
    <nav class="navbar navbar-expand-lg navbar-dark">
        <div class="container">
            <a class="navbar-brand site-title d-flex align-items-center" href="<?= $homeLink ?>">
                <img src="<?= $basePath ?>Assets/img/logo.png" alt="Logo" class="site-logo me-2" style="height:50px;">
                <span>Manadas</span>
            </a>

            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarMain" aria-controls="navbarMain" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarMain">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <?php foreach ($menuItems as $item): ?>
                        <li class="nav-item">
                            <a class="nav-link" href="<?= $item['link'] ?>"><?= htmlspecialchars($item['text']) ?></a>
                        </li>
                    <?php endforeach; ?>
                </ul>

                <div class="d-flex align-items-center">
                    <div class="dropdown">
                        <a href="#" class="d-block link-light text-decoration-none dropdown-toggle" id="dropdownUser" data-bs-toggle="dropdown" aria-expanded="false">
                            <img src="<?= htmlspecialchars($displayImg) ?>" alt="Avatar"
                                class="rounded-circle me-2" style="width:40px;height:40px;object-fit:cover;">
                            <?= htmlspecialchars($displayName) ?>
                        </a>
                        <ul class="dropdown-menu dropdown-menu-end text-small" aria-labelledby="dropdownUser">
                            <li><p class="dropdown-item-text mb-0"><small>Logueado como:</small><br><strong><?= strtoupper(htmlspecialchars($role)) ?></strong></p></li>
                            <li><hr class="dropdown-divider"></li>
                            <li><a class="dropdown-item" href="<?= $basePath ?>auth/logout.php">Cerrar sesión</a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </nav>
</header>