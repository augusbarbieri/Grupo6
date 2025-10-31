<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

$basePath = isset($basePath) ? $basePath : '../';
$role = isset($_SESSION['role']) ? strtolower($_SESSION['role']) : '';
$isLoggedIn = isset($_SESSION['user_id']);

$homeLink = $basePath . 'index.php';
$loginLink = $basePath . 'auth/login.php';
$registerLink = $basePath . 'paginas/registro.php';
$logoutLink = $basePath . 'auth/logout.php';

$menuItems = [];
if ($isLoggedIn) {
    if ($role === 'admin') {
        $homeLink = $basePath . 'paginas/admin/inicio.php';
        $menuItems = [
            ['text' => 'Paseadores', 'link' => $basePath . 'paginas/admin/adminPaseadores.php'],
            ['text' => 'Clientes', 'link' => $basePath . 'paginas/admin/adminClientes.php'],
        ];
    } elseif ($role === 'paseador') {
        $homeLink = $basePath . 'paginas/paseador/inicio.php';
        $menuItems = [
            ['text' => 'Mis Paseos', 'link' => $basePath . 'paginas/paseador/paseos.php'],
            ['text' => 'Mi Perfil', 'link' => $basePath . 'paginas/paseador/perfil.php'],
        ];
    } else {
        $homeLink = $basePath . 'paginas/dueno/inicio.php';
        $menuItems = [
            ['text' => 'Mis Manadas', 'link' => $basePath . 'paginas/dueno/perfilUsuarioMisManadas.php'],
            ['text' => 'Mis Mascotas', 'link' => $basePath . 'paginas/dueno/perfilUsuarioMisMascotas.php'],
            ['text' => 'Mi Perfil', 'link' => $basePath . 'paginas/dueno/perfilUsuario.php'],
        ];
    }
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manadas</title>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;700&display=swap">
    <link rel="stylesheet" href="<?= $basePath ?>Assets/css/new-style.css">
</head>
<body>
    <header class="header">
        <a href="<?= $homeLink ?>" class="logo">Manadas</a>
        <nav class="nav">
            <?php if ($isLoggedIn): ?>
                <?php foreach ($menuItems as $item): ?>
                    <a href="<?= $item['link'] ?>"><?= htmlspecialchars($item['text']) ?></a>
                <?php endforeach; ?>
                <a href="<?= $logoutLink ?>">Cerrar sesión</a>
            <?php else: ?>
                <a href="<?= $loginLink ?>">Login</a>
                <a href="<?= $registerLink ?>">Registro</a>
            <?php endif; ?>
        </nav>
    </header>
    <div class="container">
