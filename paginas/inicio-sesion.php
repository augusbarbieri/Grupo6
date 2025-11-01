<?php
require_once __DIR__ . '/../php/config.php'; // Defines BASE_URL
include_once __DIR__ . '/../componentes/header.php';
?>

<div class="form-container">
    <div class="form-card">
        <h3>Login</h3>
        <form action="<?php echo BASE_URL; ?>php/login.php" method="post">
            <div class="mb-3">
                <label for="email" class="form-label">Email</label>
                <input type="email" name="email" class="form-control" id="email" placeholder="Ingresá tu email" required>
            </div>
            <div class="mb-3">
                <label for="password" class="form-label">Contraseña</label>
                <input type="password" name="password" class="form-control" id="password" placeholder="Ingresá tu contraseña" required>
            </div>
            <button type="submit" class="btn btn-primary w-100">Ingresar</button>
            <p class="text-center mt-3">
                ¿No tenés cuenta? <a href="registro.php">Registrarse</a>
            </p>
        </form>
    </div>
</div>

<?php include_once __DIR__ . '/../componentes/footer.php'; ?>
