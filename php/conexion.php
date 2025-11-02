<?php
function conectarBDManadas()
{
    $host = "127.0.0.1";
    $user = "root";
    $pass = "";
    $db = "manadas";

    try {
        $conn = new mysqli($host, $user, $pass, $db);
        if ($conn->connect_error) {
            throw new Exception("Connection failed: " . $conn->connect_error);
        }
        return $conn;
    } catch (Exception $e) {
        // En un entorno de producción, registrar el error en lugar de mostrarlo
        error_log("Error de conexión a la base de datos: " . $e->getMessage());
        // Devolver null o manejar el error de una manera que no exponga detalles sensibles
        return null;
    }
}

function cerrarBDConexion($conn)
{
    if ($conn) {
        $conn->close();
    }
}
