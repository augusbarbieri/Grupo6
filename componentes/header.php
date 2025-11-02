<?php
// Incluir lógica de sesión de forma centralizada.
// Esto asegura que session_start() se llame y las funciones auxiliares estén disponibles.
require_once __DIR__ . '/../php/sesion.php';

// BASE_URL debe estar definido antes de incluir este header.
// Se espera que 'php/config.php' se incluya en la página principal.

$isLoggedIn = is_logged_in();
$role = get_user_role();

$homeLink = BASE_URL . 'index.php';
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
    } else { // 'usuario'
        $homeLink = BASE_URL . 'paginas/dueno/landingUsuario.php';
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
    <link rel="stylesheet" href="<?php echo BASE_URL; ?>Assets/css/new-style.css?v=<?php echo time(); ?>">
</head>
<body>
    <header class="main-header">
        <a href="<?php echo $homeLink; ?>" class="logo">Manadas</a>
        <nav class="main-nav">
            <?php if ($isLoggedIn): ?>
                <?php foreach ($menuItems as $item): ?>
                    <a href="<?php echo $item['link']; ?>"><?php echo htmlspecialchars($item['text']); ?></a>
                <?php endforeach; ?>
            <?php endif; ?>
        </nav>
        <div class="header-actions">
            <?php if ($isLoggedIn): ?>
                <a href="<?php echo $logoutLink; ?>" class="btn-action">Cerrar sesión</a>
            <?php else: ?>
                <a href="<?php echo $loginLink; ?>">Login</a>
                <a href="<?php echo $registerLink; ?>" class="btn-action">Registro</a>
            <?php endif; ?>
        </div>
    </header>
