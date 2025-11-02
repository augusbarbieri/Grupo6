<?php
function obtenerUsuarios($conn) {
    if ($conn) {
        $sql = "SELECT u.*, COUNT(m.id_mascota) as mascotas FROM usuarios u LEFT JOIN mascota m ON u.id_usuario = m.id_dueno GROUP BY u.id_usuario";
        $result = $conn->query($sql);
        return $result;
    }
    return null;
}

function actualizarUsuario($conn, $id, $nombre, $apellido, $email, $telefono, $direccion) {
    if ($conn) {
        $stmt = $conn->prepare("UPDATE usuarios SET nombre = ?, apellido = ?, email = ?, telefono = ?, direccion = ? WHERE id_usuario = ?");
        $stmt->bind_param("sssssi", $nombre, $apellido, $email, $telefono, $direccion, $id);
        return $stmt->execute();
    }
    return false;
}

function obtenerUsuarioPorId($conn, $id) {
    if ($conn) {
        $stmt = $conn->prepare("SELECT * FROM usuarios WHERE id_usuario = ?");
        $stmt->bind_param("i", $id);
        $stmt->execute();
        $result = $stmt->get_result();
        return $result->fetch_assoc();
    }
    return null;
}
