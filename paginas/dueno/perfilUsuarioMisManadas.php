<?php
$basePath = '../../';
include_once '../../componentes/header.php';
?>

<!-- Contenido principal -->
<main class="container my-5">

    <!-- Mascota principal -->
    <section class="hero text-center text-white bg-dark py-5">
        <div class="container">
            <img src="../../Assets/img/BorderCollie.jfif" alt="Foto de mi mascota" class="img-fluid rounded-circle border mb-3" style="width: 150px; height: 150px; object-fit: cover;">
            <h2>🐾 Rocco 🐾</h2>
        </div>
    </section>

    <!-- Resumen de paseos -->
    <section class="text-center mb-5">
        <h3 class="text-primary">Paseos programados</h3>
        <p class="fs-4 fw-bold">Rocco tiene <span class="text-success">3 paseos</span> esta semana 🐕</p>
    </section>

    <!-- Listado de paseos -->
    <section>
        <h4 class="mb-4 text-primary">Detalles de los Paseos</h4>
        <div class="row g-4">
            <!-- Paseo 1 -->
            <div class="col-md-4">
                <div class="card shadow d-flex flex-row align-items-center p-2">
                    <!-- Info -->
                    <div class="flex-grow-1">
                        <h5 class="card-title">Martes 10/09 - 10:00hs</h5>
                        <p class="card-text">Paseador: <strong>Kavu</strong></p>
                        <span class="badge bg-success">Confirmado</span>
                    </div>
                    <!-- Foto paseador -->
                    <img src="../../Assets/img/walker3.jpg" alt="Foto paseador Juan Pérez" class="rounded-circle ms-3" style="width: 150px;; height: 150px;; object-fit:cover;">
                </div>
            </div>

            <!-- Paseo 2 -->
            <div class="col-md-4">
                <div class="card shadow d-flex flex-row align-items-center p-2">
                    <div class="flex-grow-1">
                        <h5 class="card-title">Jueves 12/09 - 15:00hs</h5>
                        <p class="card-text">Paseador: <strong>Ana</strong></p>
                        <span class="badge bg-warning text-dark">Pendiente</span>
                    </div>
                    <img src="../../Assets/img/walker2.jpg" alt="Foto paseador Lucía Gómez" class="rounded-circle ms-3" style="width: 150px;; height: 150px;; object-fit:cover;">
                </div>
            </div>

            <!-- Paseo 3 -->
            <div class="col-md-4">
                <div class="card shadow d-flex flex-row align-items-center p-2">
                    <div class="flex-grow-1">
                        <h5 class="card-title">Sábado 14/09 - 11:30hs</h5>
                        <p class="card-text">Paseador: <strong>Carlos</strong></p>
                        <span class="badge bg-success">Confirmado</span>
                    </div>
                    <img src="../../Assets/img/walker1.jpg" alt="Foto paseador Carlos López" class="rounded-circle ms-3" style="width: 150px;; height: 150px;; object-fit:cover;">
                </div>
            </div>
        </div>
    </section>

</main>

<?php include_once '../../componentes/footer.php'; ?>
