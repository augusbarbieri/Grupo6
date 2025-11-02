<?php
function obtenerPaseadores($conn) {
    if ($conn) {
        $sql = "SELECT id_paseador, nombre, apellido, email, telefono FROM paseador";
        $result = $conn->query($sql);
        return $result;
    }
    return null;
}

function agregarPaseador($conn, $nombre, $apellido, $email, $telefono) {
    if ($conn) {
        $sql = "INSERT INTO paseador (nombre, apellido, email, telefono) VALUES (?, ?, ?, ?)";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("ssss", $nombre, $apellido, $email, $telefono);
        return $stmt->execute();
    }
    return false;
}
?>
