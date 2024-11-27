document.addEventListener("DOMContentLoaded", () => {
    // informacion de reserva
    const BASE_URL = document.getElementById("base_url").value;

    // Efectos de hover en tarjetas
    const cards = document.querySelectorAll(".room-card");

    cards.forEach((card) => {
        card.addEventListener("mouseenter", () => {
            card.style.transform = "translateY(-10px)";
        });

        card.addEventListener("mouseleave", () => {
            card.style.transform = "translateY(0)";
        });
    });


// Cambiar el copy según la selección de la habitación
    document.getElementById("room").addEventListener("change", function () {
        const roomInfo = document.getElementById("roomInfo");
        if (this.value) {
            roomInfo.textContent = "* Esta habitación no incluye servicio de desayuno.";
        } else {
            roomInfo.textContent = "* Los servicios adicionales pueden variar.";
        }
    });

    // Validación básica del formulario antes de enviar
    document.getElementById("reservationBtn").addEventListener("click", function () {
        const fullName = document.getElementById("fullName").value.trim();
        const checkInDate = document.getElementById("checkInDate").value;
        const selectedRoom = roomSelect.options[roomSelect.selectedIndex];
        const roomName = selectedRoom.dataset.name;

        if (!fullName || !checkInDate || !roomName) {
            alert("Por favor, complete todos los campos obligatorios.");
        } else {
            setData();
            const myModal = new bootstrap.Modal(document.getElementById("reservationModal"));
            myModal.show();
        }
    });


    // informacion de reserva
    const confirmButton = document.getElementById("confirmReservation");

    // Referencias a los campos del formulario
    const fullNameInput = document.getElementById("fullName");
    const checkInDateInput = document.getElementById("checkInDate");
    const checkOutDateInput = document.getElementById("checkOutDate");
    const roomSelect = document.getElementById("room");
    const additionalInfo = document.getElementById("additionalInfo");

    // Referencias a los campos del modal
    const modalFullName = document.getElementById("modalFullName");
    const modalRoomName = document.getElementById("modalRoomName");
    const modalCheckInDate = document.getElementById("modalCheckInDate");
    const modalCheckOutDate = document.getElementById("modalCheckOutDate");
    const modalRoomPrice = document.getElementById("modalRoomPrice");

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
        const data = {
            fullName: fullNameInput.value.trim(),
            checkInDate: checkInDateInput.value,
            checkOutDate: checkOutDateInput.value || null,
            room: roomSelect.value,
            description: additionalInfo.value.trim(),
        };

        // Simular el envío al backend (Reemplazar con tu lógica real)
        console.log("Enviando datos:", data);

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
                    console.error(error.message || "Error desconocido al procesar la reserva.");
                });
            }
            return response.json();
        }).then((res) => {
            // Manejar respuesta exitosa
            console.log(res.data);
            alert(`${res.message} ¡Gracias por reservar con RoomHub!`);
            location.replace(BASE_URL + "home");
        })
            .catch((error) => {
                // Manejar errores
                console.error("Error al crear la reserva:", error);
                alert("Error al crear la reserva. Por favor, inténtalo de nuevo más tarde.");
            });
    });

});

// Actualizar el contador de huéspedes dinámicamente
function updateGuestCount(value) {
    document.getElementById("guestCount").textContent = value === "1" ? "1 huésped" : `${value} huéspedes`;
}

const formatToCOP = (value) => {
    return new Intl.NumberFormat("es-CO", {
        style: "currency",
        currency: "COP",
        minimumFractionDigits: 0 // Ajusta a 0 para evitar decimales
    }).format(value);
};