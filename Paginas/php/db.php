<?php
// Funciones de conexión a la base de datos `manadas`.
// Se utiliza MySQLi con reportes de error mediante excepciones para simplificar el manejo de errores.

define('DB_HOST', 'localhost');
define('DB_USER', 'root');
define('DB_PASS', '');
define('DB_NAME', 'manadas');

/**
 * Obtiene una conexión a la base de datos `manadas`.
 *
 * @throws mysqli_sql_exception si la conexión falla.
 */
function getDbConnection(): mysqli
{
    mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);
    $connection = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);
    $connection->set_charset('utf8mb4');

    return $connection;
}

/**
 * Cierra la conexión recibida.
 */
function closeDbConnection(?mysqli $connection): void
{
    if ($connection instanceof mysqli) {
        $connection->close();
    }
}
