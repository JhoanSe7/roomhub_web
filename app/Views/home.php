<!-- Sección de Habitaciones -->
<?php if (isset($rooms)): ?>
    <main class="container py-5">
        <h2 class="text-center text-orange mb-4 section-title">Nuestras Habitaciones</h2>
        <div class="row">
            <?php foreach ($rooms as $room): ?>
                <div class="col-md-4 mb-4">
                    <div class="card room-card shadow-sm">
                        <img src="<?= $room['imageUrl'] ?>" class="card-img-top" alt="<?= $room['name'] ?>">
                        <div class="card-body">
                            <h5 class="card-title text-orange"><?= $room['name'] ?></h5>
<!--                            <p class="card-text description">--><?php //= substr($room['description'], 0, 100) ?><!--...</p>-->
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
                            <a href="<?= base_url('booking') ?>" class="btn btn-orange btn-block">Reservar Ahora</a>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    </main>
<?php else: ?>
    <main class="container py-5 text-center">
        <h2 class="text-orange">No hay habitaciones disponibles en este momento.</h2>
        <p>Vuelve pronto para explorar nuestras ofertas.</p>
    </main>
<?php endif; ?>
