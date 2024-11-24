<!-- Formulario de Reserva -->
<main class="container py-5">
    <h2 class="section-title text-center">Detalles de la Reserva</h2>
    <div id="reservationForm" class="p-4 shadow bg-dark text-light rounded">

        <!-- Información Personal -->
        <h3 class="text-orange mb-3">Información Personal</h3>
        <div class="mb-3">
            <label for="fullName" class="form-label">Nombre Completo <span class="text-orange">*</span></label>
            <input type="text" class="form-control" id="fullName" name="fullName" placeholder="Nombre completo"
                   required>
        </div>

        <!-- Fecha de Reserva -->
        <h3 class="text-orange mb-3">Fecha de Reserva</h3>
        <div class="row mb-3">
            <div class="col-md-6">
                <label for="checkInDate" class="form-label">Fecha de Entrada <span class="text-orange">*</span></label>
                <input type="date" class="form-control" id="checkInDate" name="checkInDate" required>
            </div>
            <div class="col-md-6">
                <label for="checkOutDate" class="form-label">Fecha de Salida</label>
                <input type="date" class="form-control" id="checkOutDate" name="checkOutDate">
            </div>
        </div>

        <!-- Selección de Habitación -->
        <div class="mb-3">
            <label for="room" class="form-label">Habitación Disponible</label>
            <select class="form-select" id="room" name="room" required>
                <option value="" selected disabled>Selecciona una habitación</option>
                <?php if (isset($rooms) && count($rooms) > 0): ?>
                    <?php foreach ($rooms as $room): ?>
                        <option value="<?= $room['code'] ?>" data-name="<?= $room['name'] ?>"
                                data-price="<?= number_format($room['price'], 2) ?>">
                            <?= $room['name'] ?>
                        </option>
                    <?php endforeach; ?>
                <?php endif; ?>
            </select>
            <small id="roomInfo" class="text-light mt-1 d-block">* Los servicios adicionales pueden variar.</small>
        </div>

        <!-- Información Adicional -->
        <div class="mb-3">
            <label for="additionalInfo" class="form-label">Información Adicional</label>
            <textarea class="form-control" id="additionalInfo" name="additionalInfo" rows="3" maxlength="100"
                      placeholder="Agrega información adicional"></textarea>
        </div>

        <!-- Botón de Confirmar -->
        <div class="text-end">
            <button id="reservationBtn" type="button" class="btn btn-orange">
                Reservar
            </button>
        </div>
    </div>
</main>

<!-- Modal de Confirmación -->
<div class="modal fade" id="reservationModal" tabindex="-1" aria-labelledby="reservationModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content bg-dark text-light">
            <div class="modal-header">
                <h5 class="modal-title text-orange" id="reservationModalLabel">Confirmar Reserva</h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"
                        aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <p><strong>Nombre del Cliente:</strong> <span id="modalFullName"></span></p>
                <p><strong>Habitación:</strong> <span id="modalRoomName"></span></p>
                <p><strong>Fecha de Entrada:</strong> <span id="modalCheckInDate"></span></p>
                <p><strong>Fecha de Salida:</strong> <span id="modalCheckOutDate">No especificada</span></p>
                <p class="text-orange fs-5"><strong>Valor de la Habitación:</strong> <span id="modalRoomPrice"></span>
                </p>
                <small class="text-muted d-block mt-3">* El pago total de la habitación deberá realizarse al momento de
                    hacer el check-in en el hotel.
                </small>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                <button type="button" id="confirmReservation" class="btn btn-orange">Confirmar Reserva</button>
            </div>
        </div>
    </div>
</div>
