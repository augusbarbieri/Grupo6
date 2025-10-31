<?php
require_once "../../auth/session.php";
require_once "../../php/conexion.php"; // Incluir el archivo de conexión

$email = controlarSesion();
controlarRol('admin');

$conn = conectarBDManadas(); // Conectar a la base de datos

// Contar paseadores
$sql_paseadores = "SELECT COUNT(*) as total_paseadores FROM paseador";
$result_paseadores = $conn->query($sql_paseadores);
$total_paseadores = ($result_paseadores && $result_paseadores->num_rows > 0) ? $result_paseadores->fetch_assoc()['total_paseadores'] : 0;

// Contar clientes (usuarios)
$sql_clientes = "SELECT COUNT(*) as total_clientes FROM usuarios";
$result_clientes = $conn->query($sql_clientes);
$total_clientes = ($result_clientes && $result_clientes->num_rows > 0) ? $result_clientes->fetch_assoc()['total_clientes'] : 0;

cerrarBDConexion($conn); // Cerrar la conexión

$basePath = '../../';
include "../../componentes/header.php";
?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Panel de Administración - Manadas</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="../../assets/css/style.css">
</head>

<body>
    <main class="admin-dashboard">
        <section class="hero">
            <div class="hero-text">
                <h1>Bienvenido al Panel de Administración</h1>
                <p>Gestiona paseadores y clientes de forma centralizada.</p>
                <a href="#dashboard-cards" class="btn-get-started">Empezar ahora</a>
            </div>
        </section>

        <section id="dashboard-cards" class="dashboard-cards">
            <div class="card">
                <h2>Paseadores</h2>
                <p>Total de paseadores registrados.</p>
                <div class="card-count"><?= $total_paseadores ?></div>
                <a href="adminPaseadores.php" class="btn-card">Gestionar Paseadores</a>
            </div>
            <div class="card">
                <h2>Clientes</h2>
                <p>Total de clientes registrados.</p>
                <div class="card-count"><?= $total_clientes ?></div>
                <a href="adminClientes.php" class="btn-card">Gestionar Clientes</a>
            </div>
        </section>
    </main>
</body>

</html>