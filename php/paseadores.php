<?php
function obtenerPaseadores($conn) {
    if ($conn) {
        $sql = "SELECT id_paseador, nombre, apellido, email, telefono, estado FROM paseador";
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

function obtenerPaseadorPorId($conn, $id) {
    if ($conn) {
        $stmt = $conn->prepare("SELECT * FROM paseador WHERE id_paseador = ?");
        $stmt->bind_param("i", $id);
        $stmt->execute();
        $result = $stmt->get_result();
        return $result->fetch_assoc();
    }
    return null;
}

function actualizarPaseador($conn, $id, $nombre, $apellido, $email, $telefono) {
    if ($conn) {
        $stmt = $conn->prepare("UPDATE paseador SET nombre = ?, apellido = ?, email = ?, telefono = ? WHERE id_paseador = ?");
        $stmt->bind_param("ssssi", $nombre, $apellido, $email, $telefono, $id);
        return $stmt->execute();
    }
    return false;
}
?>
