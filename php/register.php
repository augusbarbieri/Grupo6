<?php
// 1. Incluimos nuestros archivos
include "conexion.php";
include "sesion.php"; // Asumimos que sesion.php está en la misma carpeta

$conn = conectarBDManadas();


// 2. Obtenemos los datos por POST
$nombre = $_POST['nombre'];
$apellido = $_POST['apellido'];
$email = $_POST['email'];
$telefono = $_POST['telefono'];
$direccion = $_POST['direccion'];
$password = $_POST['password'];
$password_r = $_POST['password_r'];

// = = = = = INICIO DE CAMBIOS (Manejo de Archivo) = = = = =

$path_imagen_bd = "uploads/perfiles/default.png"; // Ruta por defecto si no sube imagen

// Verificamos si se envió un archivo y si no hubo errores
if (isset($_FILES["img"]) && $_FILES["img"]["error"] == 0) {

    $directorio_destino = "../uploads/perfiles/"; // Asegúrate que esta carpeta exista y tenga permisos
    $nombre_original = basename($_FILES["img"]["name"]);
    $extension = strtolower(pathinfo($nombre_original, PATHINFO_EXTENSION));

    // Creamos un nombre único para evitar sobreescribir archivos
    $nombre_unico = uniqid() . '.' . $extension;
    $path_completo = $directorio_destino . $nombre_unico;

    // (Aquí podrías agregar validaciones de tamaño y tipo de archivo como en tu upload.php)

    // Movemos el archivo de la carpeta temporal a nuestro destino
    if (move_uploaded_file($_FILES["img"]["tmp_name"], $path_completo)) {
        // Si se subió con éxito, actualizamos la ruta que irá a la BD
        $path_imagen_bd = "uploads/perfiles/" . $nombre_unico;
    } else {
        // Opcional: Manejar error si no se pudo mover el archivo
        echo "Hubo un error al mover la imagen de perfil, pero se creará el usuario con la imagen por defecto.";
    }
}
// = = = = = FIN DE CAMBIOS (Manejo de Archivo) = = = = =


// 3. Validamos la contraseña (sin cambios)
if ($password == $password_r) {

    $conn = conectarBDManadas();
    $resVerEmail = verficarEmail($conn, $email);

    if ($resVerEmail != NULL && $resVerEmail->num_rows == 0) {

        // = = = = = INICIO DE CAMBIO = = = = =
        // 4. Pasamos la $path_imagen_bd (la nueva o la default) a la función
        $filasAfectadas = agregarUsuario($conn, $nombre, $apellido, $email, $password, $telefono, $direccion, $path_imagen_bd);
        // = = = = = FIN DE CAMBIO = = = = =

        if ($filasAfectadas > 0) {
            crearSesion('email', $email);
        } else {
            echo 'Hubo un error al crear la cuenta. <a href="../Paginas/Register.html">Vuelva a intentarlo</a>.<br/>';
        }
    } else {
        echo 'El email ya se encuentra registrado. <a href="../Paginas/Register.html">Vuelva a intentarlo</a>.<br/>';
    }

    cerrarBDConexion($conn);
} else {
    echo 'Las contraseñas no coinciden. <a href="../Paginas/Register.html">Vuelva a intentarlo</a>.<br/>';
}
