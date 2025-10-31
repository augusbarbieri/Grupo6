<?php
$basePath = '../';
include_once '../componentes/header.php';
?>

<div class="login-container">
    <div class="login-card">
        <h3 class="text-center mb-4">Login</h3>
        <!-- FORM de login integrado (un solo formulario para los 3 roles) -->
        <form action="../php/login.php" method="post" class="w-100">
            <div class="mb-3">
                <label for="email" class="form-label">Email</label>
                <input type="email" name="email" class="form-control" id="email" placeholder="Ingresá tu email" required>
            </div>

            <div class="mb-3">
                <label for="password" class="form-label">Contraseña</label>
                <input type="password" name="password" class="form-control" id="password" placeholder="Ingresá tu contraseña" required>
            </div>

            <div class="d-flex flex-column align-items-center">
                <button type="submit" class="btn btn-primary mb-2 w-100">Ingresar</button>
            </div>

            <p class="text-center mt-3">
                ¿No tenés cuenta? <a href="registro.php" class="fw-bold">Registrarse</a>
            </p>
        </form>
    </div>
</div>

<?php include_once '../componentes/footer.php'; ?>
