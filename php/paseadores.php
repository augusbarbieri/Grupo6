<?php
function obtenerPaseadores($conn) {
    if ($conn) {
        $sql = "SELECT id_paseador, nombre, apellido, dni, mail, telefono FROM paseador";
        $result = $conn->query($sql);
        return $result;
    }
    return null;
}
?>