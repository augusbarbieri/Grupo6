<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <title>Login - Manadas</title>
  <!-- Bootstrap CSS -->
  <link 
    href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" 
    rel="stylesheet">
  <link rel="stylesheet" href="../Assets/css/style.css?v=<?php echo time(); ?>">

</head>

<body>
<!-- HEADER con Navbar -->
<header class="mb-auto w-100 bg-primary text-white">
  <nav class="navbar navbar-expand-lg navbar-dark bg-primary">
    <div class="container-fluid">
      <!-- Logo + título -->
  <a class="navbar-brand d-flex align-items-center" href="inicio-sesion.html">
        <img src="../Assets/img/Logo.png" alt="Logo" class="site-logo me-2" style="height:50px;">
        <span>Manadas</span>
      </a>   
  </nav>
  
</header>

          <!-- FORM de login integrado (un solo formulario para los 3 roles) -->
          <form action="../php/login.php" method="post" class="w-100">
            <div class="mb-3">
              <label for="email" class="form-label">Email</label>
              <input type="email" name="email" class="form-control" id="email" placeholder="Ingresá tu email" required>
            </div>

            <div class="mb-3">
              <label for="password" class="form-label">Contraseña</label>
              <input type="password" name="password" class="form-control" id="password" placeholder="Ingresá tu contraseña" required>
            </div>

            <div class="d-flex flex-column align-items-center">
              <button type="submit" class="btn btn-primary mb-2 w-100">Ingresar</button>
            </div>

            <p class="text-center mt-3">
              ¿No tenés cuenta? <a href="registro.html" class="fw-bold">Registrarse</a>
            </p>
          </form>
          

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

<!-- Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
