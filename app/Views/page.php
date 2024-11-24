<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>RoomHub - Reserva de Habitaciones</title>
    <link href="https://cdn.jsdelivr.net/npm/@tabler/icons-webfont@latest/tabler-icons.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="<?= base_url() ?>css/bootstrap.min.css">
    <link rel="stylesheet" href="<?= base_url() ?>css/styles.css">
</head>

<body>
<!-- Menú de navegación -->
<nav class="navbar navbar-expand-lg navbar-dark bg-transparent">
    <div class="container">
        <!-- Logo -->
        <a class="navbar-brand" href="<?= base_url() ?>">
            <img src="<?= base_url('images/logo.png') ?>" alt="RoomHub Logo" class="logo-img">
        </a>
        <!-- Botón responsive -->
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
                aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <!-- Enlaces de navegación -->
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ms-auto">
                <li class="nav-item">
                    <a class="nav-link text-light" href="<?= base_url() ?>">Inicio</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link text-light" href="<?= base_url('home') ?>">Habitaciones</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link text-light" href="<?= base_url('contact') ?>">Contáctanos</a>
                </li>
            </ul>
        </div>
    </div>
</nav>

<!-- Hero Section -->
<section class="hero">
    <div class="container text-center">
        <h1 class="site-title">
            Descubre <span class="text-orange">RoomHub</span>
        </h1>
        <p class="lead">
            <?= $content ?? "" ?>
        </p>
    </div>
</section>

<?= $page ?? "" ?>

<!-- Footer -->
<footer class="text-center py-3">
    <p>&copy; 2024 RoomHub. Todos los derechos reservados.</p>
    <p>
        <a href="#" class="text-orange">Política de privacidad</a> |
        <a href="#" class="text-orange">Términos y condiciones</a>
    </p>
</footer>

<script src="<?= base_url() ?>js/bootstrap.js" defer></script>
<script src="<?= base_url() ?>js/scripts.js" defer></script>
</body>

</html>
