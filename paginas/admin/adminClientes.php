<?php
require_once '../../php/conexion.php';
require_once '../../php/usuarios.php';
include_once '../../componentes/header.php';

$conn = conectarBDManadas();
$clientes = obtenerUsuarios($conn);
cerrarBDConexion($conn);
?>

<main class="container">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2>Listado de Clientes</h2>
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
                <th>Mascotas</th>
            </tr>
        </thead>
        <tbody>
            <?php if ($clientes && $clientes->num_rows > 0): ?>
                <?php while($row = $clientes->fetch_assoc()): ?>
                    <tr>
                        <td><?= htmlspecialchars($row['id']) ?></td>
                        <td><?= htmlspecialchars($row['nombre']) ?></td>
                        <td><?= htmlspecialchars($row['apellido']) ?></td>
                        <td><?= htmlspecialchars($row['dni']) ?></td>
                        <td><?= htmlspecialchars($row['email']) ?></td>
                        <td><?= htmlspecialchars($row['telefono']) ?></td>
                        <td><?= htmlspecialchars($row['mascotas']) ?></td>
                    </tr>
                <?php endwhile; ?>
            <?php else: ?>
                <tr>
                    <td colspan="7" class="text-center">No hay clientes registrados.</td>
                </tr>
            <?php endif; ?>
        </tbody>
    </table>
</main>

<?php include_once '../../componentes/footer.php'; ?>
