<!-- Sección de Habitaciones -->
<?php if (isset($rooms)): ?>
    <main class="container py-5">
        <!-- Mostrar la cantidad total de habitaciones -->
        <div class="text-center mb-4">
            <h5 class="text-light">Total de habitaciones: <span
                        class="text-orange"><?= count($rooms) ?></span></h5>
        </div>

        <!-- Título de la sección -->
        <h2 class="text-center text-orange mb-4 section-title">Nuestras Habitaciones</h2>
        <div class="row">
            <?php foreach ($rooms as $room): ?>
                <div class="col-md-4 mb-4">
                    <div class="card room-card shadow-sm">
                        <img src="<?= $room['imageUrl'] ?>" class="card-img-top" alt="<?= $room['name'] ?>">
                        <div class="card-body">
                            <h5 class="card-title text-orange"><?= $room['name'] ?></h5>
                            <!-- Cantidad de personas y calificación en una sola línea -->
                            <div class="d-flex justify-content-between align-items-center mb-2">
                                <p class="mb-0">
                                    <strong><?= $room['guests'] ?> Personas</strong>
                                </p>
                                <p class="mb-0 text-warning">
                                    <?= $room['rate'] ?> <i class="ti ti-star-filled"></i>
                                </p>
                            </div>
                            <p class="card-text price">
                                <?php if ($room['available']): ?>
                                    <strong>Precio:</strong> $<?= number_format($room['price'], 0) ?> <span
                                            class="text-orange">(COP)</span>
                                <?php else: ?>
                                    <strong class="text-danger">NO DISPONIBLE</strong>
                                <?php endif; ?>
                            </p>
                            <?php if ($room['available']): ?>
                                <a href="<?= base_url('booking') ?>" class="btn btn-orange btn-block">Reservar Ahora</a>
                            <?php else: ?>
                                <button class="btn btn-secondary btn-block unavailable-room" data-bs-toggle="modal"
                                        data-bs-target="#unavailableModal">
                                    Reservar Ahora
                                </button>
                            <?php endif; ?>
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

<!-- Modal de Habitación No Disponible -->
<div class="modal fade" id="unavailableModal" tabindex="-1" aria-labelledby="unavailableModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content bg-dark text-light">
            <div class="modal-header">
                <h5 class="modal-title text-orange" id="unavailableModalLabel">Habitación No Disponible</h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"
                        aria-label="Close"></button>
            </div>
            <div class="modal-body">
                Lo sentimos, esta habitación no está disponible en este momento.
                Por favor, consulta otras opciones o vuelve más tarde.
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-orange" data-bs-dismiss="modal">Entendido</button>
            </div>
        </div>
    </div>
</div>
