<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Paseos de mi Mascota</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet"/>
  <link rel="stylesheet" href="../../Assets/css/style.css?v=<?php echo time(); ?>">
  
</head>
<body>

  <!-- HEADER con Navbar -->
  <header class="mb-auto w-100 bg-primary text-white">
    <nav class="navbar navbar-expand-lg navbar-dark bg-primary">
      <div class="container-fluid">
        <!-- Logo + título -->
        <a class="navbar-brand d-flex align-items-center" href="landingUsuario.html">
          <img src="../../Assets/img/logo.png" alt="Logo" class="site-logo me-2" style="height:50px;">
          <span>Manadas - Usuario</span>
        </a>

        <!-- Botón hamburguesa -->
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
          aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>

        <!-- Links -->
        <div class="collapse navbar-collapse" id="navbarNav">
          <ul class="navbar-nav ms-auto">
            <li class="nav-item">
              <a class="nav-link fw-bold text-white" href="perfilUsuarioMisManadas.html">Mis Manadas</a>
            </li>
            <li class="nav-item">
              <a class="nav-link fw-bold text-white" href="perfilUsuarioMisMascotas.html">Mis Mascotas</a>
            </li>
            <li class="nav-item">
              <a class="nav-link fw-bold text-white" href="perfilUsuario.html">Mi Perfil</a>
            </li>
          </ul>
        </div>
      </div>
    </nav>
  </header>

  <!-- Contenido principal -->
  <main class="container my-5">

  <!-- Mascota principal -->
<section class="hero text-center text-white bg-dark py-5">
  <div class="container">
    <img src="../../Assets/img/BorderCollie.jfif" 
         alt="Foto de mi mascota" 
         class="img-fluid rounded-circle border mb-3"
         style="width: 150px; height: 150px; object-fit: cover;">
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
    <img src="../../Assets/img/walker3.jpg" 
         alt="Foto paseador Juan Pérez" 
         class="rounded-circle ms-3" 
         style="width: 150px;; height: 150px;; object-fit:cover;">
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
    <img src="../../Assets/img/walker2.jpg" 
         alt="Foto paseador Lucía Gómez" 
         class="rounded-circle ms-3" 
         style="width: 150px;; height: 150px;; object-fit:cover;">
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
    <img src="../../Assets/img/walker1.jpg" 
         alt="Foto paseador Carlos López" 
         class="rounded-circle ms-3" 
         style="width: 150px;; height: 150px;; object-fit:cover;">
  </div>
</div>
      </div>
    </section>
    
  </main>

  <!-- FOOTER -->
  <footer id="smartFooter" class="smart-footer">
    <p>
      <a href="https://www.instagram.com/la_cucha_de_chimuela" target="_self">
        Nuestras redes
      </a>
    </p>
  </footer>

  <!-- JS -->
  <script>
    // Footer inteligente
    const footer = document.getElementById('smartFooter');
    let hideTimeout;

    function showFooter() {
      footer.classList.add('show');
      clearTimeout(hideTimeout);
      hideTimeout = setTimeout(() => footer.classList.remove('show'), 2500);
    }

    window.addEventListener('mousemove', showFooter);
    window.addEventListener('scroll', showFooter);
    window.addEventListener('touchstart', showFooter);
  </script>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
