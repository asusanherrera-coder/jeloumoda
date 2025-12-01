@extends('layouts.app')

@section('title', 'Métodos de envío - Jelou Moda')

@push('styles')
    <link rel="stylesheet" href="{{ asset('CSS/MetodosEnvio.css') }}">
@endpush

@section('content')
    <main class="metodos-envio-main">
        <section class="shipping-info-section">
            <h1>Métodos de Envío</h1>
            <p class="intro-text">
                En Jelou Moda, todos nuestros envíos son 100% virtuales y se realizan a través de la
                empresa de transporte <strong>Shalom</strong>, garantizando que recibas tus prendas favoritas
                en perfecto estado y a tiempo en la comodidad de tu hogar o agencia más cercana.
            </p>

            <div class="shipping-options-grid">
                <article class="shipping-option-card">
                    <h3>Envío Estándar con Shalom</h3>
                    <p>
                        Ideal si buscas un equilibrio entre tiempo y costo. Tu pedido será entregado por
                        <a href="https://shalom.com.pe/" target="_blank" rel="noopener noreferrer">Shalom</a>
                        en un plazo estimado.
                    </p>
                    <ul>
                        <li><strong>Costo:</strong> Varía según la ubicación (se calcula al finalizar tu compra).</li>
                        <li><strong>Tiempo de entrega:</strong> 3-7 días hábiles (a través de Shalom).</li>
                        <li><strong>Cobertura:</strong> A nivel nacional (Perú), a través de la red de agencias de Shalom.</li>
                        <li><strong>Seguimiento:</strong> Disponible a través de la plataforma de Shalom.</li>
                    </ul>
                </article>

                <article class="shipping-option-card">
                    <h3>Envío Express con Shalom</h3>
                    <p>
                        ¿Necesitas tu pedido con urgencia? Elige nuestro envío express para recibirlo en el menor
                        tiempo posible, gestionado por Shalom.
                    </p>
                    <ul>
                        <li><strong>Costo:</strong> Tarifa premium (se calcula al finalizar tu compra).</li>
                        <li><strong>Tiempo de entrega:</strong> 1-2 días hábiles (a través de Shalom).</li>
                        <li><strong>Cobertura:</strong> Principalmente Lima Metropolitana y algunas ciudades principales.</li>
                        <li><strong>Seguimiento:</strong> Disponible y detallado a través de la plataforma de Shalom.</li>
                    </ul>
                </article>
            </div>

            <div class="additional-info">
                <h2>Información Adicional Importante</h2>

                <p>
                    <strong>Envíos 100% Virtuales:</strong> Jelou Moda opera exclusivamente de forma virtual, por lo que
                    no ofrecemos recojo en tienda. Todos los pedidos son enviados directamente a tu dirección o a la
                    agencia Shalom más conveniente.
                </p>

                <p>
                    <strong>Empresa de Transporte:</strong> Todos nuestros envíos son gestionados por la reconocida
                    empresa <strong>Shalom</strong>, garantizando seguridad y eficiencia en la entrega.
                </p>

                <p>
                    <strong>Costos de Envío:</strong> Los costos exactos se calcularán al finalizar tu compra,
                    dependiendo de tu dirección y el método de envío seleccionado.
                </p>

                <p>
                    <strong>Seguimiento de Pedido:</strong> Una vez que tu pedido sea enviado, recibirás un correo
                    electrónico con un número de seguimiento de Shalom para que puedas monitorear su estado en línea.
                </p>

                <p>
                    <strong>Días Hábiles:</strong> Los tiempos de entrega se refieren a días hábiles
                    (lunes a viernes, excluyendo feriados).
                </p>

                <p>
                    <strong>Dirección de Envío:</strong> Asegúrate de proporcionar una dirección de envío completa y
                    correcta para evitar retrasos. En caso de envío a agencia Shalom, especifica la agencia de tu preferencia.
                </p>

                <p>
                    Para cualquier consulta adicional sobre tu envío, no dudes en
                    <a href="{{ route('contacto.create') }}">contactarnos</a>.
                </p>
            </div>
        </section>
    </main>

    {{-- Botón flotante del chatbot --}}
    <div id="floatingChatbotBtn" class="floating-btn">
        <img src="{{ asset('IMG/Modist_Icon.png') }}" alt="Modist Chat" class="profile-pic-large">
    </div>

    {{-- Modal del Chatbot Modist --}}
    <div id="chatbotModal" class="chatbot-modal hidden">
        <div class="chatbot-modal-content">
            <div class="chatbot-modal-header">
                <h2 class="text-2xl font-bold">Modist - Tu Asesor Personal 👗✨</h2>
                <button id="closeChatbotBtn" class="close-btn">&times;</button>
            </div>

            <div id="chatbox"></div>

            <div id="loadingIndicator" class="hidden">
                Modist está procesando la información de moda...
                <span class="animate-pulse">...</span>
            </div>

            <div class="flex gap-2 mt-4">
                <input
                    type="text"
                    id="chatinput"
                    placeholder="Pregunta a Modist sobre moda..."
                    class="flex-grow p-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-green-500 text-sm"
                >
                <button
                    id="sendButton"
                    class="bg-green-600 hover:bg-green-700 text-white font-semibold py-3 px-6 rounded-lg shadow-md transition duration-300 ease-in-out focus:outline-none focus:ring-2 focus:ring-green-500 focus:ring-offset-2"
                >
                    Enviar
                </button>
            </div>
        </div>
    </div>
@endsection
