<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/php/conexion.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/php/paseadores.php';
include_once $_SERVER['DOCUMENT_ROOT'] . '/componentes/header.php';

$conn = conectarBDManadas();
$paseadores = obtenerPaseadores($conn);
cerrarBDConexion($conn);
?>

<main class="container">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2>Listado de Paseadores</h2>
        <a href="adminFormAddPaseador.php" class="btn btn-primary">Agregar Paseador</a>
    </div>
    <table class="table">
        <thead>
            <tr>
                <th>ID</th>
                <th>Nombre</th>
                <th>Apellido</th>
                <th>DNI</th>
                <th>Email</th>
                <th>Teléfono</th>
            </tr>
        </thead>
        <tbody>
            <?php if ($paseadores && $paseadores->num_rows > 0): ?>
                <?php while($row = $paseadores->fetch_assoc()): ?>
                    <tr>
                        <td><?= htmlspecialchars($row['id']) ?></td>
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
</main>

<?php include_once $_SERVER['DOCUMENT_ROOT'] . '/componentes/footer.php'; ?>
