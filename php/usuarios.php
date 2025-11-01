<?php
function obtenerUsuarios($conn) {
    if ($conn) {
        $sql = "SELECT u.*, COUNT(m.id) as mascotas FROM usuarios u LEFT JOIN mascotas m ON u.id = m.id_usuario GROUP BY u.id";
        $result = $conn->query($sql);
        return $result;
    }
    return null;
}
