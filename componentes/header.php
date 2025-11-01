<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
require_once $_SERVER['DOCUMENT_ROOT'] . '/php/config.php';

$role = isset($_SESSION['role']) ? strtolower($_SESSION['role']) : '';
$isLoggedIn = isset($_SESSION['user_id']);

$homeLink = BASE_URL;
$loginLink = BASE_URL . 'paginas/inicio-sesion.php';
$registerLink = BASE_URL . 'paginas/registro.php';
$logoutLink = BASE_URL . 'php/logout.php';

$menuItems = [];
if ($isLoggedIn) {
    if ($role === 'admin') {
        $homeLink = BASE_URL . 'paginas/admin/inicio.php';
        $menuItems = [
            ['text' => 'Paseadores', 'link' => BASE_URL . 'paginas/admin/adminPaseadores.php'],
            ['text' => 'Clientes', 'link' => BASE_URL . 'paginas/admin/adminClientes.php'],
        ];
    } elseif ($role === 'paseador') {
        $homeLink = BASE_URL . 'paginas/paseador/inicio.php';
        $menuItems = [
            ['text' => 'Mis Paseos', 'link' => BASE_URL . 'paginas/paseador/misPaseosPaseador.php'],
            ['text' => 'Mi Perfil', 'link' => BASE_URL . 'paginas/paseador/perfilPaseador.php'],
        ];
    } else { // 'dueno' or 'usuario'
        $homeLink = BASE_URL . 'paginas/dueno/inicio.php';
        $menuItems = [
            ['text' => 'Mis Manadas', 'link' => BASE_URL . 'paginas/dueno/perfilUsuarioMisManadas.php'],
            ['text' => 'Mis Mascotas', 'link' => BASE_URL . 'paginas/dueno/perfilUsuarioMisMascotas.php'],
            ['text' => 'Mi Perfil', 'link' => BASE_URL . 'paginas/dueno/perfilUsuario.php'],
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
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500;700&display=swap">
    <link rel="stylesheet" href="<?= BASE_URL ?>Assets/css/new-style.css?v=<?= time(); ?>">
</head>
<body>
    <header class="main-header">
        <a href="<?= $homeLink ?>" class="logo">Manadas</a>
        <nav class="main-nav">
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
