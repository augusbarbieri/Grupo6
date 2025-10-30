<?php
// Debug de la imagen por defecto
$defaultPath = __DIR__ . '/uploads/perfiles/default.png';
echo "Verificando imagen por defecto:<br>";
echo "Ruta completa: " . $defaultPath . "<br>";
echo "¿Existe?: " . (file_exists($defaultPath) ? 'SÍ' : 'NO') . "<br>";
if (file_exists($defaultPath)) {
    echo "Permisos: " . substr(sprintf('%o', fileperms($defaultPath)), -4) . "<br>";
    echo "Tamaño: " . filesize($defaultPath) . " bytes<br>";
}
