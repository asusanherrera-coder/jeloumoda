<!DOCTYPE html>
<html>
<head>
    <style>
        body { font-family: 'Helvetica', sans-serif; background-color: #fce4ec; padding: 20px; margin: 0; }
        .container { background-color: #ffffff; max-width: 600px; margin: 0 auto; border-radius: 10px; overflow: hidden; box-shadow: 0 4px 10px rgba(0,0,0,0.1); }
        .header { background-color: #b0256e; color: white; padding: 20px; text-align: center; }
        .content { padding: 30px; color: #444; line-height: 1.6; }
        .btn { display: inline-block; background-color: #b0256e; color: white; padding: 12px 25px; text-decoration: none; border-radius: 25px; margin-top: 20px; font-weight: bold; }
        .footer { background-color: #f8f9fa; padding: 15px; text-align: center; font-size: 12px; color: #888; }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <h1>¡Bienvenida a Jelou Moda!</h1>
        </div>
        <div class="content">
            <h2>Hola, {{ $cliente->nombre }} 👋</h2>
            <p>
                Te has registrado exitosamente en nuestra tienda. Estamos muy felices de que seas parte de nuestra comunidad de estilo.
            </p>
            <p>
                En <strong>Jelou Moda</strong> encontrarás las últimas tendencias urbanas, desde nuestros famosos Baggy Jeans hasta accesorios exclusivos.
            </p>
            <p style="text-align: center;">
                <a href="{{ route('catalogo.index') }}" class="btn">Ir al Catálogo</a>
            </p>
            <p>
                Si tienes alguna duda, recuerda que puedes escribirle a <strong>Modist</strong>, nuestro asesor virtual, o contactarnos por WhatsApp.
            </p>
            <p>¡Disfruta tu experiencia de compra!</p>
        </div>
        <div class="footer">
            &copy; {{ date('Y') }} Jelou Moda - Lima, Perú.
        </div>
    </div>
</body>
</html>