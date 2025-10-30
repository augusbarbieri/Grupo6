<?php
require_once 'includes/db.php';

$conn = conectarBDManadas();
if ($conn) {
    // Limpiar espacios en blanco de los campos nombre, apellido y email
    $sql = "UPDATE paseador SET 
            nombre = TRIM(nombre),
            apellido = TRIM(apellido),
            email = TRIM(email)";

    if ($conn->query($sql)) {
        echo "Se han limpiado los espacios en blanco de los registros correctamente.";
    } else {
        echo "Error al limpiar los registros: " . $conn->error;
    }

    cerrarBDConexion($conn);
} else {
    echo "No se pudo conectar a la base de datos";
}
