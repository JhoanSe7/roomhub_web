<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>RoomHub - Reserva tu Habitación</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="<?= base_url() ?>css/bootstrap.min.css">
    <link rel="stylesheet" href="<?= base_url() ?>css/styles.css">
    <script src="<?= base_url() ?>js/scripts.js" defer></script>
</head>
<body>
<header class="hero">
    <div class="container text-center text-white">
        <h1 class="display-4 site-title">Room<span class="text-orange">Hub</span></h1>
        <p class="lead">Encuentra la habitación perfecta para tu estadía</p>
    </div>
</header>
<?php if (isset($rooms)): ?>
    <main class="container py-5">
        <h2 class="text-center text-orange mb-4 section-title">Nuestras Habitaciones</h2>
        <div class="row">
            <?php foreach ($rooms as $room): ?>
                <div class="col-md-4 mb-4">
                    <div class="card room-card">
                        <img src="<?= $room['imageUrl'] ?>" class="card-img-top" alt="<?= $room['name'] ?>">
                        <div class="card-body">
                            <h5 class="card-title text-orange"><?= $room['name'] ?></h5>
                            <p class="card-text description"><?= substr($room['description'], 0, 100) ?>...</p>
                            <p class="card-text price">
                                <strong>Precio:</strong> $<?= number_format($room['price'], 0) ?> <span
                                    class="text-orange">(COP)</span>
                            </p>
                            <p class="card-text rating">
                                <strong>Calificación:</strong> <span class="stars"><?= $room['rate'] ?> ★</span>
                            </p>
                            <p class="card-text availability">
                                <strong>Disponibilidad:</strong> <?= $room['available'] ? 'Sí' : 'No' ?>
                            </p>
                            <a href="#" class="btn btn-orange btn-block">Reservar Ahora</a>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    </main>
<?php endif; ?>
<footer class="text-center py-3 bg-dark text-white">
    <p>&copy; <?= date('Y') ?> RoomHub. Todos los derechos reservados.</p>
</footer>
</body>
</html>
