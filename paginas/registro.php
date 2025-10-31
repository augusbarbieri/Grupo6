<?php
$basePath = '../';
include_once '../componentes/header.php';
?>

<div class="container my-5">
    <div class="row justify-content-center">
        <div class="col-md-5">

            <form action="../php/register.php" method="POST" enctype="multipart/form-data">
                <div class="card shadow">
                    <div class="card-body p-4">
                        <h3 class="text-center mb-4">Registro</h3>

                        <div class="mb-3">
                            <label for="nombre" class="form-label">Nombre</label>
                            <input type="text" class="form-control" id="nombre" name="nombre" placeholder="Ingresá tu nombre" required>
                        </div>
                        <div class="mb-3">
                            <label for="apellido" class="form-label">Apellido</label>
                            <input type="text" class="form-control" id="apellido" name="apellido" placeholder="Ingresá tu apellido" required>
                        </div>
                        <div class="mb-3">
                            <label for="direccion" class="form-label">Dirección</label>
                            <input type="text" class="form-control" id="direccion" name="direccion" placeholder="Ingresá tu dirección" required>
                        </div>
                        <div class="mb-3">
                            <label for="email" class="form-label">Email</label>
                            <input type="email" class="form-control" id="email" name="email" placeholder="Ingresá tu correo" required>
                        </div>
                        <div class="mb-3">
                            <label for="telefono" class="form-label">Teléfono</label>
                            <input type="tel" class="form-control" id="telefono" name="telefono" placeholder="Ingresá tu teléfono" required>
                        </div>

                        <div class="mb-3">
                            <label for="img" class="form-label">Foto de Perfil (Opcional)</label>
                            <input type="file" class="form-control" id="img" name="img" accept="image/*">
                        </div>

                        <div class="mb-3">
                            <label for="password" class="form-label">Contraseña</label>
                            <input type="password" class="form-control" id="password" name="password" placeholder="Ingresá tu contraseña" required>
                        </div>
                        <div class="mb-3">
                            <label for="confirmar" class="form-label">Confirmar Contraseña</label>
                            <input type="password" class="form-control" id="confirmar" name="password_r" placeholder="Repetí tu contraseña" required>
                        </div>

                        <div class="d-flex flex-column align-items-center">
                            <button type="submit" class="btn btn-primary w-100">Registrarme</button>
                        </div>
                        <p class="text-center mt-3">
                            ¿Ya tenés cuenta? <a href="inicio-sesion.php" class="fw-bold">Iniciar sesión</a>
                        </p>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

<?php include_once '../componentes/footer.php'; ?>
