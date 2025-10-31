<?php
$basePath = '../../';
include_once '../../componentes/header.php';
?>

<!-- Hero Bienvenida -->
<section class="hero text-center p-5">
    <h1 class="display-4 fw-bold">Bienvenido a Manadas</h1>
    <p class="lead">Encuentra a los mejores paseadores y conecta con una comunidad que ama a los animales tanto como vos 🐾</p>
    <button class="btn btn-warning btn-lg mt-3" onclick="window.location.href='../registro.php'">
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
                <button class="btn btn-warning btn-lg mt-3" onclick="window.location.href='FormPaseador.php'">Pasear</button>
            </div>
            <div class="walker-card">
                <img src="../../Assets/img/walker2.jpg" alt="Walker 2">
                <h5>Carlos</h5>
                <p>Experto en paseos largos. 5.0 ★</p>
                <button class="btn btn-warning btn-lg mt-3" onclick="window.location.href='FormPaseador.php'">Pasear</button>
            </div>
            <div class="walker-card">
                <img src="../../Assets/img/walker3.jpg" alt="Walker 3">
                <h5>Ana</h5>
                <p>Conecta con todos los animales. 4.8 ★</p>
                <button class="btn btn-warning btn-lg mt-3" onclick="window.location.href='FormPaseador.php'">Pasear</button>
            </div>
            <!-- duplicados opcionales -->
            <div class="walker-card">
                <img src="../../Assets/img/walker1.jpg" alt="Walker 1">
                <h5>Kavu</h5>
                <p>Amante de los perros chicos. 4.9 ★</p>
                <button class="btn btn-warning btn-lg mt-3" onclick="window.location.href='FormPaseador.php'">Pasear</button>
            </div>
            <div class="walker-card">
                <img src="../../Assets/img/walker2.jpg" alt="Walker 2">
                <h5>Carlos</h5>
                <p>Experto en paseos largos. 5.0 ★</p>
                <button class="btn btn-warning btn-lg mt-3" onclick="window.location.href='FormPaseador.php'">Pasear</button>
            </div>
            <div class="walker-card">
                <img src="../../Assets/img/walker3.jpg" alt="Walker 3">
                <h5>Ana</h5>
                <p>Conecta con todos los animales. 4.8 ★</p>
                <button class="btn btn-warning btn-lg mt-3" onclick="window.location.href='FormPaseador.php'">Pasear</button>
            </div>
        </div>
        <button class="carousel-btn" onclick="scrollWalkers(300)">&#8250;</button>
    </div>
</section>

<!-- JS -->
<script>
    // Carousel
    function scrollWalkers(amount) {
        document.getElementById('walkerCarousel').scrollBy({
            left: amount,
            behavior: 'smooth'
        });
    }
</script>

<?php include_once '../../componentes/footer.php'; ?>
