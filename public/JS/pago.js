// Lógica para manejar la visibilidad de los métodos de pago y la validación
document.addEventListener('DOMContentLoaded', function() {
    const radioButtons = document.querySelectorAll('input[name="paymentMethod"]');
    const paymentContents = document.querySelectorAll('.payment-method-content');
    const paymentForm = document.getElementById('payment-form');
    const validationModal = document.getElementById('validation-modal');
    const modalTitle = document.getElementById('modal-title');
    const modalMessage = document.getElementById('modal-message');
    const modalCloseBtn = document.getElementById('modal-close-btn');
    const closeBtn = document.querySelector('.close-btn');

    // Función para mostrar el modal con un mensaje personalizado
    function showModal(title, message) {
        modalTitle.textContent = title;
        modalMessage.textContent = message;
        validationModal.style.display = 'flex';
    }

    // Ocultar el modal
    function closeModal() {
        validationModal.style.display = 'none';
    }

    // Event listeners para cerrar el modal
    modalCloseBtn.addEventListener('click', closeModal);
    closeBtn.addEventListener('click', closeModal);
    window.addEventListener('click', (event) => {
        if (event.target === validationModal) {
            closeModal();
        }
    });

    // Función para mostrar el contenido del método de pago seleccionado
    function showPaymentMethod(method) {
        paymentContents.forEach(content => {
            content.classList.add('hidden');
        });
        const selectedContent = document.getElementById(method);
        if (selectedContent) {
            selectedContent.classList.remove('hidden');
        }
    }

    // Escucha el evento 'change' en cada radio button para mostrar el método de pago
    radioButtons.forEach(radio => {
        radio.addEventListener('change', (event) => {
            if (event.target.value === 'card') {
                showPaymentMethod('card-form');
            } else if (event.target.value === 'yape') {
                showPaymentMethod('yape-qr');
            } else if (event.target.value === 'plin') {
                showPaymentMethod('plin-qr');
            }
        });
    });
    
    // Muestra por defecto el primer método de pago (tarjeta)
    const cardRadio = document.getElementById('card');
    if (cardRadio) {
        cardRadio.checked = true;
        showPaymentMethod('card-form');
    }

    /**
     * Función para validar los campos del formulario antes de enviar.
     * @returns {boolean} - Retorna true si la validación es exitosa, de lo contrario false.
     */
    function validateForm() {
        const selectedMethodRadio = document.querySelector('input[name="paymentMethod"]:checked');
        if (!selectedMethodRadio) {
            showModal('Error de Validación', 'Por favor, selecciona un método de pago.');
            return false;
        }

        const selectedMethod = selectedMethodRadio.value;
        
        document.querySelectorAll('p[id$="-error"]').forEach(p => p.classList.add('hidden'));

        if (selectedMethod === 'card') {
            const cardNumber = document.getElementById('card-number').value.replace(/\s/g, '');
            const cardName = document.getElementById('card-name').value;
            const cardExpiry = document.getElementById('card-expiry').value;
            const cardCvv = document.getElementById('card-cvv').value;

            let isValid = true;

            if (!cardNumber || !/^\d{16}$/.test(cardNumber)) {
                document.getElementById('card-number-error').classList.remove('hidden');
                isValid = false;
            }
            if (!cardName.trim()) {
                document.getElementById('card-name-error').classList.remove('hidden');
                isValid = false;
            }
            if (!cardExpiry || !/^(0[1-9]|1[0-2])\/\d{2}$/.test(cardExpiry)) {
                document.getElementById('card-expiry-error').classList.remove('hidden');
                isValid = false;
            }
            if (!cardCvv || !/^\d{3,4}$/.test(cardCvv)) {
                document.getElementById('card-cvv-error').classList.remove('hidden');
                isValid = false;
            }

            return isValid;

        } else if (selectedMethod === 'yape' || selectedMethod === 'plin') {
            showModal(
                `Confirmar Pago con ${selectedMethod}`, 
                `Por favor, asegúrate de haber completado la transferencia a nuestro número de ${selectedMethod} antes de continuar. Al hacer clic en "Aceptar", se confirmará la operación.`
            );
            return false; 
        }
        
        return false;
    }

    // Maneja el evento de envío del formulario
    paymentForm.addEventListener('submit', function(e) {
        e.preventDefault();

        if (validateForm()) {
            const selectedMethodRadio = document.querySelector('input[name="paymentMethod"]:checked');
            if (selectedMethodRadio.value === 'card') {
                // Si la validación de tarjeta es exitosa, se procede a enviar
                submitPaymentForm();
            }
            // Si es Yape/Plin, el formulario se envía desde el modal
        }
    });

    // Permite el envío del formulario desde el modal de Yape/Plin
    modalCloseBtn.addEventListener('click', () => {
        const selectedMethodRadio = document.querySelector('input[name="paymentMethod"]:checked');
        if (selectedMethodRadio && (selectedMethodRadio.value === 'yape' || selectedMethodRadio.value === 'plin')) {
            submitPaymentForm();
        } else {
            closeModal();
        }
    });

    // La función original que manejaba el formulario de pago.
async function submitPaymentForm() {
    // 1. Crear un objeto FormData con los datos del formulario.
    const formData = new FormData(paymentForm);

    // 2. Obtener los datos del carrito del localStorage.
    //    IMPORTANTE: La clave 'carritoJelouModa' debe coincidir con la que usas en tu app.
    const carrito = localStorage.getItem('carritoJelouModa');
    if (carrito) {
        formData.append('cartData', carrito);
    }

    try {
        // 3. Enviar la solicitud al servidor.
        //    AQUÍ ESTÁ LA CORRECCIÓN: La ruta ahora apunta a 'registrarpago.php'.
        const response = await fetch('../registrarpago.php', {
            method: 'POST',
            body: formData
        });

        const result = await response.json();

        if (result.status === 'success') {
            // 4. Si el pago es exitoso, limpiar el carrito y redirigir.
            localStorage.removeItem('carritoJelouModa'); // También corregimos la clave aquí.
            window.location.href = `perfil.php?transactionId=${result.transactionId}`;
            showModal('Pago existoso', result.message || 'Se realizo de forma correcta el pago.');
        } else {
            // 5. Si el servidor devuelve un error, mostrarlo en un modal.
            showModal('Error en el Pago', result.message || 'Ocurrió un error al procesar el pago.');
        }
    } catch (error) {
        // 6. Si la conexión falla, mostrar un error de red.
        showModal('Error de Conexión', 'No se pudo conectar con el servidor. Por favor, verifica la ruta del archivo y tu conexión.');
        console.error('Error:', error);
    }
}

});
