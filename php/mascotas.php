<?php
require_once __DIR__ . '/conexion.php';

function obtenerMascotasPorDueno($id_dueno) {
    $conexion = conectarBDManadas();
    $sql = "SELECT * FROM mascota WHERE id_dueno = ?";
    $stmt = $conexion->prepare($sql);
    $stmt->bind_param("i", $id_dueno);
    $stmt->execute();
    $resultado = $stmt->get_result();
    $mascotas = $resultado->fetch_all(MYSQLI_ASSOC);
    $stmt->close();
    $conexion->close();
    return $mascotas;
}

function agregarMascota($id_dueno, $nombre, $raza, $tamano, $observaciones, $img) {
    $conexion = conectarBDManadas();
    $nombreImg = '';

    if (isset($img) && $img['error'] === UPLOAD_ERR_OK) {
        $nombreImg = uniqid('mascota_') . '_' . basename($img['name']);
        $rutaDestino = __DIR__ . '/../Assets/img/mascotas/' . $nombreImg;
        move_uploaded_file($img['tmp_name'], $rutaDestino);
    }

    $sql = "INSERT INTO mascota (id_dueno, nombre, raza, tamano, observaciones, img) VALUES (?, ?, ?, ?, ?, ?)";
    $stmt = $conexion->prepare($sql);
    $stmt->bind_param("isssss", $id_dueno, $nombre, $raza, $tamano, $observaciones, $nombreImg);

    $resultado = $stmt->execute();

    $stmt->close();
    $conexion->close();

    return $resultado;
}

function obtenerMascotaPorId($id_mascota) {
    $conexion = conectarBDManadas();
    $sql = "SELECT * FROM mascota WHERE id_mascota = ?";
    $stmt = $conexion->prepare($sql);
    $stmt->bind_param("i", $id_mascota);
    $stmt->execute();
    $resultado = $stmt->get_result();
    $mascota = $resultado->fetch_assoc();
    $stmt->close();
    $conexion->close();
    return $mascota;
}

function actualizarMascota($id_mascota, $nombre, $raza, $tamano, $observaciones, $img) {
    $conexion = conectarBDManadas();
    $mascotaActual = obtenerMascotaPorId($id_mascota);
    $nombreImg = $mascotaActual['img'];

    if (isset($img) && $img['error'] === UPLOAD_ERR_OK) {
        // Eliminar imagen anterior si existe
        if (!empty($nombreImg) && file_exists(__DIR__ . '/../Assets/img/mascotas/' . $nombreImg)) {
            unlink(__DIR__ . '/../Assets/img/mascotas/' . $nombreImg);
        }

        $nombreImg = uniqid('mascota_') . '_' . basename($img['name']);
        $rutaDestino = __DIR__ . '/../Assets/img/mascotas/' . $nombreImg;
        move_uploaded_file($img['tmp_name'], $rutaDestino);
    }

    $sql = "UPDATE mascota SET nombre = ?, raza = ?, tamano = ?, observaciones = ?, img = ? WHERE id_mascota = ?";
    $stmt = $conexion->prepare($sql);
    $stmt->bind_param("sssssi", $nombre, $raza, $tamano, $observaciones, $nombreImg, $id_mascota);

    $resultado = $stmt->execute();

    $stmt->close();
    $conexion->close();

    return $resultado;
}

function eliminarMascota($id_mascota) {
    $conexion = conectarBDManadas();

    // Opcional: eliminar imagen del servidor
    $mascota = obtenerMascotaPorId($id_mascota);
    if ($mascota && !empty($mascota['img'])) {
        $rutaImagen = __DIR__ . '/../Assets/img/mascotas/' . $mascota['img'];
        if (file_exists($rutaImagen)) {
            unlink($rutaImagen);
        }
    }

    $sql = "DELETE FROM mascota WHERE id_mascota = ?";
    $stmt = $conexion->prepare($sql);
    $stmt->bind_param("i", $id_mascota);

    $resultado = $stmt->execute();

    $stmt->close();
    $conexion->close();

    return $resultado;
}
?>