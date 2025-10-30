<?php
require_once 'includes/db.php';

$conn = conectarBDManadas();
if ($conn) {
    echo "<h2>Contenido de la tabla paseador:</h2>";
    $sql = "SELECT id_paseador, nombre, apellido, email FROM paseador";
    $result = $conn->query($sql);

    if ($result) {
        echo "<table border='1'>";
        echo "<tr><th>ID</th><th>Nombre</th><th>Apellido</th><th>Email</th></tr>";
        while ($row = $result->fetch_assoc()) {
            echo "<tr>";
            echo "<td>" . htmlspecialchars($row['id_paseador']) . "</td>";
            echo "<td>" . htmlspecialchars($row['nombre']) . "</td>";
            echo "<td>" . htmlspecialchars($row['apellido']) . "</td>";
            echo "<td>" . htmlspecialchars($row['email']) . "</td>";
            echo "</tr>";
        }
        echo "</table>";

        echo "<p>Total de registros: " . $result->num_rows . "</p>";
    } else {
        echo "Error al consultar la tabla: " . $conn->error;
    }

    // También mostramos la estructura de la tabla
    echo "<h2>Estructura de la tabla paseador:</h2>";
    $result = $conn->query("DESCRIBE paseador");
    if ($result) {
        echo "<table border='1'>";
        echo "<tr><th>Campo</th><th>Tipo</th><th>Nulo</th><th>Llave</th><th>Default</th><th>Extra</th></tr>";
        while ($row = $result->fetch_assoc()) {
            echo "<tr>";
            foreach ($row as $value) {
                echo "<td>" . htmlspecialchars($value ?? 'NULL') . "</td>";
            }
            echo "</tr>";
        }
        echo "</table>";
    }

    cerrarBDConexion($conn);
} else {
    echo "No se pudo conectar a la base de datos";
}
