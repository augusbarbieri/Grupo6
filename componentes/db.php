<?php
// --- CONEXIÓN (sin cambios) ---
const nombreServidor = "localhost";
const nombreUsuario = "root";
const passwordBaseDeDatos = "";
const nombreBaseDeDatos = "manadas";

function conectarBDManadas()
{
    $host = "localhost";
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
        echo "Error de conexión: " . $e->getMessage();
        return null;
    }
}

function cerrarBDConexion($conn)
{
    if ($conn) {
        $conn->close();
    }
}

// --- QUERIES (Consultas) ---
function verficarEmail($conn, $email)
{
    if ($conn) {
        $sql = "SELECT * FROM usuarios WHERE email = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("s", $email);
        $stmt->execute();
        return $stmt->get_result();
    }
    return null;
}

function agregarUsuario($conn, $nombre, $apellido, $email, $password, $telefono, $direccion, $path_img)
{
    if ($conn) {
        $sql = "INSERT INTO usuarios (nombre, apellido, email, password, telefono, direccion, img, fecha_registro) VALUES (?, ?, ?, ?, ?, ?, ?, NOW())";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("sssssss", $nombre, $apellido, $email, $password, $telefono, $direccion, $path_img);
        $stmt->execute();
        return $stmt->affected_rows;
    }
    return 0;
}
