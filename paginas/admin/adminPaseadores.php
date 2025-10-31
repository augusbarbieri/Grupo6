<?php
$basePath = '../../';
include_once '../../componentes/header.php';
?>

<?php
$basePath = '../../';
require_once '../../php/conexion.php';
require_once '../../php/paseadores.php';

// Conexión a la base de datos
$conn = conectarBDManadas();
$paseadores = obtenerPaseadores($conn);
cerrarBDConexion($conn);
?>

<div class="ms-3 me-3 mt-5">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2 class="mb-0">Listado de Paseadores</h2>
        <a href="adminFormAddPaseador.php" class="btn btn-primary">Agregar Paseador</a>
    </div>
    <div class="table-responsive">
        <table class="table table-striped table-hover">
            <thead class="thead-dark">
                <tr>
                    <th scope="col">ID</th>
                    <th scope="col">Nombre</th>
                    <th scope="col">Apellido</th>
                    <th scope="col">DNI</th>
                    <th scope="col">Email</th>
                    <th scope="col">Teléfono</th>
                </tr>
            </thead>
            <tbody>
                <?php if ($paseadores && $paseadores->num_rows > 0): ?>
                    <?php while($row = $paseadores->fetch_assoc()): ?>
                        <tr>
                            <th scope="row"><?= htmlspecialchars($row['id']) ?></th>
                            <td><?= htmlspecialchars($row['nombre']) ?></td>
                            <td><?= htmlspecialchars($row['apellido']) ?></td>
                            <td><?= htmlspecialchars($row['dni']) ?></td>
                            <td><?= htmlspecialchars($row['mail']) ?></td>
                            <td><?= htmlspecialchars($row['telefono']) ?></td>
                        </tr>
                    <?php endwhile; ?>
                <?php else: ?>
                    <tr>
                        <td colspan="6" class="text-center">No hay paseadores registrados.</td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
</div>

<?php include_once '../../componentes/footer.php'; ?>
