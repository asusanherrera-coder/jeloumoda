<?php

namespace App\Mail;

use App\Models\Cliente;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class WelcomeMail extends Mailable
{
    use Queueable, SerializesModels;

    public $cliente;

    /**
     * Crea una nueva instancia del mensaje.
     * Recibimos los datos del cliente para personalizar el correo.
     */
    public function __construct(Cliente $cliente)
    {
        $this->cliente = $cliente;
    }

    /**
     * Construye el mensaje.
     */
    public function build()
    {
        return $this->view('emails.welcome') // La vista que crearemos en el paso 2
                    ->subject('¡Bienvenida a Jelou Moda! 👗✨'); // El asunto del correo
    }
}