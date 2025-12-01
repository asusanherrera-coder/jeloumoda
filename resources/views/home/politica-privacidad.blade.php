@extends('layouts.app')

@section('title', 'Política de privacidad - Jelou Moda')

@push('styles')
    <link rel="stylesheet" href="{{ asset('CSS/politica-privacidad.css') }}">
@endpush

@section('content')
    <main class="politica-privacidad-main">
        <section class="policy-section">
            <h1>Política de Privacidad</h1>
            <p class="intro-text">
                En Jelou Moda, nos comprometemos a proteger tu privacidad y tus datos personales.
                Esta política describe cómo recopilamos, usamos y protegemos la información que nos proporcionas
                al usar nuestro sitio web.
            </p>

            <div class="terms-content">
                {{-- 1. Información que recopilamos --}}
                <article class="term-section">
                    <h2>1. Información que Recopilamos</h2>
                    <p>Recopilamos diferentes tipos de información para proporcionarte nuestros servicios y mejorar tu experiencia de compra:</p>
                    <ul>
                        <li>
                            <strong>Información de Identificación Personal:</strong>
                            Nombre completo, dirección de correo electrónico, dirección de envío y facturación, número de teléfono,
                            DNI/RUC (para facturación o envío).
                        </li>
                        <li>
                            <strong>Información de Pago:</strong>
                            Datos necesarios para procesar pagos (número de tarjeta de crédito/débito, fecha de vencimiento,
                            código de seguridad), que son procesados de forma segura por nuestros proveedores de pago
                            y no almacenados directamente por nosotros.
                        </li>
                        <li>
                            <strong>Información de Uso y Técnica:</strong>
                            Dirección IP, tipo de navegador, sistema operativo, páginas visitadas, tiempo de permanencia, clics
                            y otros datos de navegación, recopilados a través de cookies y tecnologías similares.
                        </li>
                    </ul>
                </article>

                {{-- 2. Cómo utilizamos tu información --}}
                <article class="term-section">
                    <h2>2. Cómo Utilizamos tu Información</h2>
                    <p>Utilizamos la información recopilada para los siguientes propósitos:</p>
                    <ul>
                        <li>Procesar y gestionar tus pedidos y transacciones.</li>
                        <li>Comunicarnos contigo sobre tu pedido, productos, servicios y promociones.</li>
                        <li>Personalizar tu experiencia de compra y mostrarte productos relevantes.</li>
                        <li>Mejorar nuestro sitio web, productos y servicios.</li>
                        <li>Realizar análisis de datos y estudios de mercado.</li>
                        <li>Cumplir con nuestras obligaciones legales y resolver disputas.</li>
                        <li>Prevenir fraudes y garantizar la seguridad de nuestras operaciones.</li>
                    </ul>
                </article>

                {{-- 3. Compartir tu información --}}
                <article class="term-section">
                    <h2>3. Compartir tu Información</h2>
                    <p>No vendemos, alquilamos ni comercializamos tu información personal. Podemos compartirla con terceros solo en los siguientes casos:</p>
                    <ul>
                        <li>
                            <strong>Proveedores de Servicios:</strong>
                            Con empresas que nos ayudan a operar nuestro negocio (empresas de envío como Shalom,
                            procesadores de pago, servicios de marketing, análisis de datos). Estos terceros están
                            obligados a proteger tu información y usarla solo para los fines especificados.
                        </li>
                        <li>
                            <strong>Cumplimiento Legal:</strong>
                            Cuando sea requerido por ley o en respuesta a procesos legales válidos.
                        </li>
                        <li>
                            <strong>Protección de Derechos:</strong>
                            Para proteger los derechos, propiedad o seguridad de Jelou Moda, nuestros clientes o el público.
                        </li>
                        <li>
                            <strong>Transferencias de Negocio:</strong>
                            En caso de una fusión, adquisición o venta de activos, tu información podría ser transferida
                            como parte de la transacción.
                        </li>
                    </ul>
                </article>

                {{-- 4. Cookies --}}
                <article class="term-section">
                    <h2>4. Cookies y Tecnologías Similares</h2>
                    <p>
                        Utilizamos cookies y tecnologías similares para recopilar información sobre tu navegación
                        y preferencias. Las cookies son pequeños archivos de texto que se almacenan en tu dispositivo.
                        Nos ayudan a:
                    </p>
                    <ul>
                        <li>Recordar tus preferencias y artículos en el carrito.</li>
                        <li>Analizar el tráfico del sitio y el comportamiento del usuario.</li>
                        <li>Personalizar el contenido y los anuncios.</li>
                    </ul>
                    <p>
                        Puedes configurar tu navegador para que rechace todas o algunas cookies,
                        o para que te avise cuando se envíen cookies. Sin embargo, si deshabilitas las cookies,
                        algunas partes de nuestro sitio web podrían no funcionar correctamente.
                    </p>
                </article>

                {{-- 5. Seguridad --}}
                <article class="term-section">
                    <h2>5. Seguridad de tus Datos</h2>
                    <p>
                        Implementamos medidas de seguridad técnicas y organizativas para proteger tu información personal
                        contra el acceso no autorizado, la divulgación, alteración o destrucción. Sin embargo,
                        ninguna transmisión de datos por Internet es 100% segura, por lo que no podemos garantizar
                        la seguridad absoluta de tu información.
                    </p>
                </article>

                {{-- 6. Derechos --}}
                <article class="term-section">
                    <h2>6. Tus Derechos</h2>
                    <p>De acuerdo con la Ley N° 29733, Ley de Protección de Datos Personales, tienes derecho a:</p>
                    <ul>
                        <li>Acceder a tu información personal que tenemos.</li>
                        <li>Rectificar datos inexactos o incompletos.</li>
                        <li>Cancelar tus datos personales.</li>
                        <li>Oponerte al tratamiento de tus datos personales.</li>
                    </ul>
                    <p>
                        Para ejercer estos derechos, por favor, contáctanos a través de los medios indicados al final de esta política.
                    </p>
                </article>

                {{-- 7. Enlaces a terceros --}}
                <article class="term-section">
                    <h2>7. Enlaces a Terceros</h2>
                    <p>
                        Nuestro sitio web puede contener enlaces a sitios web de terceros.
                        No somos responsables de las prácticas de privacidad de estos sitios.
                        Te recomendamos leer sus políticas de privacidad antes de proporcionarles cualquier información personal.
                    </p>
                </article>

                {{-- 8. Cambios --}}
                <article class="term-section">
                    <h2>8. Cambios en esta Política de Privacidad</h2>
                    <p>
                        Podemos actualizar esta Política de Privacidad periódicamente para reflejar cambios en nuestras prácticas
                        o por razones legales, operativas o reglamentarias. Te notificaremos sobre cualquier cambio publicando
                        la nueva política en esta página y actualizando la "Última Actualización".
                    </p>
                </article>

                {{-- 9. Contacto --}}
                <article class="term-section">
                    <h2>9. Contacto</h2>
                    <p>
                        Si tienes alguna pregunta o preocupación sobre esta Política de Privacidad o sobre el tratamiento de tus datos personales,
                        no dudes en contactarnos:
                    </p>
                    <p>
                        <i class="fas fa-envelope"></i>
                        Correo:
                        <a href="mailto:soporte@jeloumoda.com">soporte@jeloumoda.com</a><br>
                        <i class="fab fa-whatsapp"></i>
                        WhatsApp:
                        <a href="https://api.whatsapp.com/send?phone=51936033151&text=Hola%20Jelou%20Moda,%20tengo%20una%20consulta%20sobre%20la%20pol%C3%ADtica%20de%20privacidad."
                           target="_blank" rel="noopener noreferrer">
                            +51 936033151
                        </a>
                    </p>
                </article>
            </div>

            <p class="last-updated">Última Actualización: 03 de Agosto de 2025</p>
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
