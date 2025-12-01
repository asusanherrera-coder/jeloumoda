@extends('layouts.app')

@section('title', 'Términos y Condiciones - Jelou Moda')

@push('styles')
    <link rel="stylesheet" href="{{ asset('CSS/TerminosCondiciones.css') }}">
@endpush

@section('content')
    <main class="terminos-condiciones-main">
        <section class="policy-section">
            <h1>Términos y Condiciones de Uso</h1>
            <p class="intro-text">
                Bienvenido/a a Jelou Moda. Al acceder y utilizar nuestro sitio web y servicios, aceptas los siguientes
                términos y condiciones. Te invitamos a leerlos detenidamente.
            </p>

            <div class="terms-content">
                <article class="term-section">
                    <h2>1. Aceptación de los Términos</h2>
                    <p>
                        Al utilizar el sitio web de Jelou Moda, confirmas que has leído, entendido y aceptado estos
                        Términos y Condiciones, así como nuestra Política de Privacidad. Si no estás de acuerdo con
                        alguno de estos términos, por favor, no utilices nuestro sitio web.
                    </p>
                </article>

                <article class="term-section">
                    <h2>2. Uso del Sitio Web</h2>
                    <ul>
                        <li>El contenido de este sitio web es para tu información general y uso personal. Está sujeto a cambios sin previo aviso.</li>
                        <li>No garantizamos la exactitud, puntualidad, rendimiento, integridad o idoneidad de la información y los materiales encontrados u ofrecidos en este sitio web para ningún propósito particular. Reconoces que dicha información y materiales pueden contener inexactitudes o errores y excluimos expresamente la responsabilidad por tales inexactitudes o errores en la máxima medida permitida por la ley.</li>
                        <li>Tu uso de cualquier información o material en este sitio web es bajo tu propio riesgo, por lo cual no seremos responsables. Será tu propia responsabilidad asegurarte de que cualquier producto, servicio o información disponible a través de este sitio web cumpla con tus requisitos específicos.</li>
                    </ul>
                </article>

                <article class="term-section">
                    <h2>3. Propiedad Intelectual</h2>
                    <p>
                        Este sitio web contiene material que es de nuestra propiedad o está licenciado para nosotros.
                        Este material incluye, pero no se limita a, el diseño, la disposición, el aspecto, la apariencia
                        y los gráficos. La reproducción está prohibida salvo de conformidad con el aviso de derechos de autor,
                        que forma parte de estos términos y condiciones.
                    </p>
                    <p>
                        Todas las marcas comerciales reproducidas en este sitio web, que no son propiedad de, o licenciadas
                        al operador, son reconocidas en el sitio web.
                    </p>
                </article>

                <article class="term-section">
                    <h2>4. Productos y Precios</h2>
                    <ul>
                        <li>Nos esforzamos por mostrar la información de los productos de la manera más precisa posible, incluyendo precios, descripciones y disponibilidad. Sin embargo, los errores pueden ocurrir.</li>
                        <li>Nos reservamos el derecho de corregir cualquier error, inexactitud u omisión y de cambiar o actualizar la información en cualquier momento sin previo aviso (incluso después de que hayas enviado tu pedido).</li>
                        <li>Los precios de los productos están en Soles Peruanos (S/) e incluyen el IGV, salvo indicación contraria.</li>
                    </ul>
                </article>

                <article class="term-section">
                    <h2>5. Pedidos y Pagos</h2>
                    <ul>
                        <li>Al realizar un pedido, garantizas que toda la información proporcionada es precisa y completa.</li>
                        <li>Todos los pedidos están sujetos a disponibilidad y a nuestra confirmación.</li>
                        <li>Aceptamos los métodos de pago indicados en nuestro sitio web. El pago debe ser completado antes del envío del pedido.</li>
                    </ul>
                </article>

                <article class="term-section">
                    <h2>6. Envíos</h2>
                    <p>
                        Nuestra política de envíos se detalla en la sección "Métodos de Envío" de nuestro sitio web.
                        Al aceptar estos términos, también aceptas las condiciones de envío allí descritas.
                    </p>
                </article>

                <article class="term-section">
                    <h2>7. Cambios y Devoluciones</h2>
                    <p>
                        Nuestra política de cambios y devoluciones se detalla en la sección "Cambios y Devoluciones"
                        de nuestro sitio web. Al aceptar estos términos, también aceptas las condiciones allí descritas.
                    </p>
                </article>

                <article class="term-section">
                    <h2>8. Privacidad</h2>
                    <p>
                        Tu privacidad es muy importante para nosotros. Nuestra Política de Privacidad, que también forma
                        parte de estos Términos y Condiciones, describe cómo recopilamos, usamos y protegemos tu
                        información personal.
                    </p>
                </article>

                <article class="term-section">
                    <h2>9. Modificaciones de los Términos</h2>
                    <p>
                        Jelou Moda se reserva el derecho de modificar estos Términos y Condiciones en cualquier momento.
                        Cualquier cambio será efectivo inmediatamente después de su publicación en el sitio web. Es tu
                        responsabilidad revisar periódicamente estos términos para estar al tanto de las actualizaciones.
                    </p>
                </article>

                <article class="term-section">
                    <h2>10. Ley Aplicable y Jurisdicción</h2>
                    <p>
                        Estos Términos y Condiciones se rigen e interpretan de acuerdo con las leyes de Perú. Cualquier
                        disputa que surja en relación con estos términos estará sujeta a la jurisdicción exclusiva de
                        los tribunales de Lima, Perú.
                    </p>
                </article>
            </div>

            <div class="contact-info-policy">
                <h2>¿Tienes preguntas sobre nuestros Términos y Condiciones?</h2>
                <p>No dudes en
                    <a href="{{ route('contacto.create') }}">contactarnos</a>
                    para cualquier aclaración.
                </p>
            </div>
        </section>
    </main>

    {{-- Carrito flotante (si tu JS lo sigue usando) --}}
    <div class="cart-overlay" id="cart-overlay" aria-hidden="true" role="dialog" aria-labelledby="cart-title">
        <div class="cart-modal">
            <button class="close-cart" aria-label="Cerrar carrito">&times;</button>
            <h2 id="cart-title">Tu Carrito</h2>
            <div id="cart-items">
                <p>El carrito está vacío.</p>
            </div>
            <div class="cart-total">
                <h4>Total: <span id="cart-total-price">S/ 0.00</span></h4>
            </div>
            <button class="checkout-button">Pagar ahora</button>
        </div>
    </div>

    {{-- Botón flotante + modal del chatbot (igual que en otras vistas) --}}
    <div id="floatingChatbotBtn" class="floating-btn">
        <img src="{{ asset('IMG/Modist_Icon.png') }}" alt="Modist Chat" class="profile-pic-large">
    </div>

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
