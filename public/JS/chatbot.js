document.addEventListener('DOMContentLoaded', async () => {
    
    // Referencias DOM
    const chatbox = document.getElementById("chatbox");
    const chatinput = document.getElementById("chatinput");
    const sendButton = document.getElementById("sendButton");
    const loadingIndicator = document.getElementById("loadingIndicator");

    const openChatbotBtn = document.getElementById("openChatbotBtn");
    const floatingChatbotBtn = document.getElementById("floatingChatbotBtn");
    const chatbotModal = document.getElementById("chatbotModal");
    const closeChatbotBtn = document.getElementById("closeChatbotBtn");

    let chatHistory = [];

    // Historial Inicial Modist (MEJORADO: Instrucción de "Respuesta Inmediata")
    const initialChatHistory = [
        {
            role: "user",
            parts: [{ text: "Instrucción del sistema: Eres 'Modist', el asesor de moda de 'Jelou Moda'. \n\nIMPORTANTE:\n1. Tienes TODO el catálogo de productos cargado en este chat (en formato JSON). NO necesitas ir a buscar a ningún lado.\n2. NO SIMULES TIEMPO DE ESPERA. Si te piden una recomendación, dales el nombre y precio del producto del JSON INMEDIATAMENTE.\n3. NUNCA digas 'dame un minuto', 'estoy revisando' o 'ya vuelvo'. Responde YA.\n4. Si no encuentras el producto en el JSON, di claramente: 'Lo siento, no veo ese producto en mi lista actual', pero sugiere otro del JSON.\n5. Tu objetivo es vender. Muestra opciones atractivas." }]
        },
        {
            role: "model",
            parts: [{ text: "¡Entendido! Tengo el catálogo listo en mi memoria. Responderé al instante con opciones reales de Jelou Moda sin hacer esperar al cliente. ✨" }]
        }
    ];

    function resetChat() {
        chatHistory = JSON.parse(JSON.stringify(initialChatHistory));
        if(chatbox) chatbox.innerHTML = ''; 
        appendMessage("Modist", "¡Hola! Soy Modist, tu asesor de estilo en Jelou Moda. ✨ Conozco todo nuestro catálogo. ¿Qué prenda buscas hoy?");
    }

    // Cargar JSON (Con aviso de error visible)
    async function loadWebsiteContent() {
        try {
            // Intentamos cargar desde la raíz
            const response = await fetch('JSON/content.json'); 
            
            if (!response.ok) {
                console.warn("No se encontró content.json");
                // Si falla, avisamos al chat (solo para ti, en producción lo quitarías)
                chatHistory.push({
                    role: "user",
                    parts: [{ text: "SISTEMA: No se pudo cargar el archivo 'JSON/content.json'. El catálogo está vacío. Responde basándote en moda general pero avisa que no tienes stock en vivo." }]
                });
                return;
            }

            const data = await response.json();
            const websiteContentString = JSON.stringify(data, null, 2);
            
            // Inyectamos el catálogo DIRECTAMENTE
            chatHistory.push({
                role: "user",
                parts: [{ text: "CATÁLOGO ACTUALIZADO DE JELOU MODA (JSON):\n" + websiteContentString + "\n\nInstrucción: Usa ESTA información para responder." }]
            });
            console.log("Catálogo cargado correctamente.");

        } catch (error) { 
            console.error("Error cargando JSON:", error);
        }
    }

    // Tu función appendMessage original
    function appendMessage(sender, message, isError = false) {
        if(!chatbox) return;
        
        const messageWrapper = document.createElement("div");
        messageWrapper.classList.add("chat-message-wrapper");

        const profilePic = document.createElement("img");
        profilePic.classList.add("profile-pic");

        const messageContentDiv = document.createElement("div");
        messageContentDiv.classList.add("chat-message");

        if (sender === "Tú") {
            messageWrapper.classList.add("user");
            profilePic.src = "IMG/user.png"; 
            profilePic.alt = "Tú";
        } else { 
            messageWrapper.classList.add("modist");
            profilePic.src = "IMG/Modist_Icon.png"; 
            profilePic.alt = "Modist";
        }

        messageContentDiv.innerHTML = `<span class="message-content">${message}</span>`;
        
        const contentSpan = messageContentDiv.querySelector('.message-content');
        if (sender === "Tú") contentSpan.classList.add('user');
        else contentSpan.classList.add('modist');

        if (isError) contentSpan.classList.add('text-red-500');

        if (sender === "Tú") {
            messageWrapper.appendChild(messageContentDiv);
            messageWrapper.appendChild(profilePic);
        } else {
            messageWrapper.appendChild(profilePic);
            messageWrapper.appendChild(messageContentDiv);
        }

        chatbox.appendChild(messageWrapper);
        chatbox.scrollTop = chatbox.scrollHeight;
    }

    function openChatbotModal() {
        if (chatbotModal) {
            chatbotModal.classList.remove("hidden");
            chatbotModal.classList.add("flex");
            if(chatinput) chatinput.focus();
        }
    }

    function closeChatbotModal() {
        if (chatbotModal) {
            chatbotModal.classList.add("hidden");
            chatbotModal.classList.remove("flex");
        }
    }

    // --- FUNCIÓN ENVIAR ---
    async function enviar() {
        const input = chatinput.value.trim();
        if (!input) return;

        appendMessage("Tú", input);
        
        const lowerCaseInput = input.toLowerCase();
        if (lowerCaseInput === "eso es todo" || lowerCaseInput === "gracias") {
            appendMessage("Modist", "¡Fue un placer! Vuelve pronto para más consejos de moda. 👠");
            chatinput.value = "";
            return; 
        }

        chatHistory.push({ role: "user", parts: [{ text: input }] });
        chatinput.value = "";
        sendButton.disabled = true;
        chatinput.disabled = true;
        
        if(loadingIndicator) {
            loadingIndicator.classList.remove("hidden");
            loadingIndicator.style.display = "block";
        }

        try {
            const apiUrl = '/chatbot/ask'; 
            const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

            const response = await fetch(apiUrl, {
                method: "POST",
                headers: { 
                    "Content-Type": "application/json",
                    "X-CSRF-TOKEN": csrfToken
                },
                body: JSON.stringify({ contents: chatHistory })
            });

            if (!response.ok) throw new Error("Error de conexión");

            const data = await response.json();
            const text = data.candidates?.[0]?.content?.parts?.[0]?.text;

            if (text) {
                appendMessage("Modist", text);
                chatHistory.push({ role: "model", parts: [{ text: text }] });
            } else {
                appendMessage("Modist", "¡Ups! Me quedé en blanco. ¿Me lo repites?", true);
            }

        } catch (error) {
            console.error(error);
            appendMessage("Modist", "Estoy teniendo problemas técnicos. Intenta recargar la página.", true);
        } finally {
            sendButton.disabled = false;
            chatinput.disabled = false;
            if(loadingIndicator) {
                loadingIndicator.classList.add("hidden");
                loadingIndicator.style.display = "none";
            }
            chatinput.focus();
        }
    }

    // === INICIALIZACIÓN ===
    // 1. Reseteamos memoria
    resetChat();
    
    // 2. Cargamos el catálogo (IMPORTANTE: Esto debe pasar antes de que hables)
    await loadWebsiteContent();

    // Listeners
    if(sendButton) sendButton.addEventListener("click", enviar);
    if(chatinput) {
        chatinput.addEventListener("keypress", (e) => {
            if(e.key === "Enter") { e.preventDefault(); enviar(); }
        });
    }
    if(floatingChatbotBtn) floatingChatbotBtn.addEventListener("click", openChatbotModal);
    if(closeChatbotBtn) closeChatbotBtn.addEventListener("click", closeChatbotModal);
    if(chatbotModal) {
        chatbotModal.addEventListener("click", (e) => {
            if(e.target === chatbotModal) closeChatbotModal();
        });
    }
});