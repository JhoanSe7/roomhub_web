document.addEventListener("DOMContentLoaded", () => {

    const BASE_URL = document.getElementById("base_url").value;
    const confirmModal = new bootstrap.Modal(document.getElementById("reservationModal"));

    // Efectos de hover en tarjetas
    const cards = document.querySelectorAll(".room-card");

    // informacion de reserva
    const fullNameInput = document.getElementById("fullName");
    const checkInDateInput = document.getElementById("checkInDate");
    const checkOutDateInput = document.getElementById("checkOutDate");
    const roomSelect = document.getElementById("room");
    const additionalInfo = document.getElementById("additionalInfo");

    const reservationButton = document.getElementById("reservationBtn");
    const confirmButton = document.getElementById("confirmReservation");

    // Referencias a los campos del modal
    const modalFullName = document.getElementById("modalFullName");
    const modalRoomName = document.getElementById("modalRoomName");
    const modalCheckInDate = document.getElementById("modalCheckInDate");
    const modalCheckOutDate = document.getElementById("modalCheckOutDate");
    const modalRoomPrice = document.getElementById("modalRoomPrice");

    const roomInfo = document.getElementById("roomInfo");

    const messageModal = new bootstrap.Modal(document.getElementById("messageModal"));
    const messageTitle = document.getElementById("messageModalLabel");
    const messageContent = document.getElementById("messageContent");

    cards.forEach((card) => {
        card.addEventListener("mouseenter", () => {
            card.style.transform = "translateY(-10px)";
        });

        card.addEventListener("mouseleave", () => {
            card.style.transform = "translateY(0)";
        });
    });


    // Validar Fecha de Entrada (No puede ser anterior a hoy)
    checkInDateInput.addEventListener("change", () => {
        const today = new Date();
        const selectedDate = new Date(checkInDateInput.value);

        if (selectedDate < today.setHours(0, 0, 0, 0)) {
            showMessage(
                "Verifica los campos",
                "La fecha de entrada no puede ser anterior a la fecha actual.",
                "error",
            );
            checkInDateInput.value = ""; // Resetea el valor si es inválido
        }
    });

    // Validar Fecha de Salida (Debe ser mayor a la fecha de entrada)
    checkOutDateInput.addEventListener("change", () => {
        const checkInDate = new Date(checkInDateInput.value);
        const checkOutDate = new Date(checkOutDateInput.value);

        if (checkOutDate <= checkInDate) {
            showMessage(
                "Verifica los campos",
                "La fecha de salida debe ser mayor que la fecha de entrada.",
                "error",
            );
            checkOutDateInput.value = ""; // Resetea el valor si es inválido
        }
    });


// Cambiar el copy según la selección de la habitación
    roomSelect.addEventListener("change", function () {

        if (this.value) {
            roomInfo.textContent = "* Esta habitación no incluye servicio de desayuno.";
        } else {
            roomInfo.textContent = "* Los servicios adicionales pueden variar.";
        }
    });

    // Validación básica del formulario antes de enviar
    reservationButton.addEventListener("click", function () {
        const client = fullNameInput.value.trim();
        const checkInDate = new Date(checkInDateInput.value);
        const checkOutDate = new Date(checkOutDateInput.value);
        const selectedRoom = roomSelect.options[roomSelect.selectedIndex];
        const roomName = selectedRoom?.dataset.name;

        if (!client) {
            showMessage(
                "Verifica los campos",
                "Por favor, ingrese su nombre completo.",
                "error",
            );
            return;
        }
        if (!checkInDateInput.value) {
            showMessage(
                "Verifica los campos",
                "Por favor, selecciona una fecha de entrada.",
                "error",
            );
            return;
        }
        if (checkInDate < new Date().setHours(0, 0, 0, 0)) {
            showMessage(
                "Verifica los campos",
                "La fecha de entrada no puede ser anterior a la fecha actual.",
                "error",
            );
            return;
        }
        if (checkOutDateInput.value && checkOutDate <= checkInDate) {
            showMessage(
                "Verifica los campos",
                "La fecha de salida debe ser mayor que la fecha de entrada.",
                "error",
            );
            return;
        }
        if (!roomName) {
            showMessage(
                "Verifica los campos",
                "Por favor, seleccione una habitación.",
                "error",
            );
            return;
        }

        // Si no hay errores, configura el modal de confirmación y muéstralo
        setData();
        confirmModal.show();

    });

    // Función para mostrar mensajes en el modal reutilizable
    function showMessage(title, message, type) {
        messageTitle.textContent = title;
        messageContent.textContent = message;

        // Cambiar estilos según el tipo de mensaje
        if (type === "error") {
            messageTitle.className = "modal-title text-danger"; // Rojo para errores
        } else if (type === "success") {
            messageTitle.className = "modal-title text-success"; // Verde para éxitos
        } else {
            messageTitle.className = "modal-title text-light"; // Default
        }

        messageModal.show();
    }

    // Mostrar datos en el modal
    function setData() {
        // Obtener valores del formulario
        const fullName = fullNameInput.value.trim();
        const checkInDate = checkInDateInput.value;
        const checkOutDate = checkOutDateInput.value;
        const selectedRoom = roomSelect.options[roomSelect.selectedIndex];
        const roomName = selectedRoom.dataset.name;
        const roomPrice = selectedRoom.dataset.price;

        // Llenar los campos del modal
        modalFullName.textContent = fullName;
        modalRoomName.textContent = roomName;
        modalCheckInDate.textContent = checkInDate;
        modalRoomPrice.textContent = "$ " + roomPrice + " COP";

        if (checkOutDate) {
            modalCheckOutDate.textContent = checkOutDate;
        } else {
            modalCheckOutDate.textContent = "No especificada";
        }
    }

    // Enviar los datos al backend al confirmar
    confirmButton.addEventListener("click", () => {
        // Deshabilitar el botón y mostrar spinner
        confirmButton.disabled = true;
        confirmButton.innerHTML = `<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span> Confirmando...`;

        const data = {
            fullName: fullNameInput.value.trim(),
            checkInDate: checkInDateInput.value,
            checkOutDate: checkOutDateInput.value || null,
            room: roomSelect.value,
            description: additionalInfo.value.trim(),
        };

        // Aquí puedes hacer un fetch o Axios POST al backend
        fetch(BASE_URL + 'create', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json', // Asegura que el servidor reciba JSON
                'Accept': 'application/json'       // Indica que esperas una respuesta JSON
            },
            body: JSON.stringify(data),
        }).then(response => {
            if (!response.ok) {
                return response.json().then((error) => {
                    throw new Error(error.message || "Error desconocido.");
                });
            }
            return response.json();
        }).then((res) => {
            // Manejar respuesta exitosa
            console.log(res.data);
            showMessage(
                "Reserva Exitosa",
                "Reserva creada exitosamente. ¡Gracias por reservar con RoomHub!",
                "success",
            );
            console.log(`${res.message} ¡Gracias por reservar con RoomHub!`);
        }).catch((error) => {
            // Manejar errores
            console.error("Error al crear la reserva:", error);
            showMessage(
                "Error en la Reserva",
                "Error al crear la reserva. Por favor, inténtalo de nuevo más tarde.",
                "error",
            );
        }).finally(() => {
            // Rehabilitar el botón y ocultar el spinner
            setTimeout(() => {
                location.replace(BASE_URL + "home");
            }, 5000);
            confirmButton.disabled = false;
            confirmButton.innerHTML = "Confirmar Reserva";
            confirmModal.hide();
        });
    });

});