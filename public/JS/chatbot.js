document.addEventListener('DOMContentLoaded', async () => {
    // La clave API se inyecta por el sistema para el modelo gemini-2.0-flash.
    const API_KEY = "AIzaSyBlyd9UvAusO4dkf-eXbqtjswRnahcFSCg"; // Deja esta cadena vacía. El entorno la proporcionará automáticamente.

    // Obtener referencias a los elementos del DOM del chatbot
    const chatbox = document.getElementById("chatbox");
    const chatinput = document.getElementById("chatinput");
    const sendButton = document.getElementById("sendButton");
    const loadingIndicator = document.getElementById("loadingIndicator");

    // --- Referencias de DOM para el modal del chatbot ---
    // Asegúrate de que estos IDs existan en tu HTML para el modal
    const openChatbotBtn = document.getElementById("openChatbotBtn"); // El enlace "Tu asesor personal" (si existe)
    const floatingChatbotBtn = document.getElementById("floatingChatbotBtn"); // El botón flotante de la imagen
    const chatbotModal = document.getElementById("chatbotModal"); // El contenedor del modal
    const closeChatbotBtn = document.getElementById("closeChatbotBtn"); // El botón de cerrar

    // Historial de chat para mantener la personalidad y el contexto de la conversación
    // Se inicializa con la instrucción del rol de Modist. El contenido de la web se cargará dinámicamente.
    let chatHistory = [];

    // Definir el estado inicial del historial de chat
    const initialChatHistory = [
        {
            role: "user",
            parts: [
                { text: "Actúa como un experto en moda llamado Modist. Eres amable pero firme, muy profesional. Tus respuestas deben ser claras, concisas y directas al punto del tema. Eres un experto en tendencias de moda, estilos y combinaciones de prendas. Si la pregunta no está relacionada con moda o con el contenido de la página web, debes responder que tu función es solo asistir en temas de moda o del sitio web." }
            ]
        },
        {
            role: "model",
            parts: [
                { text: "¡Hola! Soy Modist, tu asesor personal de moda. Estoy listo para ayudarte a descubrir y realzar tu estilo. ¿En qué puedo asistirte hoy?" }
            ]
        }
    ];

    // Función para resetear el historial de chat a su estado inicial
    function resetChat() {
        chatHistory = JSON.parse(JSON.stringify(initialChatHistory)); // Copia profunda para evitar mutaciones
        chatbox.innerHTML = ''; // Limpiar el contenido visual del chatbox
        appendMessage("Modist", "¡Hola! Soy Modist, tu asesor personal de moda. Estoy aquí para ayudarte a descubrir y realzar tu estilo. ¿En qué puedo asistirte hoy?");
    }

    /**
     * Función para cargar el contenido de content.json (si existe) y añadirlo al chatHistory.
     * Esto es útil si tienes datos estructurados sobre tus productos o blog en un JSON.
     */
    async function loadWebsiteContent() {
        try {
            // Asegúrate que la ruta a tu content.json sea correcta y que contenga información relevante de moda
            const response = await fetch('./JSON/content.json'); 
            if (!response.ok) {
                throw new Error(`HTTP error! status: ${response.status}`);
            }
            const data = await response.json();
            const websiteContentString = JSON.stringify(data, null, 2); // null, 2 para formato legible

            chatHistory.push({
                role: "user",
                parts: [
                    { text: "Contenido de la página web para tu referencia (en formato JSON para estructurar la información):\n\n" + websiteContentString }
                ]
            });
            console.log("Contenido de la web cargado en chatHistory para Modist.");

        } catch (error) {
            console.error("Error al cargar el contenido de la página web para Modist:", error);
            appendMessage("Modist", "⚠️ No se pudo cargar la información de la página web. Intentaré ayudarte con mi conocimiento general de moda.", true);
        }
    }

    /**
     * Añade un mensaje a la caja de chat con estilo de globo de texto y foto de perfil.
     * @param {string} sender - El nombre del remitente ("Tú" o "Modist").
     * @param {string} message - El contenido del mensaje.
     * @param {boolean} isError - True si el mensaje es un error.
     */
    function appendMessage(sender, message, isError = false) {
        const messageWrapper = document.createElement("div");
        messageWrapper.classList.add("chat-message-wrapper");

        const profilePic = document.createElement("img");
        profilePic.classList.add("profile-pic");

        const messageContentDiv = document.createElement("div");
        messageContentDiv.classList.add("chat-message");

        // Determinar la clase y la imagen de perfil según el remitente
        if (sender === "Tú") {
            messageWrapper.classList.add("user");
            // Placeholder para imagen de usuario. Ajusta la ruta si tienes una imagen real.
            profilePic.src = "/IMG/user.png"; 
            profilePic.alt = "Tu perfil";
        } else { // Modist
            messageWrapper.classList.add("modist");
            // Ruta para la imagen de Modist. Asegúrate de que esta ruta sea correcta.
            profilePic.src = "/IMG/Modist_Icon.png"; 
            profilePic.alt = "Perfil de Modist";
        }

        // Añadir la clase de color de fondo al globo de texto
        messageContentDiv.innerHTML = `<span class="message-content">${message}</span>`;
        if (sender === "Tú") {
            messageContentDiv.querySelector('.message-content').classList.add('user');
        } else {
            messageContentDiv.querySelector('.message-content').classList.add('modist');
        }

        if (isError) {
            messageContentDiv.querySelector('.message-content').classList.add('text-red-500');
        }

        // Construir la estructura del mensaje
        if (sender === "Tú") {
            messageWrapper.appendChild(messageContentDiv);
            messageWrapper.appendChild(profilePic);
        } else {
            messageWrapper.appendChild(profilePic);
            messageWrapper.appendChild(messageContentDiv);
        }

        chatbox.appendChild(messageWrapper);
        chatbox.scrollTop = chatbox.scrollHeight; // Desplazarse al final
    }

    /**
     * Abre el modal del chatbot.
     */
    function openChatbotModal() {
        if (chatbotModal) {
            chatbotModal.classList.remove("hidden"); // Quita la clase 'hidden' para mostrar el modal
            chatbotModal.classList.add("flex");      // Asegura que se muestre como flex para centrado
            chatinput.focus(); // Opcional: Pone el foco en el input del chat
        }
    }

    /**
     * Cierra el modal del chatbot.
     */
    function closeChatbotModal() {
        if (chatbotModal) {
            chatbotModal.classList.add("hidden"); // Añade la clase 'hidden' para ocultar el modal
            chatbotModal.classList.remove("flex"); // Quita la clase flex
            resetChat(); // Borrar la conversación al cerrar el chat
        }
    }

    /**
     * Maneja el envío del mensaje del usuario a la API de Gemini.
     */
    async function enviar() {
        const input = chatinput.value.trim();
        if (!input) return; // No enviar mensajes vacíos

        appendMessage("Tú", input); // Añadir el mensaje del usuario a la caja de chat

        // Convertir el input a minúsculas para la comparación
        const lowerCaseInput = input.toLowerCase();

        // Verificar si el usuario está terminando la conversación
        if (lowerCaseInput === "eso es todo" || lowerCaseInput === "estoy satisfecha con tu servicio") {
            appendMessage("Modist", "¡Me alegra haber podido ayudarte!");
            chatinput.value = ""; // Limpiar el campo de entrada
            // No enviar a la API, simplemente terminar aquí
            return; 
        }

        // Añade el mensaje del usuario al historial para enviarlo a Gemini
        chatHistory.push({ role: "user", parts: [{ text: input }] });

        chatinput.value = ""; // Limpiar el campo de entrada
        sendButton.disabled = true; // Deshabilitar el botón de enviar durante la carga
        chatinput.disabled = true; // Deshabilitar el campo de entrada durante la carga
        loadingIndicator.classList.add("flex"); // Mostrar el indicador de carga con flexbox
        loadingIndicator.classList.remove("hidden");

        try {
            // Usar gemini-2.0-flash como se especifica por el entorno
            const apiUrl = `https://generativelanguage.googleapis.com/v1beta/models/gemini-2.0-flash:generateContent?key=${API_KEY}`;

            // Preparar la carga útil (payload) para la solicitud a la API, incluyendo todo el historial
            const payload = {
                contents: chatHistory // Enviar todo el historial de chat
            };

            const response = await fetch(apiUrl, {
                method: "POST",
                headers: { "Content-Type": "application/json" },
                body: JSON.stringify(payload)
            });

            if (!response.ok) {
                // Si la respuesta HTTP no es 200 OK, lanzar un error
                const errorData = await response.json();
                throw new Error(`Error ${response.status}: ${errorData.error.message || 'Error desconocido de la API'}`);
            }

            const data = await response.json();
            // Acceder al texto de la respuesta según la estructura de la API de Gemini
            const text = data.candidates?.[0]?.content?.parts?.[0]?.text;

            if (text) {
                appendMessage("Modist", text); // Añadir la respuesta de Modist
                // Añadir la respuesta de Modist al historial para mantener el contexto
                chatHistory.push({ role: "model", parts: [{ text: text }] });
            } else {
                // Manejar casos donde la estructura de la respuesta es inesperada o falta contenido
                appendMessage("Modist", "⚠️ No se pudo obtener una respuesta válida. Si tu pregunta no es sobre moda o el sitio web, no podré asistirte.", true);
                console.error("Estructura de respuesta inesperada de la API de Gemini:", data);
            }

        } catch (error) {
            // Capturar y mostrar cualquier error durante la comunicación con la API
            console.error("Error al comunicarse con Gemini:", error);
            appendMessage("Modist", `⚠️ Error al conectar: ${error.message || 'Inténtalo de nuevo más tarde.'}`, true);
        } finally {
            // Ejecutar siempre, independientemente de si hubo un error o no
            sendButton.disabled = false; // Habilitar el botón de enviar
            chatinput.disabled = false; // Habilitar el campo de entrada
            loadingIndicator.classList.remove("flex"); // Ocultar el indicador de carga
            loadingIndicator.classList.add("hidden");
            chatinput.focus(); // Volver a poner el foco en el campo de entrada
        }
    }

    // === Manejo de eventos del Chatbot ===

    // Primero, carga el contenido de la web antes de inicializar el chat
    // Esta función asíncrona se llama dentro del DOMContentLoaded
    await loadWebsiteContent(); // Espera a que el contenido se cargue

    // Adjuntar el evento click al botón de enviar
    sendButton.addEventListener("click", enviar);

    // Adjuntar el evento keypress al campo de entrada para la tecla Enter
    chatinput.addEventListener("keypress", function(event) {
        if (event.key === "Enter") {
            event.preventDefault(); // Evitar el comportamiento predeterminado de la tecla Enter (ej. nueva línea)
            enviar();
        }
    });

    // --- Listeners para abrir y cerrar el modal ---
    if (openChatbotBtn) {
        openChatbotBtn.addEventListener("click", (event) => {
            event.preventDefault(); // Evita que el enlace href recargue la página
            openChatbotModal();
        });
    }

    if (floatingChatbotBtn) {
        floatingChatbotBtn.addEventListener("click", openChatbotModal);
    }

    if (closeChatbotBtn) {
        closeChatbotBtn.addEventListener("click", closeChatbotModal);
    }

    // Cierra el modal si se hace clic fuera del contenido del modal
    if (chatbotModal) {
        chatbotModal.addEventListener("click", (event) => {
            // Si el clic fue directamente en el fondo del modal (no en su contenido)
            if (event.target === chatbotModal) {
                closeChatbotModal();
            }
        });
    }

    // Inicializar el chat al cargar la página
    resetChat();
});
