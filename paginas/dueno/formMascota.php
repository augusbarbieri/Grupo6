<?php
$basePath = '../../';
include_once '../../componentes/header.php';
?>

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

<?php include_once '../../componentes/footer.php'; ?>
