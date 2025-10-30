<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Manadas - Usuario</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet">

  <link rel="stylesheet" href="../../Assets/css/style.css?v=<?php echo time(); ?>">
</head>

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
  <!-- Hero Bienvenida -->
  <section class="hero text-center p-5">
    <h1 class="display-4 fw-bold">Bienvenido a Manadas</h1>
    <p class="lead">Encuentra a los mejores paseadores y conecta con una comunidad que ama a los animales tanto como vos 🐾</p>
    <button class="btn btn-warning btn-lg mt-3" onclick="window.location.href='../registro.html'">
      Registrarme
    </button>
  </section>

  <!-- Mejores paseadores -->
  <section class="container my-5">
    <h2 class="text-center mb-4">Nuestros mejores paseadores</h2>

    <div class="d-flex justify-content-between align-items-center">
      <button class="carousel-btn" onclick="scrollWalkers(-300)">&#8249;</button>
      <div class="walker-carousel flex-grow-1 mx-3" id="walkerCarousel">
        <div class="walker-card">
          <img src="../../Assets/img/walker1.jpg" alt="Walker 1">
          <h5>Kavu</h5>
          <p>Amante de los perros chicos. 4.9 ★</p>
          <button class="btn btn-warning btn-lg mt-3" onclick="window.location.href='FormPaseador.html'">Pasear</button>
        </div>
        <div class="walker-card">
          <img src="../../Assets/img/walker2.jpg" alt="Walker 2">
          <h5>Carlos</h5>
          <p>Experto en paseos largos. 5.0 ★</p>
          <button class="btn btn-warning btn-lg mt-3" onclick="window.location.href='FormPaseador.html'">Pasear</button>
        </div>
        <div class="walker-card">
          <img src="../../Assets/img/walker3.jpg" alt="Walker 3">
          <h5>Ana</h5>
          <p>Conecta con todos los animales. 4.8 ★</p>
          <button class="btn btn-warning btn-lg mt-3" onclick="window.location.href='FormPaseador.html'">Pasear</button>
        </div>
        <!-- duplicados opcionales -->
        <div class="walker-card">
          <img src="../../Assets/img/walker1.jpg" alt="Walker 1">
          <h5>Kavu</h5>
          <p>Amante de los perros chicos. 4.9 ★</p>
          <button class="btn btn-warning btn-lg mt-3" onclick="window.location.href='FormPaseador.html'">Pasear</button>
        </div>
        <div class="walker-card">
          <img src="../../Assets/img/walker2.jpg" alt="Walker 2">
          <h5>Carlos</h5>
          <p>Experto en paseos largos. 5.0 ★</p>
          <button class="btn btn-warning btn-lg mt-3" onclick="window.location.href='FormPaseador.html'">Pasear</button>
        </div>
        <div class="walker-card">
          <img src="../../Assets/img/walker3.jpg" alt="Walker 3">
          <h5>Ana</h5>
          <p>Conecta con todos los animales. 4.8 ★</p>
          <button class="btn btn-warning btn-lg mt-3" onclick="window.location.href='FormPaseador.html'">Pasear</button>
        </div>
      </div>
      <button class="carousel-btn" onclick="scrollWalkers(300)">&#8250;</button>
    </div>
  </section>

 <footer id="smartFooter" class="smart-footer">
    <p>
      <a href="https://www.instagram.com/la_cucha_de_chimuela" target="_self">
        Nuestras redes
      </a>
    </p>
  </footer>


  <!-- JS -->
  <script>
    // Carousel
    function scrollWalkers(amount) {
      document.getElementById('walkerCarousel').scrollBy({ left: amount, behavior: 'smooth' });
    }

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
