<?php
// Configuración de carga de archivos
const UPLOAD_MAX_SIZE = 5 * 1024 * 1024; // 5MB
const ALLOWED_TYPES = ['image/jpeg', 'image/png', 'image/gif'];
const UPLOAD_DIR = __DIR__ . '/../uploads/perfiles/';

function subirImagen($file, $oldImage = null)
{
    // Validar que se subió un archivo
    if (!isset($file['tmp_name']) || empty($file['tmp_name'])) {
        return null;
    }

    // Validar tamaño
    if ($file['size'] > UPLOAD_MAX_SIZE) {
        throw new Exception('El archivo es demasiado grande. Máximo 5MB.');
    }

    // Validar tipo
    if (!in_array($file['type'], ALLOWED_TYPES)) {
        throw new Exception('Tipo de archivo no permitido. Solo se permiten JPG, PNG y GIF.');
    }

    // Generar nombre único
    $extension = pathinfo($file['name'], PATHINFO_EXTENSION);
    $newName = uniqid() . '.' . $extension;
    $destination = UPLOAD_DIR . $newName;

    // Mover archivo
    if (!move_uploaded_file($file['tmp_name'], $destination)) {
        throw new Exception('Error al guardar el archivo.');
    }

    // Eliminar imagen anterior si existe
    if ($oldImage && file_exists(UPLOAD_DIR . basename($oldImage)) && basename($oldImage) !== 'default.png') {
        unlink(UPLOAD_DIR . basename($oldImage));
    }

    return 'uploads/perfiles/' . $newName;
}
