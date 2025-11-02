<?php
require_once __DIR__ . '/../php/config.php';
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Iniciar Sesión - Manadas</title>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <link rel="stylesheet" href="<?php echo BASE_URL; ?>Assets/css/new-style.css?v=<?php echo time(); ?>">
</head>
<body class="login-page">

    <div class="login-container">
        <div class="login-info-panel">
            <div class="login-info-content">
                <h2>Conectando dueños y paseadores de mascotas.</h2>
                <p>Encuentra el paseador perfecto para tu mejor amigo.</p>
            </div>
        </div>

        <div class="login-form-panel">
            <div class="login-form-content">
                <div class="login-logo">
                    <i class="fas fa-paw"></i>
                </div>
                <h3>Inicia Sesión en tu Cuenta</h3>
                <p class="subtitle">Bienvenido de nuevo</p>

                <form action="<?php echo BASE_URL; ?>php/login.php" method="post">
                    <div class="form-group">
                        <label for="email">Email</label>
                        <input type="email" name="email" id="email" placeholder="Ingresá tu email" required>
                    </div>
                    <div class="form-group">
                        <label for="password">Contraseña</label>
                        <input type="password" name="password" id="password" placeholder="Ingresá tu contraseña" required>
                    </div>


                    <button type="submit" class="btn-login">Ingresar</button>
                </form>

                <p class="signup-link">
                    ¿Aún no tienes cuenta? <a href="registro.php">Crea una cuenta</a>
                </p>
            </div>
        </div>
    </div>

</body>
</html>
