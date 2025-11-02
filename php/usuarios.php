<?php
function obtenerUsuarios($conn) {
    if ($conn) {
        $sql = "SELECT u.*, COUNT(m.id_mascota) as mascotas FROM usuarios u LEFT JOIN mascota m ON u.id_usuario = m.id_dueno GROUP BY u.id_usuario";
        $result = $conn->query($sql);
        return $result;
    }
    return null;
}

function verificarEmail($conn, $email)
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

function actualizarUsuario($conn, $id, $nombre, $apellido, $email, $telefono, $direccion, $img = null) {
    if ($conn) {
        if ($img) {
            $stmt = $conn->prepare("UPDATE usuarios SET nombre = ?, apellido = ?, email = ?, telefono = ?, direccion = ?, img = ? WHERE id_usuario = ?");
            $stmt->bind_param("ssssssi", $nombre, $apellido, $email, $telefono, $direccion, $img, $id);
        } else {
            $stmt = $conn->prepare("UPDATE usuarios SET nombre = ?, apellido = ?, email = ?, telefono = ?, direccion = ? WHERE id_usuario = ?");
            $stmt->bind_param("sssssi", $nombre, $apellido, $email, $telefono, $direccion, $id);
        }
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
