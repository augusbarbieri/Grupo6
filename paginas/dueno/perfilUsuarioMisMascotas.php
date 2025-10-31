<?php
$basePath = '../../';
include_once '../../componentes/header.php';
?>

<!-- Hero -->
<section class="hero text-center text-white bg-dark py-7 mt-4">
    <div class="container">
        <h1 class="display-4 fw-bold">Mis mascotas</h1>
        <p class="lead">🐶 Aca estan tu perritos 🐶</p>
    </div>
</section>

<div class="ms-3 me-3 mt-5">
    <div class="d-flex align-items-center mb-4">
        <a href="formMascota.php" class="btn btn-primary ms-auto">Agregar Mascota</a>
    </div>

    <!-- Sección Mascotas -->
    <div class="mascotas-container">
        <h2 class="text-center mb-4">Mis Mascotas</h2>
        <div class="row g-4">
            <!-- Mascota 1 -->
            <div class="col-md-4">
                <div class="mascota-card">
                    <img src="../../Assets/img/Labrador.jfif" alt="Foto de perfil" class="rounded-circle border d-block mx-auto" width="150" height="150">
                    <input type="file" class="form-control mb-2" accept="image/*">
                    <input type="text" class="form-control mb-2" placeholder="Nombre">

                    <!-- Enum de razas -->
                    <select class="form-select">
                        <option value="">Selecciona la raza</option>
                        <option value="labrador">Labrador</option>
                        <option value="bulldog">Bulldog</option>
                        <option value="pastor">Pastor Alemán</option>
                        <option value="beagle">Beagle</option>
                        <option value="caniche">Caniche</option>
                        <option value="mestizo">Mestizo</option>
                    </select>
                </div>
            </div>

            <!-- Mascota 2 -->
            <div class="col-md-4">
                <div class="mascota-card">
                    <img src="../../Assets/img/BorderCollie.jfif" alt="Foto de perfil" class="rounded-circle border d-block mx-auto" width="150" height="150">
                    <input type="file" class="form-control mb-2" accept="image/*">
                    <input type="text" class="form-control mb-2" placeholder="Nombre">

                    <select class="form-select">
                        <option value="">Selecciona la raza</option>
                        <option value="labrador">Labrador</option>
                        <option value="bulldog">Bulldog</option>
                        <option value="pastor">Pastor Alemán</option>
                        <option value="beagle">Beagle</option>
                        <option value="caniche">Caniche</option>
                        <option value="mestizo">Mestizo</option>
                    </select>
                </div>
            </div>

            <!-- Mascota 3 -->
            <div class="col-md-4">
                <div class="mascota-card">
                    <img src="../../Assets/img/Caniche.jfif" alt="Foto de perfil" class="rounded-circle border d-block mx-auto" width="150" height="150">
                    <input type="file" class="form-control mb-2" accept="image/*">
                    <input type="text" class="form-control mb-2" placeholder="Nombre">

                    <select class="form-select">
                        <option value="">Selecciona la raza</option>
                        <option value="labrador">Labrador</option>
                        <option value="bulldog">Bulldog</option>
                        <option value="pastor">Pastor Alemán</option>
                        <option value="beagle">Beagle</option>
                        <option value="caniche">Caniche</option>
                        <option value="mestizo">Mestizo</option>
                    </select>
                </div>
            </div>
        </div>
    </div>

    <?php include_once '../../componentes/footer.php'; ?>
