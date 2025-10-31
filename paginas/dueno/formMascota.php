<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Agregar Mascota</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
        
    <!-- Bootstrap CSS -->
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Tu CSS -->
        <link rel="stylesheet" href="../../Assets/css/style.css?v=<?php echo time(); ?>">


</head>
<body>
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
         <div class="collapse navbar-collapse" id="navPaseador">
          <ul class="navbar-nav ms-auto">
            <li class="nav-item"><a class="nav-link fw-bold" href="perfilUsuarioMisManadas.html">Mis Manadas</a></li>
            <li class="nav-item"><a class="nav-link fw-bold" href="formMascota.html">Mi Mascostas</a></li>
            <li class="nav-item"><a class="nav-link fw-bold" href="perfilUsuario.html">Mi Perfil</a></li>
          </ul>
        </div>
          </ul>
        </div>
      </div>
    </nav>
  </header>

      <div class="container mt-5">
    <h2 class="mb-4">Agregar Mascota</h2>
    <form id="formMascota">
      <!-- Nombre -->
      <div class="mb-3">
        <label for="nombre" class="form-label">Nombre de la mascota *</label>
        <input type="text" class="form-control" id="nombre" name="nombre" required>
      </div>

      <!-- Raza -->
      <div class="mb-3">
        <label for="raza" class="form-label">Raza</label>
        <input type="text" class="form-control" id="raza" name="raza">
      </div>

      <!-- Edad -->
      <div class="mb-3">
          <label for="raza" class="form-label">Edad*</label>
        <input type="number" class="form-control" id="edad" name="edad" min="0" required>
      </div>

      <!-- Descripción -->
      <div class="mb-3">
        <label for="descripcion" class="form-label">Descripción</label>
        <textarea class="form-control" id="descripcion" name="descripcion" rows="3"></textarea>
      </div>

      <!-- Botón -->
      <div class="d-grid">
    <button type="submit" class="btn btn-primary">Agregar Mascota</button>
  </div>
    </form>
  </div>
  
  </script>
</body>
</html>