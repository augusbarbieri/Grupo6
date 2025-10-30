<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Paseador Agregado</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
        
    <!-- Bootstrap CSS -->
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Tu CSS -->
        <link rel="stylesheet" href="../../Assets/css/style.css?v=<?php echo time(); ?>">

</head>

<body>

      <!-- HEADER con Navbar -->
  <header class="mb-auto w-100 bg-primary text-white">
        <nav class="navbar navbar-expand-lg navbar-dark bg-primary">
            <div class="container-fluid">
                <!-- Logo + título -->
                <a class="navbar-brand d-flex align-items-center" href="landingAdmin.html">
                    <img src="../../Assets/img/logo.png" alt="Logo" class="site-logo me-2">
                    <span>Administracion</span>
                </a>

                <!-- Botón hamburguesa -->
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <!-- Links -->
                <div class="collapse navbar-collapse" id="navbarNav">
                    <ul class="navbar-nav ms-auto">
                        <li class="nav-item">
                        <a class="nav-link fw-bold text-white" href="adminPasadeores.html">Mis paseadores</a>
                        </li>
                        <li class="nav-item">
                        <a class="nav-link fw-bold text-white" href="adminClientes.html">Mis clientes</a>
                        </li>
                        <li class="nav-item">
                        <a class="nav-link fw-bold text-white" href="landingAdmin.html">Panel Principal</a>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>
    </header>

<!-- Hero-->
  <section class="hero">
    <h1 class="display-4 fw-bold">Paseador Agregado</h1>
       
  </section>
      <div class="container mt-5">
    <form id="formMascota">
    <!-- Botón -->
      <div class="d-grid ">
            <a href="landingAdmin.html" class="btn btn-primary d-grid ">Volver</a>
      </div>
      <div class="mb-3">
      </div>
      
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js" integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI" crossorigin="anonymous"></script>
</body>
</html>