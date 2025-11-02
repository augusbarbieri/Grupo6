<?php
require_once "../../php/config.php"; // Defines BASE_URL
require_once "../../php/sesion.php";
require_once "../../php/conexion.php";

// Proteger la página para administradores
require_login();
if (get_user_role() !== 'admin') {
    header("Location: " . BASE_URL . "paginas/inicio-sesion.php?error=unauthorized");
    exit();
}

$conn = conectarBDManadas();

// Contar paseadores
$sql_paseadores = "SELECT COUNT(*) as total_paseadores FROM paseador";
$result_paseadores = $conn->query($sql_paseadores);
$total_paseadores = ($result_paseadores && $result_paseadores->num_rows > 0) ? $result_paseadores->fetch_assoc()['total_paseadores'] : 0;

// Contar clientes (usuarios)
$sql_clientes = "SELECT COUNT(*) as total_clientes FROM usuarios";
$result_clientes = $conn->query($sql_clientes);
$total_clientes = ($result_clientes && $result_clientes->num_rows > 0) ? $result_clientes->fetch_assoc()['total_clientes'] : 0;

cerrarBDConexion($conn);

include "../../componentes/header.php";
?>

<main class="container">
    <section class="hero">
        <h1>Bienvenido al Panel de Administración</h1>
        <p>Gestiona paseadores y clientes de forma centralizada.</p>
        <a href="#dashboard-cards" class="btn">Empezar ahora</a>
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

<?php include_once '../../componentes/footer.php'; ?>
