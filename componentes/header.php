<?php
// Incluir el archivo de sesión, que ya se encarga de iniciar la sesión
require_once __DIR__ . '/../php/sesion.php';

// The BASE_URL is now expected to be defined before this header is included.
// Typically by including 'php/config.php' at the beginning of a script.

$role = isset($_SESSION['role']) ? strtolower($_SESSION['role']) : '';
$isLoggedIn = isset($_SESSION['user_id']);

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
