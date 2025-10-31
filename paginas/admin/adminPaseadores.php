<?php
require_once "../../auth/session.php";
require_once "../../php/conexion.php";

$email = controlarSesion();
controlarRol('admin');

$conn = conectarBDManadas();
$sql = "SELECT id_paseador, nombre, apellido, email, telefono FROM paseador";
$result = $conn->query($sql);

$paseadores = [];
if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
        $paseadores[] = $row;
    }
}
cerrarBDConexion($conn);

$basePath = '../../';
include_once '../../componentes/header.php';
?>

<div class="admin-container">
    <div class="admin-header">
        <h1>Listado de Paseadores</h1>
        <a href="adminFormAddPaseador.php" class="btn-primary">Agregar Paseador</a>
    </div>
    <div class="admin-table-container">
        <table class="admin-table">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nombre</th>
                    <th>Apellido</th>
                    <th>Email</th>
                    <th>Telefono</th>
                </tr>
            </thead>
            <tbody>
                <?php if (!empty($paseadores)): ?>
                    <?php foreach ($paseadores as $paseador): ?>
                        <tr>
                            <td><?= htmlspecialchars($paseador['id_paseador']) ?></td>
                            <td><?= htmlspecialchars($paseador['nombre']) ?></td>
                            <td><?= htmlspecialchars($paseador['apellido']) ?></td>
                            <td><?= htmlspecialchars($paseador['email']) ?></td>
                            <td><?= htmlspecialchars($paseador['telefono']) ?></td>
                        </tr>
                    <?php endforeach; ?>
                <?php else: ?>
                    <tr>
                        <td colspan="5">No hay paseadores registrados.</td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
</div>

<?php include_once '../../componentes/footer.php'; ?>
