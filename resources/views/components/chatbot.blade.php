<!-- Botón flotante del chatbot -->
<button id="chatbot-toggle" class="fixed bottom-6 right-6 z-50 bg-[#1a3a6b] hover:bg-[#0f2a4f] text-white rounded-full p-4 shadow-lg transition-all duration-300 hover:scale-110">
    <svg xmlns="http://www.w3.org/2000/svg" width="28" height="28" fill="currentColor" class="bi bi-chat-dots" viewBox="0 0 16 16">
        <path d="M5 8a1 1 0 1 1-2 0 1 1 0 0 1 2 0zm4 0a1 1 0 1 1-2 0 1 1 0 0 1 2 0zm3 0a1 1 0 1 1-2 0 1 1 0 0 1 2 0z"/>
        <path d="M2.165 15.803l.02-.004c1.83-.363 2.948-.842 3.468-1.105A9.06 9.06 0 0 0 8 15c4.418 0 8-3.134 8-7s-3.582-7-8-7-8 3.134-8 7c0 1.76.743 3.37 1.97 4.6a10.437 10.437 0 0 1-.524 2.318l-.003.011a10.722 10.722 0 0 1-.244.637c-.079.186.074.394.273.362a21.673 21.673 0 0 0 .693-.125zm.8-3.108a1 1 0 0 0-.287-.801C1.618 10.83 1 9.468 1 8c0-3.192 3.004-6 7-6s7 2.808 7 6c0 3.192-3.004 6-7 6a8.06 8.06 0 0 1-2.088-.272 1 1 0 0 0-.711.074c-.387.196-1.24.57-2.634.893a10.97 10.97 0 0 0 .398-2z"/>
    </svg>
</button>

<!-- Ventana del chat -->
<div id="chatbot-window" class="fixed bottom-24 right-6 z-50 w-96 bg-white rounded-2xl shadow-2xl border border-gray-200 hidden flex-col max-h-[520px] transition-all duration-300">
    <!-- Encabezado -->
    <div class="bg-[#1a3a6b] text-white px-4 py-3 rounded-t-2xl flex justify-between items-center">
        <span class="font-semibold">🤖 Asistente</span>
        <button id="chatbot-close" class="text-white hover:text-gray-200 transition">
            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-x-lg" viewBox="0 0 16 16">
                <path d="M2.146 2.854a.5.5 0 1 1 .708-.708L8 7.293l5.146-5.147a.5.5 0 0 1 .708.708L8.707 8l5.147 5.146a.5.5 0 0 1-.708.708L8 8.707l-5.146 5.147a.5.5 0 0 1-.708-.708L7.293 8 2.146 2.854z"/>
            </svg>
        </button>
    </div>

    <!-- Mensajes -->
    <div id="chatbot-messages" class="flex-1 p-4 overflow-y-auto bg-gray-50 space-y-3 max-h-80">
        <!-- El mensaje de bienvenida se agrega por JavaScript -->
    </div>

    <!-- Opciones rápidas -->
    <div class="px-4 pb-2 flex flex-wrap gap-2">
        <button class="chat-option text-sm bg-gray-200 hover:bg-[#1a3a6b] hover:text-white px-3 py-1 rounded-full transition" data-question="precios">💰 Precios</button>
        <button class="chat-option text-sm bg-gray-200 hover:bg-[#1a3a6b] hover:text-white px-3 py-1 rounded-full transition" data-question="horarios">⏰ Horarios</button>
        <button class="chat-option text-sm bg-gray-200 hover:bg-[#1a3a6b] hover:text-white px-3 py-1 rounded-full transition" data-question="dirección">📍 Direccion</button>
        <button class="chat-option text-sm bg-gray-200 hover:bg-[#1a3a6b] hover:text-white px-3 py-1 rounded-full transition" data-question="contacto">📞 Contacto</button>
        <button class="chat-option text-sm bg-gray-200 hover:bg-[#1a3a6b] hover:text-white px-3 py-1 rounded-full transition" data-question="planes">📋 Planes</button>
        <button class="chat-option text-sm bg-gray-200 hover:bg-[#1a3a6b] hover:text-white px-3 py-1 rounded-full transition" data-question="servicios">🏋️ Servicios</button>
    </div>

    <!-- Input -->
    <div class="p-3 border-t border-gray-200 flex gap-2">
        <input type="text" id="chatbot-input" placeholder="Escribe tu pregunta..." class="flex-1 border border-gray-300 rounded-full px-4 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-[#1a3a6b]">
        <button id="chatbot-send" class="bg-[#1a3a6b] hover:bg-[#0f2a4f] text-white px-4 py-2 rounded-full text-sm transition">Enviar</button>
    </div>
</div>

<script>
    // =============================================
    // CHATBOT CON BACKEND (Laravel API)
    // =============================================

    const toggleBtn = document.getElementById('chatbot-toggle');
    const closeBtn = document.getElementById('chatbot-close');
    const windowChat = document.getElementById('chatbot-window');
    const messagesContainer = document.getElementById('chatbot-messages');
    const input = document.getElementById('chatbot-input');
    const sendBtn = document.getElementById('chatbot-send');

    // Agregar un mensaje al chat
    function addMessage(text, isUser = false) {
        const div = document.createElement('div');
        div.className = `flex items-start gap-2 ${isUser ? 'flex-row-reverse' : ''}`;
        const bubble = document.createElement('div');
        bubble.className = isUser
            ? 'bg-[#1a3a6b] text-white rounded-2xl rounded-tr-none px-4 py-2 max-w-[80%] whitespace-pre-line'
            : 'bg-gray-200 text-gray-800 rounded-2xl rounded-tl-none px-4 py-2 max-w-[80%] whitespace-pre-line';
        bubble.textContent = text;
        div.appendChild(bubble);
        messagesContainer.appendChild(div);
        messagesContainer.scrollTop = messagesContainer.scrollHeight;
    }

    // Enviar la pregunta al backend
    function sendToBackend(query) {
        fetch(`/chatbot/ask?q=${encodeURIComponent(query)}`)
            .then(response => response.json())
            .then(data => {
                addMessage(data.answer);
            })
            .catch(() => {
                addMessage('⚠️ Hubo un error. Por favor intenta de nuevo.');
            });
    }

    // Manejar la entrada del usuario
    function handleUserInput(text) {
        if (!text.trim()) return;
        addMessage(text, true);
        sendToBackend(text);
    }

    // Eventos
    toggleBtn.addEventListener('click', () => {
        windowChat.classList.toggle('hidden');
    });

    closeBtn.addEventListener('click', () => {
        windowChat.classList.add('hidden');
    });

    // Opciones rápidas
    document.querySelectorAll('.chat-option').forEach(btn => {
        btn.addEventListener('click', function() {
            const label = this.textContent.trim();
            handleUserInput(label);
        });
    });

    // Enviar con botón
    sendBtn.addEventListener('click', () => {
        const text = input.value;
        handleUserInput(text);
        input.value = '';
    });

    // Enviar con Enter
    input.addEventListener('keydown', (e) => {
        if (e.key === 'Enter') {
            const text = input.value;
            handleUserInput(text);
            input.value = '';
        }
    });

    // Mensaje de bienvenida
    if (messagesContainer.children.length === 0) {
        addMessage('👋 ¡Hola! Soy el asistente del gimnasio. ¿En qué puedo ayudarte?');
    }
</script>

<style>
    /* Scrollbar personalizada para el chat */
    #chatbot-messages::-webkit-scrollbar {
        width: 4px;
    }
    #chatbot-messages::-webkit-scrollbar-track {
        background: #f1f1f1;
        border-radius: 10px;
    }
    #chatbot-messages::-webkit-scrollbar-thumb {
        background: #888;
        border-radius: 10px;
    }
    #chatbot-messages::-webkit-scrollbar-thumb:hover {
        background: #555;
    }

    /* Animación de entrada para los mensajes (opcional) */
    #chatbot-messages > div {
        animation: fadeInUp 0.3s ease-out;
    }

    @keyframes fadeInUp {
        from {
            opacity: 0;
            transform: translateY(10px);
        }
        to {
            opacity: 1;
            transform: translateY(0);
        }
    }
</style>